<div>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow mt-10">

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0  bg-black/20 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-8 relative">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800 border-b pb-2">{{ $isEditing ? 'Edit Category' : 'Add Category' }}</h2>

                <form wire:submit.prevent="save" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="name" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Parent Category</label>
                        <select wire:model="parent_id" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- None --</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" wire:model="status" class="sr-only">
                                <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                            </div>
                            <span class="ml-3 text-gray-700">Active</span>
                        </label>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ $isEditing ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Add Button -->
    <div class="flex justify-end mb-6">
        <button wire:click="openModal" class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">+ Add Category</button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 border">ID</th>
                    <th class="px-4 py-3 border">Name</th>
                    <th class="px-4 py-3 border">Slug</th>
                    <th class="px-4 py-3 border">Parent</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $category->id }}</td>
                        <td class="px-4 py-2 border font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-2 border text-gray-600">{{ $category->slug }}</td>
                        <td class="px-4 py-2 border">{{ $category->parent->name ?? '—' }}</td>
                        <td class="px-4 py-2 border">
                            <label class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" wire:click="toggleStatus({{ $category->id }})" {{ $category->status ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition-all"></div>
                                <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full peer-checked:translate-x-full transition-transform"></div>
                            </label>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $category->id }})" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-6 text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .dot {
        transition: transform 0.3s ease-in-out;
    }
    input:checked ~ .dot {
        transform: translateX(100%);
    }
</style>

</div>