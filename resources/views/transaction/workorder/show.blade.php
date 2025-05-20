<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.transaction.navigation')
        </div>
    </div>
<div class="py-8">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
			<div class="py-8">
				<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                       <form action="{{ route('transactionworkorder.approve',$workorder->workorderid) }}" enctype="multipart/form-data" method="POST" class="p-4 md:p-5">
                            @csrf   
                            <!-- Breadcrumb -->
                            <nav class="flex px-5 py-3 text-gray-700  bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
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
                                            {{ $workorder->workorderid }}
                                        </span>
                                    </div>
                                    </li>
                                </ol>
                            </nav>
                            <div class="relative p-4 w-full max-w-full max-h-full">
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
                                    <!-- Work Order Information -->
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                          <!-- Requested By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Requested By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->rfullname }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Department Name -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Department')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->rdeptname }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Work Class Description -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Work Class Description')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->workclassdesc }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Work Order Description -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Work Order Description')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->workorderdesc }}
                                                </h5>
                                            </div>
                                        </div>
                                      
                                        <!-- Mobile -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Mobile No.')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mobile_primary }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('email')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->email }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Noted By -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Department Head -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Noted By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->hfullname }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->hstatus }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->hdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Verified By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Verified By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->vfullname }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->vstatus }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->vdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Personnel -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Department Name -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Assigned Personnel')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->sfullname }}
                                                </h5>
                                            </div>
                                        </div>

                                         <!-- Schedule -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="Schedule" :value="__('Scheduled On')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->schedule }}
                                                </h5>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!-- Completed By -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Completed By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Completed By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->cfullname }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Monitored By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Monitored By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mfullname }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mstatus }}
                                                </h5>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Time -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Time Started -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Date Time Started')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->dtstarted }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Time Ended -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Date Time Ended')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->dtended }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Work Description -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Work Order Referrence No. -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Work Order Referrence No.')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->worfid }}
                                                </h5>
                                            </div>
                                        </div>

                                        <!-- Estimated Work Days -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Estimated Work Days')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->eworkdays }}
                                                </h5>
                                            </div>
                                        </div>
                
                                        <!-- createdby -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="created_by" :value="__('Registered By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->created_by }}
                                                </h5>
                                            </div>
                                        </div>

                                        <!-- TimeDate -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="timerecorded" :value="__('Registered Date')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->timerecorded }}
                                                </h5>
                                            </div>
                                        </div>

                                        <!-- Priority -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Priority')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->prioritydesc }}
                                                </h5>
                                            </div>
                                        </div>

                                        <!-- status -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="status" :value="__('Status')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->status }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Time -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                        <!-- Time Started -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->fsfullname }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Time Ended -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->fdfullname }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="flex items-center justify-center p-4 md:p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        @if(auth()->user()->accessname == 'Personnel' and !empty($workorder->dtstarted))
                                            @if(empty($workorder->completedbyid))
                                            <button type="submit" name='action' value='personnel' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                Completed
                                            </button>
                                            @endif
                                        @endif
                                        @if(auth()->user()->accessname == 'Dept. Head')
                                            @if(empty($workorder->headid))
                                            <button type="submit" name='action' value='deptheadapproval' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                Approve
                                            </button>
                                            @elseif(!empty($workorder->headid))
                                                @if($workorder->mstatus == 'Monitoring')
                                                <button type="submit" name='action' value='deptheadmonitor' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                    </svg>
                                                    @if(empty($workorder->dtstarted))
                                                        Start Monitor
                                                    @else
                                                        End Monitor
                                                    @endif
                                                </button>
                                                @endif
                                            @endif
                                        @endif
                                        @if(auth()->user()->accessname == 'Supervisor')
                                            @if($workorder->mstatus != 'Completed' )
                                            <button type="submit" name='action' value='supervisorverify' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                Verify
                                            </button>
                                            @else
                                                @if($workorder->status == 'For Final Submission')
                                                <button type="submit" name='action' value='supervisorfinal' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                    </svg>
                                                    Finalize
                                                </button>
                                                @endif
                                            @endif
                                            
                                        @endif
                                        @if(auth()->user()->accessname == 'Director')
                                            @if($workorder->status != 'Completed')
                                            <button type="submit" name='action' value='director' class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                Archive
                                            </button>
                                            @endif
                                        @endif
                                        
                                        <a href="{{ route('transactionworkorder.index') }}" class="py-2 px-3 ms-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                            </svg>
                                            Close
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
