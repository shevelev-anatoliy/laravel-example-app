<?php

namespace App\Http\Controllers;

use App\Enums\Email\EmailStatusEnum;
use App\Models\Email;
use App\Models\User;
use App\Notifications\Email\ConfirmEmailNotification;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function confirmation(Request $request)
    {
        /** @var User */
        $user = $request->user();

        if ($user && $user->isEmailConfirmed()) {
            return redirect()->intended('/user');
        }

        return view('email.confirmation');
    }

    public function send(Request $request)
    {
        if (session('email-confirmation-sent')) {
            return back();
        }

        /** @var User */
        $user = $request->user();

        abort_unless($user, 404);
        abort_if($user->isEmailConfirmed(), 404);

        $email = Email::query()
            ->where('user_id', $user->id)
            ->where('status', EmailStatusEnum::pending)
            ->firstOrFail();

        $notification = new ConfirmEmailNotification($email);

        $user->notify($notification);

        session(['email-confirmation-sent' => now()]);

        return back();
    }

    public function link(Request $request, Email $email)
    {
        abort_if($email->user->isEmailConfirmed(), 404);
        abort_unless($email->status->is(EmailStatusEnum::pending), 404);

        $email->user->confirmEmail();
        $email->updateStatus(EmailStatusEnum::completed);

        return redirect()->intended('/user');
    }
}
