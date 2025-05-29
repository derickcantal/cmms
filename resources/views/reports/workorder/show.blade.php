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
                            <nav class="flex px-5 py-3 text-gray-700 bg-white dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                    <li class="inline-flex items-center">
                                    <a href="{{ route('reportshistoryworkorder.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                        </svg>
                                        Reports
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
                                            Work Order Information @if(!empty($workorder->worfid)) (W.O.R.F. ID: {{ $workorder->worfid }})@endif
                                        </h3>
                                    </div>

                                    <!-- header -->
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2 sm:col-span-2">
                                            <img class="w-10 h-10 rounded-full mx-auto" src="{{ asset("/storage/logo/slsu-logo.jpg") }}" >
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                Southern Luzon State University
                                            </h5>
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                GENERAL SERVICES OFFICE
                                            </h5>
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                Lucban, Quezon
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- worfid -->
                                    <div class="grid gap-4 mb-4 grid-cols-3">
                                        <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                                            <x-input-label class="text-center text-gray-900 dark:text-white">Priority</x-input-label>
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                @if(empty($workorder->prioritydesc))
                                                To be filled
                                                @else
                                                {{ $workorder->prioritydesc }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1"></div>
                                        <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                                            <x-input-label class="text-center text-gray-900 dark:text-white">W.O.R.F ID</x-input-label>
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $workorder->worfid }}
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- title -->
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2 sm:col-span-2">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                WORK ORDER REQUEST FORM
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- requesters line 1 -->
                                    <div class="grid gap-4 mb-4 grid-cols-5">
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label class="text-right text-lg dark:text-white" for="workorderdesc" :value="__('Requesters Name:')" />
                                        </div>
                                        <div class="col-span-2 sm:col-span-2 border-b">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $workorder->rfullname }}
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label class="text-right text-gray-900 text-lg" for="workorderdesc" :value="__('Date:')" />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1 border-b">
                                            <h5 class="text-center text-md font-semibold text-gray-900 dark:text-white">
                                                {{ $workorder->timerecorded }}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- requesters line 2 -->
                                    <div class="grid gap-4 mb-4 grid-cols-5">
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label class="text-right text-lg dark:text-white" for="workorderdesc" :value="__('College/Department:')" />
                                        </div>
                                        <div class="col-span-2 sm:col-span-2 border-b">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->rdeptname }}
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label class="text-right text-lg dark:text-white" for="workorderdesc" :value="__('W.O. Status:')" />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1 border-4">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->status }}
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- Service Classification -->
                                    <div class="grid gap-4 mb-4 grid-cols-3">
                                        <div class="col-span-1 sm:col-span-1"></div>
                                        <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                SERVICE CLASSIFICATION
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1"></div>
                                    </div>

                                    <!-- Service Classification -->
                                    <div class="grid gap-4 mb-4 grid-cols-3">
                                        <div class="col-span-1 sm:col-span-1"></div>
                                        <div class="col-span-1 sm:col-span-1 border-b border-solid">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $workorder->workclassdesc }}
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1"></div>
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

                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <!-- Work Order Description -->
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Description of facility to be inspected: (please attached picture)')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->workorderdesc }}. {{ $workorder->notes }}  
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Noted By -->
                                    <div class="grid gap-4 mb-4 grid-cols-4">
                                        <!-- Department Head -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Noted By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->hfullname }}
                                                </h5>
                                                <x-input-label>College/Dept. Head</x-input-label>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->hdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <x-input-label>College/Dept. Head - Signature</x-input-label>
                                            @if(!empty($workorder->hdsignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->hdsignimage") }}">
                                            @endif
                                        </div>
                                        <!-- Verified By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Verified By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->vfullname }}
                                                </h5>
                                                <x-input-label>GSO Supervisor</x-input-label>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->vdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <x-input-label>College/Dept. Head - Signature</x-input-label>
                                            @if(!empty($workorder->vsignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->vsignimage") }}">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mb-4 grid-cols-1 border-t border-dashed "></div>
                                    <!-- supply list & EWD -->
                                    <div class="grid gap-4 mb-4 grid-cols-1">
                                        @csrf
                                        <!-- table -->
                                        <div class="max-w-7xl overflow-x-auto sm:rounded-lg mt-4" >
                                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                List & Supplies Needed
                                            </h5>
                                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-white">
                                                <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            No
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Description
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Qty
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Remarks
                                                        </th>
                                                    </tr>
                                                </thead>
                                                    @forelse ($wosupplies as $wosupply)
                                                    
                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    
                                                        <td class="px-6 py-4">
                                                            <x-input-label>{{ ++$i }}</x-input-label>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <x-input-label>{{ $wosupply->particulars }}</x-input-label>
                                                            <x-input-label>{{ $wosupply->wosuppliesdesc }}</x-input-label>
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            <x-input-label>{{ $wosupply->qty }}</x-input-label>
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            <x-input-label>{{ $wosupply->remarks }}</x-input-label>
                                                        </th>
                                                    </tr>
                                                
                                                    @empty
                                                    <td scope="row" class="px-6 py-4">
                                                        No Records Found.
                                                    </td>	
                                                    @endforelse
                                                        
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                        <!-- Estimated Work Days -->
                                        <div class="grid gap-4 mb-4 grid-cols-2 ">
                                            <div class="col-span-2 sm:col-span-1">
                                                <div class="form-group mt-4">
                                                    <x-input-label class="text-lg font-semibold text-gray-900 dark:text-white">Estimated No. of Working Days: {{ $workorder->eworkdays }}</x-input-label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-3 border-t border-dashed "></div>
                                    <!-- inspection and acceptance -->
                                    <div class="grid gap-4 mb-4 grid-cols-3">
                                        <div class="col-span-1 sm:col-span-1"></div>
                                        <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                                            <h5 class="text-center text-lg font-semibold text-gray-900 dark:text-white">
                                                INSPECTION AND ACCEPTANCE
                                            </h5>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1"></div>
                                    </div>
                                    <!-- agree -->
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-input-label>I aggree and Accept that all works has been performed to my satisfaction.</x-input-label>
                                        </div>
                                    </div>
                                    <!-- signed by -->
                                    <div class="grid gap-4 mb-4 grid-cols-4">
                                        <!-- Completed By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group">
                                                <x-input-label for="workorderdesc" :value="__('Completed By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->cfullname }}
                                                </h5>
                                                <x-input-label>GSO Supervisor</x-input-label>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <x-input-label>GSO Supervisor- Signature</x-input-label>
                                            @if(!empty($workorder->ssignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->ssignimage") }}">
                                            @endif
                                        </div>
                                        <!-- Monitored By -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group">
                                                <x-input-label for="workorderdesc" :value="__('Completed By:')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mfullname }}
                                                </h5>
                                                <x-input-label>College/Dept. Head</x-input-label>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->mdtsigned }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <x-input-label>College/Dept. Head - Signature</x-input-label>
                                            @if(!empty($workorder->msignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->msignimage") }}">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Time -->
                                    <div class="grid gap-4 mb-4 grid-cols-4 border-t">
                                        <!-- Time Started -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Date Time Started')" />
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->dtstarted }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- Time Ended -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Date Time Ended')" />
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->dtended }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Personnel -->
                                    <div class="grid gap-4 mb-4 grid-cols-2 ">
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
                                                    {{ $workorder->start }} - {{ $workorder->end }}
                                                </h5>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!-- Supervised -->
                                    <div class="grid gap-4 mb-4 grid-cols-4 border-t ">
                                        <!-- Supervisor -->
                                        <div class="col-span-1 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->fsfullname }}
                                                </h5>
                                                <x-input-label>GSO Supervisor</x-input-label>
                                            </div>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label>GSO Supervisor - Signature</x-input-label>
                                            @if(!empty($workorder->fssignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->fssignimage") }}">
                                            @endif
                                        </div>
                                        <!-- Director -->
                                        <div class="col-span-1 sm:col-span-1">
                                            <div class="form-group mt-4">
                                                <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $workorder->fdfullname }}
                                                </h5>
                                                <x-input-label>Director, General Services Office</x-input-label>
                                            </div>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <x-input-label>GSO Director - Signature</x-input-label>
                                            @if(!empty($workorder->fdsignimage))
                                                <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->fdsignimage") }}">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="flex items-center justify-center p-4 md:p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <a href="{{ route('reportshistoryworkorder.printpdf',$workorder->workorderid) }}" class="py-2 px-3 ms-3 flex items-center text-sm font-medium px-5 py-2.5 text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
                                        </svg>
                                            Print
                                        </a>
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
