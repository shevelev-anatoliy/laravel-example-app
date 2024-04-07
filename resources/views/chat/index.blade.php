<x-layouts.base>
    <x-slot:title>Чат</x-slot:title>

    <div>{{ auth()->user()->name }}</div>

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
</x-layouts.base>
