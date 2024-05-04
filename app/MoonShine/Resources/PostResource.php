<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use MoonShine\ChangeLog\Components\ChangeLog;
use MoonShine\Enums\Layer;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Статьи';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')
                    ->showOnExport(true)
                    ->useOnImport(true),
                TinyMce::make('Контент', 'content')
                    ->showOnExport(true)
                    ->useOnImport(true),
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Text::make('Заголовок', 'title'),
        ];
    }

    protected function onBoot(): void
    {
        $this->getPages()
            ->formPage()
            ->pushToLayer(
                Layer::BOTTOM,
                ChangeLog::make('История изменений', $this)->limit(2)
            );
    }

    public function export(): ?ExportHandler
    {
        return ExportHandler::make('Экспорт')
            ->disk('public')
            ->dir('/exports');
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
