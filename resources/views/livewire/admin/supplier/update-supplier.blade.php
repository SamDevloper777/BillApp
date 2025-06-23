<div>
    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                
                <!-- Close Button -->
                <button wire:click="closeModal" 
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">
                    &times;
                </button>

                <!-- Modal Title -->
                <h2 class="text-xl font-bold mb-4">
                    Edit Supplier
                </h2>

                <!-- Form -->
                <form wire:submit.prevent="save">
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block font-medium">Name</label>
                        <input type="text" wire:model.defer="name" class="w-full border rounded px-3 py-2" />
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block font-medium">Phone</label>
                        <input type="text" wire:model.defer="phone" class="w-full border rounded px-3 py-2" />
                        @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" wire:model.defer="email" class="w-full border rounded px-3 py-2" />
                        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block font-medium">Address</label>
                        <textarea wire:model.defer="address" class="w-full border rounded px-3 py-2"></textarea>
                        @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal" class="mr-2 px-4 py-2 border rounded">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
