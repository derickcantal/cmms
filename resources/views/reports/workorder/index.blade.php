<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.reports.navigation')
        </div>
    </div>
	<div class="py-8 max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-8 max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
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
                                Work Order</span>
                        </div>
                        </li>
                    </ol>
                </nav> 
                <!-- searchbar -->
                <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 dark:border-gray-700 ">
                        
                        <div>

                        </div>
                        <form class="flex items-center" action="{{ route('reportshistoryworkorder.search') }}" method="get">
                            @csrf
                            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                                <select id="pagerow" name="pagerow" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" :value="old('pagerow')">
                                    <option value = "10">10</option>    
                                    <option value = "25">25</option>    
                                    <option value = "50">50</option>
                                    <option value = "100">100</option>
                                    <option value = "250">250</option>            
                                </select>
                                <select id="orderrow" name="orderrow" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" :value="old('orderrow')">
                                    <option value = "asc">A-Z</option>
                                    <option value = "desc">Z-A</option>   
                                </select>
                                <select id="workclass" name="workclass" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" :value="old('workclass')">
                                    <option value = "all">All</option>
                                    @foreach($workclass as $workclass)    
                                        <option value = "{{ $workclass->workclassdesc }}">{{ $workclass->workclassdesc }}</option>
                                    @endforeach
                                        
                                </select>
                                <div class="w-full md:w-1/2">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="search" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" >
                                    </div>
                                </div>            
                
                                <button type="submit" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    Search
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
                    
                <!-- Error & Success Notification -->
                @include('layouts.notifications') 

                @csrf
                <!-- table -->
                <div class="max-w-screen-2xl overflow-x-auto shadow-md sm:rounded-lg mt-4" >
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    W.O. No.
                                </th>
                                    <th scope="col" class="px-6 py-3">
                                    W.O. Image
                                </th>
                                
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Work Class
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Department
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Priority
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date Time Requested
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                                
                            </tr>
                        </thead>
                            @forelse ($workorder as $workorders)
                            
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            
                                <td class="px-6 py-4">
                                    <x-input-label>{{ ++$i }}</x-input-label>
                                </td>
                                <td class="px-6 py-4">
                                    <x-input-label>{{ $workorders->worfid }}</x-input-label>
                                </th>
                                <td class="px-6 py-4">
                                    <img class="w-10 h-10 rounded-sm" src="{{ asset("/storage/$workorders->woimage") }}" alt="avatar">
                                </th>
                                <td class="px-6 py-4">
                                    <x-input-label>{{ $workorders->workorderdesc }}</x-input-label>
                                </th>
                                <td class="px-6 py-4">
                                    <x-input-label>{{ $workorders->workclassdesc }}</x-input-label>
                                </th>
                                    <td class="px-6 py-4">
                                    <x-input-label>{{ $workorders->rdeptname }}</x-input-label>
                                </th>
                                <td class="px-6 py-4">
                                    @if(empty($workorders->prioritydesc))
                                    <span class="bg-red-600 text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-red-600 dark:text-white">
                                            Uncategorized 
                                    </span>
                                    @elseif($workorders->prioritydesc == 'Immediate')
                                        <span class="bg-red-600 text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-red-600 dark:text-white">
                                            Immediate 
                                    </span>
                                    @elseif($workorders->prioritydesc == 'High')
                                        <span class="bg-orange-600 text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-orange-600 dark:text-white">
                                            High 
                                    </span>
                                    @elseif($workorders->prioritydesc == 'Medium')
                                        <span class="bg-yellow-600 text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-600 dark:text-white">
                                            Medium 
                                    </span>
                                    @elseif($workorders->prioritydesc == 'Low')
                                        <span class="bg-green-600 text-white text-xs font-medium px-2 py-0.5 rounded dark:bg-green-600 dark:text-white">
                                            Low 
                                    </span>
                                    @endif
                                        <!-- <x-input-label>{{ $workorders->prioritydesc }}</x-input-label> -->
                                </th>
                                <td class="px-6 py-4">
                                        <x-input-label>{{ $workorders->timerecorded }}</x-input-label>
                                </th>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        @if($workorders->status == 'For Approval')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-yellow-600"></div>
                                        @elseif($workorders->status == 'For GSO Approval')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-yellow-600"></div>
                                        @elseif($workorders->status == 'On Process')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-blue-600"></div>
                                        @elseif($workorders->status == 'Work Started')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-green-600"></div>
                                        @elseif($workorders->status == 'Work Ended')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-blue-600"></div>
                                        @elseif($workorders->status == 'For Final Submission')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-blue-600"></div>
                                        @elseif($workorders->status == 'Work Finalized')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-green-600"></div>
                                        @elseif($workorders->status == 'Completed')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-green-600"></div>
                                        @elseif($workorders->status == 'Disapproved')
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-red-600"></div>
                                        @endif
                                        <x-input-label for="status" :value="$workorders->status"/>
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('reportshistoryworkorder.show',$workorders->workorderid) }}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                            </svg>
                                            Show
                                        </a>
                                    
                                    </div>
                                </td>
                            </tr>
                        
                            @empty
                            <td scope="row" class="px-6 py-4">
                                No Records Found.
                            </td>	
                            @endforelse
                                
                        </tbody>
                        
                    </table>
                </div>
                <div class="mt-4">
                {{ $workorder->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
