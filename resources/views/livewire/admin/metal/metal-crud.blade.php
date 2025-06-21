<div>
   <div class="p-6">
    <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded">Add Metal</button>

    <table class="table-auto w-full mt-4 border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metals as $metal)
                <tr class="border-t">
                    <td class="p-2">{{ $metal->name }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $metal->id }})" class="text-blue-500">Edit</button>
                        <button wire:click="delete({{ $metal->id }})" class="text-red-500 ml-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
            <div class="bg-white rounded p-6 w-full max-w-md shadow-lg">
                <h2 class="text-xl font-bold mb-4">{{ $metalId ? 'Edit' : 'Add' }} Metal</h2>
                <form wire:submit.prevent="save">
                    <input type="text" wire:model.defer="name" placeholder="Metal Name" class="w-full border rounded p-2 mb-4">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
                        <button type="button" wire:click="$set('showModal', false)" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

</div>
