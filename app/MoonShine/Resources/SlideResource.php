<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Slide;
use App\MoonShine\Pages\Slide\SlideIndexPage;
use App\MoonShine\Pages\Slide\SlideFormPage;
use App\MoonShine\Pages\Slide\SlideDetailPage;

use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;

/**
 * @extends ModelResource<Slide>
 */
class SlideResource extends ModelResource
{
    protected string $model = Slide::class;

    protected string $title = 'Slides';

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            SlideIndexPage::make($this->title()),
            SlideFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            SlideDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    /**
     * @param Slide $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
