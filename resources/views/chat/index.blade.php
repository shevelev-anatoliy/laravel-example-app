<x-layouts.base>
    <x-slot:title>Чат</x-slot:title>

    @auth
    <div>{{ auth()->user()->first_name }}</div>

    <div class="flex h-96 antialiased text-gray-800">
        <div class="flex flex-col flex-auto h-full p-6">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                <div class="flex flex-col h-full overflow-x-auto mb-4">
                    <div class="flex flex-col h-full">
                        <chat-messages :user="{{ auth()->user() }}"></chat-messages>
                    </div>
                </div>

                <chat-form></chat-form>
            </div>
        </div>
    </div>

    @else
        Чат доступен только авторизованным пользователям
    @endauth
</x-layouts.base>
