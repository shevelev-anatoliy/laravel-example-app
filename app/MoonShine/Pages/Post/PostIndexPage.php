<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Post;

use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\IndexPage;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Field;
use Throwable;

class PostIndexPage extends IndexPage
{
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()
                    ->showOnExport(true)
                    ->useOnImport(true),
                Text::make('Заголовок', 'title')
                    ->showOnExport(true)
                    ->useOnImport(true),
                Text::make('Slug', 'slug')
                    ->showOnExport(true)
                    ->useOnImport(true),
                Text::make('Контент', 'content')
                    ->showOnExport(true)
                    ->useOnImport(true),
                Switcher::make('Активный', 'active')
                    ->updateOnPreview()
                    ->showOnExport(true)
                    ->useOnImport(true),
            ]),
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
