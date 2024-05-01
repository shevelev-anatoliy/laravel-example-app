<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Slide;

use MoonShine\Fields\Field;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Slide>
 */
class SlideResource extends ModelResource
{
    protected string $model = Slide::class;

    protected string $title = 'Slides';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()
                    ->sortable(),
                Image::make('Изображение', 'image')
                    ->dir('slides')
                    ->removable(),
                Number::make('Позиция', 'posit')
                    ->default(1)
                    ->sortable(),
            ]),
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
