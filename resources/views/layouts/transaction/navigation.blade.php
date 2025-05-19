<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <nav class="overflow-x-auto bg-transparent dark:bg-transparent">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    <x-nav-link :href="route('transactionworkorder.index')" :active="request()->routeIs('transactionworkorder.index')">
                        {{ __('Work Order') }}
                    </x-nav-link>
                    @if(auth()->user()->accessname == 'Administrator' or
                        auth()->user()->accessname == 'Supervisor' or
                        auth()->user()->accessname == 'Director')
                    <!-- <x-nav-link :href="route('transactionsupplydelivery.index')" :active="request()->routeIs('transactionsupplydelivery.index')">
                        {{ __('Supply Delivery') }}
                    </x-nav-link> -->
                    @endif
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <!-- {{ __('Department') }} -->
                    </x-nav-link>
                    <x-nav-link :href="route('manageaccess.index')" :active="request()->routeIs('manageaccess.index')">
                        <!-- {{ __('Access') }} -->
                    </x-nav-link>
                    <x-nav-link :href="route('manageworkclass.index')" :active="request()->routeIs('manageworkclass.index')">
                        <!-- {{ __('Work Class') }} -->
                    </x-nav-link>
                </ul>
            </div>
        </div>
    </nav>
</div>

