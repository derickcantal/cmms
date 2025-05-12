<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <ul class="flex flex-wrap -mb-px inline-block p-4 border-b-4 border-transparent rounded-t-lg space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('manageuser.index')" :active="request()->routeIs('manageuser.index')">
            {{ __('Users') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Requesters') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Department') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Access') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Work Class') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Supplies') }}
        </x-nav-link>
    </ul>
</div>
