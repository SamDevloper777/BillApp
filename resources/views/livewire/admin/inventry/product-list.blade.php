<div>
    <div class="p-6">
    <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Product</a>

    @if (session()->has('message'))
        <div class="text-green-600 mt-4">{{ session('message') }}</div>
    @endif

    <table class="w-full mt-4 table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">SKU</th>
                <th class="p-2">Name</th>
                <th class="p-2">Metal</th>
                <th class="p-2">Purity</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-t">
                    <td class="p-2">{{ $product->sku }}</td>
                    <td class="p-2">{{ $product->name }}</td>
                    <td class="p-2">{{ $product->metal->name ?? '-' }}</td>
                    <td class="p-2">{{ $product->purity }}</td>
                    <td class="p-2">{{ $product->stock_qty }}</td>
                    <td class="p-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                        <button wire:click="delete({{ $product->id }})" class="text-red-500 ml-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>