<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                @include('components.custom-alert')

                @include('superadmin.partials.button')

                @include('superadmin.partials.table')

                @include('components.custom-pagination')

            </div>
        </div>
    </div>

    @include('superadmin.partials.modal')

</x-app-layout>

@include('superadmin.partials.footer')
