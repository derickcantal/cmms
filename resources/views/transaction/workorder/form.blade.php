<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> -->
        <!-- <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> -->
        <link rel="stylesheet" href="{{ URL::asset('build/assets/app-CMhugc2N.css') }}" type='text/css'>
        <script src="{{ URL::asset('build/assets/app-zbkhBQfX.js') }}"></script>
    </head>
    <body >
        <!-- header -->
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2 sm:col-span-2">
                <img class="w-10 h-10 rounded-full mx-auto" src="{{ asset("/storage/logo/slsu-logo.jpg") }}" >
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    Southern Luzon State University
                </h5>
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    GENERAL SERVICES OFFICE
                </h5>
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    Lucban, Quezon
                </h5>
            </div>
        </div>

        <!-- worfid -->
        <div class="grid gap-4 mb-4 grid-cols-3">
            <div class="col-span-1 sm:col-span-1"></div>
            <div class="col-span-1 sm:col-span-1"></div>
            <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                <x-input-label class="text-center text-gray-900">W.O.R.F ID</x-input-label>
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    {{ $workorder->worfid }}
                </h5>
            </div>
        </div>

        <!-- title -->
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2 sm:col-span-2">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    WORK ORDER REQUEST FORM
                </h5>
            </div>
        </div>

        <!-- requesters line 1 -->
        <div class="grid gap-4 mb-4 grid-cols-5">
            <div class="col-span-1 sm:col-span-1">
                <x-input-label class="text-right text-lg" for="workorderdesc" :value="__('Requesters Name:')" />
            </div>
            <div class="col-span-2 sm:col-span-2 border-b">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    {{ $workorder->rfullname }}
                </h5>
            </div>
            <div class="col-span-1 sm:col-span-1">
                <x-input-label class="text-center text-gray-900 text-lg" for="workorderdesc" :value="__('Date')" />
            </div>
            <div class="col-span-1 sm:col-span-1 border-b">
                <h5 class="text-center text-md font-semibold text-gray-900 ">
                    {{ $workorder->timerecorded }}
                </h5>
            </div>
        </div>
        <!-- requesters line 2 -->
        <div class="grid gap-4 mb-4 grid-cols-5">
            <div class="col-span-1 sm:col-span-1">
                <x-input-label class="text-right text-lg" for="workorderdesc" :value="__('College/Department:')" />
            </div>
            <div class="col-span-2 sm:col-span-2 border-b">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                        {{ $workorder->rdeptname }}
                </h5>
            </div>
            <div class="col-span-1 sm:col-span-1">
            </div>
            <div class="col-span-1 sm:col-span-1">
                
            </div>
        </div>

        <!-- Service Classification -->
        <div class="grid gap-4 mb-4 grid-cols-3">
            <div class="col-span-1 sm:col-span-1"></div>
            <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    SERVICE CLASSIFICATION
                </h5>
            </div>
            <div class="col-span-1 sm:col-span-1"></div>
        </div>

        <!-- Service Classification -->
        <div class="grid gap-4 mb-4 grid-cols-3">
            <div class="col-span-1 sm:col-span-1"></div>
            <div class="col-span-1 sm:col-span-1 border-b border-solid">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    {{ $workorder->workclassdesc }}
                </h5>
            </div>
            <div class="col-span-1 sm:col-span-1"></div>
        </div>
                
        <!-- Work Order Description & Image -->
        <div class="grid gap-4 mb-4 grid-cols-2">
            <!-- Work Order Description -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Description of facility to be inspected: (please attached picture)')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->workorderdesc }}
                    </h5>
                </div>
            </div>
            
            <!-- Image -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Image')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        @if(!empty($workorder->woimage))
                        <img class="h-auto max-w-xs rounded-lg" src="{{ asset("/storage/$workorder->woimage") }}">
                        @endif
                    </h5>
                </div>
            </div>
        </div>

        <!-- Noted By -->
        <div class="grid gap-4 mb-4 grid-cols-2">
            <!-- Department Head -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Noted By:')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->hfullname }}
                    </h5>
                    <x-input-label>College/Dept. Head</x-input-label>
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->hdtsigned }}
                    </h5>
                </div>
            </div>
            <!-- Verified By -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Verified By:')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->vfullname }}
                    </h5>
                    <x-input-label>GSO Supervisor</x-input-label>
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->vdtsigned }}
                    </h5>
                </div>
            </div>
        </div>

        <div class="grid gap-4 mb-4 grid-cols-3 border-t border-dashed "></div>
        <!-- supply list & EWD -->
        <div class="grid gap-4 mb-4 grid-cols-1">
            @csrf
            <!-- table -->
            <div class="max-w-7xl overflow-x-auto sm:rounded-lg mt-4" >
                <h5 class="text-lg font-semibold text-gray-900 ">
                    List & Supplies Needed
                </h5>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-900 uppercase bg-gray-50 ">
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
                        <tr class="bg-white border-b hover:bg-gray-50 ">
                        
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
                        <x-input-label class="text-lg font-semibold text-gray-900 ">Estimated No. of Working Days: {{ $workorder->eworkdays }}</x-input-label>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid gap-4 mb-4 grid-cols-3 border-t border-dashed "></div>
        <!-- inspection and acceptance -->
        <div class="grid gap-4 mb-4 grid-cols-3">
            <div class="col-span-1 sm:col-span-1"></div>
            <div class="col-span-1 sm:col-span-1 border-4 border-solid">
                <h5 class="text-center text-lg font-semibold text-gray-900 ">
                    INSPECTION AND ACCEPTANCE
                </h5>
            </div>
            <div class="col-span-1 sm:col-span-1"></div>
        </div>
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2 sm:col-span-2">
                <x-input-label>I aggree and Accept that all works has been performed to my satisfaction.</x-input-label>
            </div>
            <!-- Completed By -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group">
                    <x-input-label for="workorderdesc" :value="__('Completed By')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->cfullname }}
                    </h5>
                    <x-input-label>GSO Supervisor</x-input-label>
                </div>
            </div>
            <!-- Monitored By -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group">
                    <x-input-label for="workorderdesc" :value="__('Completed By:')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->mfullname }}
                    </h5>
                    <x-input-label>College/Dept. Head</x-input-label>
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->mdtsigned }}
                    </h5>
                </div>
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
                    <h5 class="text-lg font-semibold text-gray-900 ">
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
                    <h5 class="text-lg font-semibold text-gray-900 ">
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
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->sfullname }}
                    </h5>
                </div>
            </div>

                <!-- Schedule -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="Schedule" :value="__('Scheduled On')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->schedule }}
                    </h5>
                </div>
            </div>
            
        </div>

        <!-- Work Description -->
        <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t ">

            <!-- Priority -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Priority')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->prioritydesc }}
                    </h5>
                </div>
            </div>

            <!-- status -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->status }}
                    </h5>
                </div>
            </div>
        </div>

        <!-- Supervised -->
        <div class="grid gap-4 mb-4 grid-cols-2 border-t ">
            <!-- Time Started -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->fsfullname }}
                    </h5>
                </div>
            </div>
            <!-- Time Ended -->
            <div class="col-span-2 sm:col-span-1">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Supervised By')" />
                    <h5 class="text-lg font-semibold text-gray-900 ">
                        {{ $workorder->fdfullname }}
                    </h5>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
