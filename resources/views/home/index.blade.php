<x-layouts.base>
    <x-slot:title>Главная</x-slot:title>

    Главная

    @foreach($slides as $slide)
        <img src="{{ Storage::url($slide->image) }}" alt=""/>
    @endforeach
</x-layouts.base>
