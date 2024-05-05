<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\MoonShine\Pages\Post\PostDetailPage;
use App\MoonShine\Pages\Post\PostFormPage;
use App\MoonShine\Pages\Post\PostIndexPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use MoonShine\ChangeLog\Components\ChangeLog;
use MoonShine\Enums\Layer;
use MoonShine\Enums\PageType;
use MoonShine\Fields\ID;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Pages\Page;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Статьи';

    protected bool $detailInModal = true;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            PostIndexPage::make($this->title()),
            PostFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            PostDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    public function fields(): array
    {
        return [
            ID::make()
                ->showOnExport()
                ->useOnImport(),
            Text::make('Заголовок', 'title')
                ->showOnExport()
                ->useOnImport(),
            Text::make('slug', 'slug')
                ->showOnExport()
                ->useOnImport(),
            Text::make('Контент', 'content')
                ->showOnExport()
                ->useOnImport(),
            Number::make('Активный', 'active')
                ->showOnExport()
                ->useOnImport(),
        ];
    }

    public function filters(): array
    {
        return [
            Text::make('Заголовок', 'title'),
            Select::make('Активность', 'active')
                ->options([
                    '0' => 'Только НЕ активные',
                    '1' => 'Только активные',
                ])
                ->nullable()
                ->onApply(fn(Builder $query, $value) => $query->where('active', $value)),
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

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:10'],
        ];
    }

    public function export(): ?ExportHandler
    {
        return ExportHandler::make('Экспорт')
            ->disk('public')
            ->dir('/exports');
    }

    public function import(): ?ImportHandler
    {
        return ImportHandler::make('Импорт')
            ->disk('public')
            ->dir('/imports')
            ->deleteAfter();
    }
}
