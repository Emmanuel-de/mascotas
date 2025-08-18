<nav x-data="{ open: false }" class="cyber-nav border-b border-opacity-20">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-500 rounded border border-cyan-400" style="box-shadow: 0 0 10px var(--cyber-glow);"></div>
                        <span class="text-xl font-bold cyber-glow-text">CYBER PET</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="cyber-nav-link">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'administrator' || auth()->user()->role === 'employee')
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="cyber-nav-link">
                            {{ __('Productos') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')" class="cyber-nav-link">
                            {{ __('Mascotas') }}
                        </x-nav-link>

                        <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" class="cyber-nav-link">
                            {{ __('Clientes') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')" class="cyber-nav-link">
                        {{ __('ventas') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-cyan-400 text-sm leading-4 font-medium rounded-md cyber-nav-link bg-transparent hover:bg-cyan-400 hover:bg-opacity-10 focus:outline-none transition ease-in-out duration-150" style="border-color: var(--cyber-primary);">
                            <div class="cyber-text-primary">{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 cyber-text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="cyber-nav-link block px-4 py-2 text-sm">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="cyber-nav-link block px-4 py-2 text-sm">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                {{ __('DASHBOARD') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role !== 'customer')
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                    {{ __('PRODUCTS') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                    {{ __('PETS') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                    {{ __('CUSTOMERS') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                {{ __('SALES') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                    {{ __('PROFILE') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="cyber-nav-link block pl-4 pr-2 py-2 text-base font-medium">
                        {{ __('LOG OUT') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
