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
                <x-input-label>GSO Supervisor - Signature</x-input-label>
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
                    <x-input-label>GSO Personnel</x-input-label>
                </div>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <x-input-label>GSO Personnel - Signature</x-input-label>
                @if(!empty($workorder->csignimage))
                    <img class="h-18 w-36 object-contain rounded-lg" src="{{ asset("/storage/$workorder->csignimage") }}">
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

        <!-- Personnel -->
        <div class="grid gap-4 mb-4 grid-cols-2 border-t">
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

        <!-- Time -->
        <div class="grid gap-4 mb-4 grid-cols-4 ">
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
            <!-- Time Ended -->
            <div class="col-span-2 sm:col-span-2">
                <div class="form-group mt-4">
                    <x-input-label for="workorderdesc" :value="__('Remarks')" />
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $workorder->remarks }}
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

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
