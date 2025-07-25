<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.manage.navigation')
        </div>
    </div>
	<div class="py-8 max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-8 max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <nav class="flex px-5 py-3 text-gray-700 bg-white dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                        <a href="{{ route('managesupplies.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Supplies
                        </a>
                        </li>
                        
                        <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                Show Information
                            </span>
                        </div>
                        </li>

                        <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ $supplies->suppliesdesc }}
                            </span>
                        </div>
                        </li>
                    </ol>
                </nav>

                @csrf
                
                <!-- Error & Success Notification -->
                @include('layouts.notifications') 
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Supplies Information
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <!-- Department Name -->
                        <div class="col-span-2 sm:col-span-1">
                            <div class="form-group mt-4">
                                <x-input-label for="suppliesdesc" :value="__('Supplies')" />
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $supplies->suppliesdesc }}
                                </h5>
                            </div>
                        </div>
    
                        <!-- createdby -->
                        <div class="col-span-2 sm:col-span-1">
                            <div class="form-group mt-4">
                                <x-input-label for="created_by" :value="__('Registered By')" />
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $supplies->created_by }}
                                </h5>
                            </div>
                        </div>

                        <!-- TimeDate -->
                        <div class="col-span-2 sm:col-span-1">
                            <div class="form-group mt-4">
                                <x-input-label for="timerecorded" :value="__('Registered Date')" />
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $supplies->timerecorded }}
                                </h5>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="col-span-2 sm:col-span-1">
                            <div class="form-group mt-4">
                                <x-input-label for="status" :value="__('Status')" />
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $supplies->status }}
                                </h5>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a href="{{ route('managesupplies.index') }}" class="py-2 px-3 ms-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                            Close
                        </a>
                    </div>

                </div>
                        
            </div>
        </div>
    </div>
</x-app-layout>
