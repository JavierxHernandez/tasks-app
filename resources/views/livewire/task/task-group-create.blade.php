<div>
    <h1 class="font-bold uppercase">Create a task group</h1>

    <form wire:submit="save">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" placeholder="Name of the group"
                   wire:model="form.name"
                   class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <div>
                @error('form.name') <span class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" placeholder="Group description"
                      wire:model="form.description"
                      class="shadow appearance-none border rounded w-full
                    py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <div>
                @error('form.description') <span
                    class="bg-red-100 text-red-700 rounded">{{ $message }}</span> @enderror
            </div>
        </div>

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
            Create Group
        </button>

    </form>
</div>
