<div class="profile">
    <x-title size="sm">
        Ваш профиль

        <x-slot:description>
            Посмотреть и изменить персональные данные.
        </x-slot:description>
    </x-title>

    <x-list>
        <x-list.item>
            <x-slot:name>
                Ваше имя
            </x-slot:name>

            <x-slot:value>
                {{ $user->getFullName() }}
            </x-slot:value>

            <x-slot:action>
                <x-link href="{{ route('user.settings.profile.edit') }}">
                    Изменить
                </x-link>
            </x-slot:action>
        </x-list.item>

        <x-list.item>
            <x-slot:name>
                Ваш пол
            </x-slot:name>

            <x-slot:value>
                {{ $user->gender?->name() ?: 'Не указано' }}
            </x-slot:value>

            <x-slot:action>
                <x-link href="{{ route('user.settings.profile.edit') }}">
                    Изменить
                </x-link>
            </x-slot:action>
        </x-list.item>
    </x-list>

</div>
