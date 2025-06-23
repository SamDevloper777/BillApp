<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">


    <!-- Add Supplier Button -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Suppliers</h2>
        <button wire:click="$dispatch('add-supplier-modal')" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Supplier
        </button>

    </div>

    <!-- Suppliers Table -->
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $index => $supplier)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $supplier->name }}</td>
                <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                <td class="border px-4 py-2">{{ $supplier->email }}</td>
                <td class="border px-4 py-2">{{ $supplier->address }}</td>
                <td>
                    <button wire:click="$dispatch('update-supplier-modal', { id: {{ $supplier->id }} })"

                        class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </button>

                    <button wire:click="$dispatch('delete-supplier-modal', {{ $supplier->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        delete
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border px-4 py-4 text-center text-gray-500">No suppliers found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <livewire:admin.supplier.add-supplier />
    <livewire:admin.supplier.update-supplier />


</div>