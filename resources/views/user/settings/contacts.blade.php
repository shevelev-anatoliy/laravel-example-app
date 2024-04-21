<div class="profile">
    <x-title size="sm">
        Ваши контакты

        <x-slot:description>
            Посмотреть и изменить контактные данные.
        </x-slot:description>
    </x-title>

    <x-list>
        <x-list.item>
            <x-slot:name>
                Ваше Email
            </x-slot:name>

            <x-slot:value>
                {{ $user->email }}
            </x-slot:value>

            <x-slot:action>
                <x-link href="{{ route('user.settings.email.edit') }}" wire:navigate>
                    Изменить
                </x-link>
            </x-slot:action>
        </x-list.item>
    </x-list>

</div>
