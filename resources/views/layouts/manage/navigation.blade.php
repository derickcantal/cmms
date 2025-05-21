<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <nav class="overflow-x-auto bg-transparent dark:bg-transparent">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    @if(auth()->user()->accessname == 'Administrator' or
                        auth()->user()->accessname == 'Supervisor' or
                        auth()->user()->accessname == 'Director')
                    <x-nav-link :href="route('manageuser.index')" :active="request()->routeIs('manageuser.index')">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('managerequesters.index')" :active="request()->routeIs('managerequesters.index')">
                        {{ __('Requesters') }}
                    </x-nav-link>
                    <x-nav-link :href="route('managetempusers.index')" :active="request()->routeIs('managetempusers.index')">
                        {{ __('Temporary Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('managedepartment.index')" :active="request()->routeIs('managedepartment.index')">
                        {{ __('Department') }}
                    </x-nav-link>
                    @endif
                    @if(auth()->user()->accessname == 'Administrator' or
                        auth()->user()->accessname == 'Director')
                    <!-- <x-nav-link :href="route('manageaccess.index')" :active="request()->routeIs('manageaccess.index')">
                        {{ __('Access') }}
                    </x-nav-link> -->
                    <x-nav-link :href="route('manageworkclass.index')" :active="request()->routeIs('manageworkclass.index')">
                        {{ __('Work Class') }}
                    </x-nav-link>
                    <!-- <x-nav-link :href="route('managesupplies.index')" :active="request()->routeIs('managesupplies.index')">
                        {{ __('Supplies') }}
                    </x-nav-link> -->
                    @endif
                    <x-nav-link :href="route('managemyprofile.index')" :active="request()->routeIs('managemyprofile.index')">
                        {{ __('My Profile') }}
                    </x-nav-link>
                </ul>
            </div>
        </div>
    </nav>
</div>
