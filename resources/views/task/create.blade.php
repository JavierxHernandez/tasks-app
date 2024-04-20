<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w flex">
                    <div class="w-1/2 m-2">
                        @livewire('task-create')
                    </div>
                    <div class="w-1/2 m-2">
                        @livewire('task-group-create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
