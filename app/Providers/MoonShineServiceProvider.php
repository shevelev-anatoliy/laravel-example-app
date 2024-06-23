<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\SlideResource;
use MoonShine\MoonShineRequest;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => 'moonshine::ui.resource.system', [
               MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                   ->translatable(),
               MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                   ->translatable(),
            ])->translatable(),

            MenuGroup::make('Ресурсы', [
                MenuItem::make('Статьи', new PostResource())
                    ->canSee(function (MoonShineRequest $request) {
                        return $request->user()->isHavePermission(PostResource::class, 'view');
                    }),

                MenuItem::make('Слайды', new SlideResource()),
            ]),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
