<x-layouts.base>
    <x-slot:title>Главная</x-slot:title>

    @isset($slides)
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($slides as $slide)
            <div class="swiper-slide">
                <img src="{{ Storage::url($slide->image) }}" alt=""/>
            </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <div class="swiper-scrollbar"></div>
    </div>
    @endisset
</x-layouts.base>
