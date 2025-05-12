<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <ul class="flex flex-wrap -mb-px inline-block p-4 border-b-4 border-transparent rounded-t-lg space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('manageuser.index')" :active="request()->routeIs('manageuser.index')">
            {{ __('Users') }}
        </x-nav-link>
        <x-nav-link :href="route('managerequesters.index')" :active="request()->routeIs('managerequesters.index')">
            {{ __('Requesters') }}
        </x-nav-link>
        <x-nav-link :href="route('managesupplies.index')" :active="request()->routeIs('managesupplies.index')">
            {{ __('Supplies') }}
        </x-nav-link>
        <x-nav-link :href="route('managedepartment.index')" :active="request()->routeIs('managedepartment.index')">
            {{ __('Department') }}
        </x-nav-link>
        <x-nav-link :href="route('manageaccess.index')" :active="request()->routeIs('manageaccess.index')">
            {{ __('Access') }}
        </x-nav-link>
        <x-nav-link :href="route('manageworkclass.index')" :active="request()->routeIs('manageworkclass.index')">
            {{ __('Work Class') }}
        </x-nav-link>
    </ul>
</div>
