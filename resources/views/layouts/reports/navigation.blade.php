<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <nav class="overflow-x-auto bg-transparent dark:bg-transparent">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    <x-nav-link :href="route('reportshistoryworkorder.index')" :active="request()->routeIs('reportshistoryworkorder.index')">
                        {{ __('Reports') }}
                    </x-nav-link>
                </ul>
            </div>
        </div>
    </nav>
</div>

