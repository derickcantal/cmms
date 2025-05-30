<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.transaction.navigation')
        </div>
    </div>
<div class="py-8">
	<div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('transactionworkorder.feedback',$workorder->workorderid) }}" enctype="multipart/form-data" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="relative p-4 w-full max-w-full max-h-full">
                        <!-- Breadcrumb -->
                        <nav class="flex px-5 py-3 text-gray-700 bg-white dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    
                                    <a href="{{ route('transactionworkorder.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                        </svg>
                                        Transaction
                                    </a>
                                    
                                </li>
                                
                                <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        Work Order
                                    </span>
                                </div>
                                </li>

                                <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        {{ $workorder->worfid }}
                                    </span>
                                </div>
                                </li>

                                <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        Remarks
                                    </span>
                                </div>
                                </li>
                            </ol>
                        </nav>
                        <!-- Error & Success Notification -->
                        @include('layouts.notifications') 
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg dark:bg-gray-800">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Work Order Information
                                </h3>
                            </div>
                            <!-- Information -->
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <!-- workd order desc -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Work Order Description')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $workorder->workorderdesc }}
                                        </h5>
                                    </div>
                                </div>
                                <!-- Requested By -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="rfullname" :value="__('Requested By')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                           {{ $workorder->rfullname }}
                                        </h5>
                                    </div>
                                </div>

                                <!-- Noted By -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="cfullname" :value="__('Assigned Personnel')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                          {{ $workorder->cfullname }}
                                        </h5>
                                    </div>
                                </div>

                                   <!-- Schedule -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="Schedule" :value="__('Scheduled On')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $workorder->start }} - {{ $workorder->end }}
                                        </h5>
                                    </div>
                                </div>
                            </div>


                            <!-- Time -->
                            <div class="grid gap-4 mb-4 grid-cols-2 ">
                                <!-- Time Started -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Date Time Started')" />
                                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $workorder->dtstarted }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Date Time Ended')" />
                                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $workorder->dtended }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            
                            <!-- Work Order  Images -->
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <!-- Submitted Image -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Submitted Image')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            @if(!empty($workorder->woimage))
                                            <img class="h-auto max-w-xs rounded-lg" src="{{ asset("/storage/$workorder->woimage") }}">
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                
                                <!-- Image -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Completed Work Image')" />
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            @if(!empty($workorder->woeimage))
                                            <img class="h-auto max-w-xs rounded-lg" src="{{ asset("/storage/$workorder->woeimage") }}">
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>

                           
                            <!-- Prioritization -->
                            <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">

                                <!-- notes -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="notes" :value="__('Remarks')" />
                                        <x-text-input id="remarks" class="block mt-1 w-full" type="text" name="remarks" :value="old('remarks',$workorder->remarks)" required autofocus />
                                        <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                                    </div>
                                </div>

                            </div>

                            
                            
                        </div>
                        <!-- Button -->
                        <div class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                Approve Work
                            </button>
                            <a href="{{ route('transactionworkorder.index') }}" class="py-2 px-3 ms-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>

                                Cancel
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
