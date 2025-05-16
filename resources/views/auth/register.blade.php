<x-guest-layout>
    <!-- Error & Success Notification -->
    @include('layouts.notifications') 
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email Address -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <!-- firstname -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="firstname" :value="__('First Name')" />
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="given-name" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
        </div>
        <!-- lastname -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="lastname" :value="__('Last Name')" />
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>
        <!-- birthdate -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="birthdate" :value="__('Birth Date')" />
                <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="bday" />
                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>
        </div>
        <!-- mobile -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="mobile" :value="__('Mobile No.')" />
                <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required autofocus />
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
            </div>
        </div>
        <!-- accesstype -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="access" :value="__('Access Type')" />
                <select id="access" name="access" class="form-select mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('access')">
                    @foreach($access as $accesses)    
                        <option value = "{{ $accesses->accessid }}">{{ $accesses->accessname}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('access')" class="mt-2" />
            </div>
        </div>
        <!-- department -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="department" :value="__('Department Name')" />
                <select id="department" name="department" class="form-select mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('department')">
                    @foreach($department as $departments)    
                        <option value = "{{ $departments->deptid }}">{{ $departments->deptname}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
        </div>
        <!-- notes -->
        <div class="col-span-2 sm:col-span-1">
            <div class="form-group mt-4">
                <x-input-label for="notes" :value="__('Notes')" />
                <x-text-input id="notes" class="block mt-1 w-full" type="text" name="notes" :value="old('notes')" autofocus />
                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
