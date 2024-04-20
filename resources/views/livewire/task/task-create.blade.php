<div>
    <h1 class="font-bold uppercase">Create a task</h1>
    <form wire:submit="save">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" placeholder="Name of the task"
                   wire:model="form.name"
                   class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <div>
                @error('form.name') <span class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" placeholder="Task description"
                      wire:model="form.description"
                      class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <div>
                @error('form.description') <span
                    class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="startDate" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
            <input type="date" name="startDate" id="startDate" min="{{now()->format('Y-m-d')}}"
                   wire:model="form.startDate"
                   class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <div>
                @error('form.startDate') <span
                    class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="endDate" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
            <input type="date" name="endDate" id="endDate" min="{{now()->format('Y-m-d')}}"
                   wire:model="form.endDate"
                   class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <div>
                @error('form.endDate') <span class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="frequencyId" class="block text-gray-700 text-sm font-bold mb-2">Frequency</label>
            <select name="frequencyId" id="frequencyId"
                    wire:model.live="form.frequencyId"
                    class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select a frequency...</option>
                @foreach($frequencies as $frequency)
                    <option value="{{ $frequency->id }}">{{ $frequency->description }}</option>
                @endforeach
            </select>
            <div>
                @error('form.frequencyId') <span
                    class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        @if($form->frequencyId == 2)
            <div class="mb-4">
                <label for="" class="block text-gray-700 text-sm font-bold mb-2">Repeat Days</label>
                @foreach($daysOptions as $day)
                    <div>
                        <input type="checkbox" id="{{ $day }}" value="{{ $day }}" wire:model="form.days">
                        <label for="{{ $day }}">{{ $day }}</label>
                    </div>
                @endforeach
                <div>
                    @error('form.days') <span class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <div class="flex mb-4">
            @if($form->frequencyId == 3 || $form->frequencyId == 4)
                <div class="w-1/2 pr-2">
                    <label for="dayOfMonth" class="block text-gray-700 text-sm font-bold mb-2">Day of the Month</label>
                    <input type="number" name="dayOfMonth" id="dayOfMonth" min="1" max="31"
                           wire:model="form.dayOfMonth"
                           class="shadow appearance-none border rounded w-full
                        py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div>
                        @error('form.dayOfMonth')
                        <span class="bg-red-100 text-red-700 rounded">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                </div>
            @endif
            @if($form->frequencyId == 4)
                <div class="w-1/2 pl-2">
                    <label for="monthOfYear" class="block text-gray-700 text-sm font-bold mb-2">Month of the
                        Year</label>
                    <input type="number" name="monthOfYear" id="monthOfYear" min="1" max="12"
                           wire:model="form.monthOfYear"
                           class="shadow appearance-none border rounded w-full
                        py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div>
                        @error('form.monthOfYear')
                        <span class="bg-red-100 text-red-700 rounded">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                </div>
            @endif
        </div>

        @if($taskGroups->count() > 0)
            <div class="mb-4">
                <label for="taskGroupId" class="block text-gray-700 text-sm font-bold mb-2">Task Group</label>
                <select name="taskGroupId" id="taskGroupId"
                        wire:model="form.taskGroupId"
                        class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select a Task Group...</option>
                    @foreach($taskGroups as $taskGroup)
                        <option value="{{ $taskGroup->id }}">
                            {{ $taskGroup->name }}
                        </option>
                    @endforeach
                </select>
                <div>
                    @error('form.taskGroupId') <span
                        class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <button class="bg-blue-500 hover:bg-blue-700 text-white
         font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            <div wire:loading>
                <div class="flex justify-center">
                    <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25"
                                cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373
                           0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            Create Task
        </button>
    </form>
</div>
