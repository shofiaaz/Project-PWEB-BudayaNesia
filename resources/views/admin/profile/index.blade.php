@extends('layouts.appAdmin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="space-y-6">
                    <!-- Header Section -->
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Admin Profile
                        </h2>
                    </div>

                    <!-- Profile Information -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <span class="font-medium text-gray-700 dark:text-white w-20">Name:</span>
                            <span class="text-gray-900 dark:text-white">{{ $admin->username }}</span>
                        </div>

                        <div class="flex items-center space-x-4">
                            <span class="font-medium text-gray-700 dark:text-gray-300 w-20">Email:</span>
                            <span class="text-gray-900 dark:text-white">{{ $admin->email }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-4">
                        <a href="{{ route('admin.profile.edit') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#800000] text-white rounded-md hover:bg-[#600000] transition-colors duration-200">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
