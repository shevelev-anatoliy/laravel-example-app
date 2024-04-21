<?php

namespace App\Http\Controllers;

use App\Enums\Social\SocialDriverEnum;
use App\Models\Social;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect(SocialDriverEnum $driver)
    {
        session()->flash('social_back_url', url()->previous());

        return Socialite::driver($driver->value)->redirect();
    }

    public function callback(SocialDriverEnum $driver)
    {
        try {
            $data = Socialite::driver($driver->value)->user();
        } catch (Exception $e) {
            report($e);

            return redirect()->to(session()->pull('social_back_url', '/login'));
        }

        /** @var Social */
        $social = Social::query()
            ->firstOrCreate([
                'driver' => $driver,
                'driver_user_id' => $data->getId(),
            ]);

        if (is_null($social->user_id)) {
            $user = User::query()->create(['password' => Str::random(12)]);
            $social->user()->associate($user)->save();
        }

        Auth::login($social->user);

        request()->session()->regenerate();

        return redirect()->intended('/user');
    }
}
