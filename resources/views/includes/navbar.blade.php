<nav class="bg-gray-800" x-data="{ menu_open: false }">
    <div class="container">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" x-on:click="menu_open = !menu_open" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!menu_open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-cloak x-show="menu_open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('home') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ active_link('home', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Главная</a>
                        <a href="{{ route('contacts') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ active_link('contacts', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Контакты</a>
                        <a href="{{ route('chat') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ active_link('chat', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Чат</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <!-- Profile dropdown -->
                <div class="relative ml-3" x-data="{ profile_open: false }">
                    <div>
                        <button type="button" x-on:click="profile_open = ! profile_open" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>

                    <!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div x-cloak x-data x-show="profile_open" x-on:click.outside="profile_open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Настройки</a>
                        <a href="" x-on:click.prevent="$refs.logout.submit()" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                            Выход

                            <x-form x-ref="logout" action="{{ route('logout') }}" method="post" class="hidden"></x-form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-cloak x-data x-show="menu_open">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ active_link('home', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Главная</a>
            <a href="{{ route('contacts') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ active_link('contacts', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Контакты</a>
            <a href="{{ route('chat') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ active_link('chat', 'bg-gray-900 text-white', 'text-gray-300 hover:bg-gray-700 hover:text-white') }}">Чат</a>
        </div>
    </div>
</nav>
