<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
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
                        <a href="{{ route('managemyprofile.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            My Profile
                        </a>
                        </li>
                        
                        <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                My Informations
                            </span>
                        </div>
                        </li>

                        <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}
                            </span>
                        </div>
                        </li>
                    </ol>
                </nav>

                <!-- submenu -->
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="{{ route('managemyprofile.index') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">
                                Profile</a>
                        </li>
                            <li class="me-2">
                            <a href="{{ route('managemyprofile.myavatar') }}" class="inline-block p-4 text-gray-600 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                Avatar</a>
                        </li>
                        <li class="me-2">
                            <a href="{{ route('managemyprofile.changepassword') }}" class="inline-block p-4 text-gray-600 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                Change Password</a>
                        </li>
                        <li class="me-2">
                            <a href="{{ route('managemyprofile.signature') }}" class="inline-block p-4 text-gray-600 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                Signature</a>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('managemyprofile.update',$user->userid) }}" method="POST">
                    @csrf
                    @method('PATCH')  
                    <!-- Error & Success Notification -->
                    @include('layouts.notifications') 
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg dark:bg-gray-800">
                        <!-- Modal body -->
                        
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            

                            <!-- Email Address -->
                            <div class="col-span-2 sm:col-span-1 ">
                                <div class="form-group mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->email }}
                                    </h5>
                                </div>
                            </div>

                            <!-- First  Name -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="firstname" :value="__('First Name')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->firstname }}
                                    </h5>
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="middlename" :value="__('Middle Name')" />
                                    @if(!empty($user->middlename))
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->middlename }}
                                    </h5>
                                    @else
                                    <x-text-input id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename', $user->middlename)" required autofocus />
                                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                                    @endif
                                </div>
                            </div>
                    
                            <!-- Last Name -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="lastname" :value="__('Last Name')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->lastname }}
                                    </h5>
                                </div>
                            </div>

                            <!-- Birthday -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="birthdate" :value="__('Birthday')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->birthdate }}
                                    </h5>
                                </div>
                            </div>

                            <!-- Mobile No -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="mobile_primary" :value="__('Mobile No.')" />
                                    <x-text-input id="mobile_primary" class="block mt-1 w-full" type="text" name="mobile_primary" :value="old('mobile_primary', $user->mobile_primary)"  autofocus />
                                    <x-input-error :messages="$errors->get('mobile_primary')" class="mt-2" />
                                </div>
                            </div>
                            
                            <!-- Mobile No -->
                                <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="mobile_secondary" :value="__('Mobile No. (2)')" />
                                    <x-text-input id="mobile_secondary" name="mobile_secondary"  class="block mt-1 w-full" type="text" :value="old('mobile_secondary', $user->mobile_secondary)"  autofocus />
                                    <x-input-error :messages="$errors->get('mobile_secondary')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Home No -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="homeno" :value="__('Home No.')" />
                                    <x-text-input id="homeno" name="homeno" class="block mt-1 w-full" type="text"  :value="old('homeno', $user->homeno)"  autofocus />
                                    <x-input-error :messages="$errors->get('homeno')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Department Name -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="deptname" :value="__('Department')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->deptname }}
                                    </h5>
                                </div>
                            </div>
                            
                            <!-- Access Type -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="accessname" :value="__('Access Type')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->accessname }}
                                    </h5>
                                </div>
                            </div>

                            <!-- createdby -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="created_by" :value="__('Registered By')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->created_by }}
                                    </h5>
                                </div>
                            </div>

                            <!-- TimeDate -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="timerecorded" :value="__('Registered Date')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->timerecorded }}
                                    </h5>
                                </div>
                            </div>

                            <!-- status -->
                            <div class="col-span-2 sm:col-span-1">
                                <div class="form-group mt-4">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $user->status }}
                                    </h5>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        <div class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg class="w-4 h-4 mr-2 -ml-0.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z"/>
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                Update
                            </button>
                        </div>

                    </div>
                    
                </form>
                    
            </div>
        </div>
    </div>
</x-app-layout>
