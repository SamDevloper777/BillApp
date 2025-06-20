<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow mt-10">

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
                <h2 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Category' : 'Add Category' }}</h2>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold">Name</label>
                        <input type="text" wire:model="name" class="w-full border px-4 py-2 rounded">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold">Parent Category</label>
                        <select wire:model="parent_id" class="w-full border px-4 py-2 rounded">
                            <option value="">-- None --</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="status" class="form-checkbox">
                            <span class="ml-2 text-gray-700">Active</span>
                        </label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $isEditing ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Add Button -->
    <div class="flex justify-end mb-4">
        <button wire:click="openModal" class="px-4 py-2 bg-green-600 text-white rounded">+ Add Category</button>
    </div>

    <!-- Table -->
    <table class="w-full border text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Slug</th>
                <th class="border px-4 py-2">Parent</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="border px-4 py-2">{{ $category->id }}</td>
                    <td class="border px-4 py-2">{{ $category->name }}</td>
                    <td class="border px-4 py-2">{{ $category->slug }}</td>
                    <td class="border px-4 py-2">{{ $category->parent->name ?? '—' }}</td>
                    <td class="border px-4 py-2">
                        <span class="text-xs px-2 py-1 rounded {{ $category->status ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $category->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $category->id }})" onclick="return confirm('Are you sure?')" class="text-red-600">Delete</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">No categories found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
