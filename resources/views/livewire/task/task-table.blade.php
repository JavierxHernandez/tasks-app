<div>
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
        <a href="{{ route('task.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Create Task') }}
        </a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($tasks as $group => $groupTasks)
                        <h3 class="text-lg font-bold mb-2">{{ $group }}</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Task Name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Frequency') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Start Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('End Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Iteration') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs
                                     font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($groupTasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->frequency->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($task->start_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($task->end_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->iteration_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->is_completed ? __('Completed') : __('Pending') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if (!$task->is_completed && $task->iteration_count > 0 && $group == 'Tasks Today')
                                            <button wire:click="markAsCompleted({{ $task->id }})"
                                                    class="font-bold text-indigo-600 hover:text-indigo-900">
                                                {{ __('Done') }}
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        {{ __('No tasks to display.') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
