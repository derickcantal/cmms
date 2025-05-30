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
                <form action="{{ route('transactionworkorder.verify',$workorder->workorderid) }}" enctype="multipart/form-data" method="POST" class="p-4 md:p-5">
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
                                        Verify Work Order
                                    </span>
                                </div>
                                </li>

                                <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        {{ $workorder->rfullname }}
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
                                <!-- workorderfid -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="worfid" :value="__('Work Order Referrence ID')" />
                                        <x-text-input id="worfid" class="block mt-1 w-full" type="text" name="worfid" :value="old('worfid',$setnewworf)" required readonly  />
                                        <x-input-error :messages="$errors->get('worfid')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- workd order desc -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="workorderdesc" :value="__('Work Order Description')" />
                                        <x-text-input id="workorderdesc" class="block mt-1 w-full" type="text" name="workorderdesc" :value="old('workorderdesc',$workorder->workorderdesc)" readonly autofocus />
                                        <x-input-error :messages="$errors->get('workorderdesc')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Requested By -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="rfullname" :value="__('Requested By')" />
                                        <x-text-input id="rfullname" class="block mt-1 w-full" type="text" name="rfullname" :value="old('rfullname',$workorder->rfullname)" readonly autofocus />
                                        <x-input-error :messages="$errors->get('rfullname')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Noted By -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="hfullname" :value="__('Noted By')" />
                                        <x-text-input id="hfullname" class="block mt-1 w-full" type="text" name="hfullname" :value="old('hfullname',$workorder->hfullname)" readonly autofocus />
                                        <x-input-error :messages="$errors->get('hfullname')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Personnel Assignment -->
                            <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                <!-- Personnel -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="personnel" :value="__('Assign Personnel')" />
                                        <select id="personnel" name="personnel" class="form-select mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('personnel')">
                                              @foreach($personnel as $personnel)    
                                                <option value = "{{ $personnel->userid }}">{{ $personnel->lastname }}, {{ $personnel->firstname }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('personnel')" class="mt-2" />
                                    </div>
                                </div>

                            </div>

                            <!-- Prioritization -->
                            <div class="grid gap-4 mb-4 grid-cols-2 border-t rounded-t dark:border-gray-600">
                                

                                <!-- start date -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="start" :value="__('Scheduled (Start)')" />
                                        <x-text-input id="start" class="block mt-1 w-full" type="date" name="start" :value="old('start',$workorder->start)" required autofocus />
                                        <x-input-error :messages="$errors->get('start')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- start time -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <form class="max-w-[8.5rem] mx-auto">
                                            <label for="starttime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select time: (Start)</label>
                                            <div class="flex">
                                                <input type="time" id="starttime" name="starttime" class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="05:00" max="18:00" value="00:00" required>
                                                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>

                                <!-- end date -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="end" :value="__('Scheduled (End)')" />
                                        <x-text-input id="end" class="block mt-1 w-full" type="date" name="end" :value="old('end',$workorder->schedule)" required autofocus />
                                        <x-input-error :messages="$errors->get('end')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- end time -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <!-- <form class="max-w-[8.5rem] mx-auto"> -->
                                            <label for="endtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select time: (end)</label>
                                            <div class="flex">
                                                <input type="time" id="etime" name="etime" class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="05:00" max="18:00" value="00:00" required>
                                                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- priority -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="priority" :value="__('Priority')" />
                                        <select id="priority" name="priority" class="form-select mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('priority')">
                                            <option value = "0">Emergency</option>
                                            <option value = "1">High</option>
                                            <option value = "2">Moderate</option>
                                            <option value = "3">Low</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- eworkdays -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="eworkdays" :value="__('Estimated Work Days')" />
                                        <x-text-input id="eworkdays" class="block mt-1 w-full" type="text" name="eworkdays" :value="old('eworkdays',$workorder->eworkdays)" required autofocus />
                                        <x-input-error :messages="$errors->get('eworkdays')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- notes -->
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="form-group mt-4">
                                        <x-input-label for="notes" :value="__('Notes')" />
                                        <x-text-input id="notes" class="block mt-1 w-full" type="text" name="notes" :value="old('notes',$workorder->notes)" autofocus />
                                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
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
                                Save
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
