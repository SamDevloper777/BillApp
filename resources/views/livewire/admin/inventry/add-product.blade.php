<div class="p-6 max-w-5xl mx-auto bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Add Product</h2>
    @if (session()->has('message'))
        <div class="text-green-600 mb-4">{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-4">
            <input type="text" wire:model.defer="name" placeholder="Product Name" class="border p-2 rounded">
            <input type="text" wire:model.defer="sku" placeholder="SKU" class="border p-2 rounded">

            <select wire:model.defer="category" class="border p-2 rounded">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select wire:model.defer="metal_type" class="border p-2 rounded">
                <option value="">Select Metal</option>
                @foreach($metals as $metal)
                    <option value="{{ $metal->id }}">{{ $metal->name }}</option>
                @endforeach
            </select>

            <input type="text" wire:model.defer="purity" placeholder="Purity (e.g. 22K)" class="border p-2 rounded">
            <input type="number" wire:model.defer="net_weight" placeholder="Net Weight" class="border p-2 rounded">
            <input type="number" wire:model.defer="gross_weight" placeholder="Gross Weight" class="border p-2 rounded">
            <input type="number" wire:model.defer="wastage_percent" placeholder="Wastage (%)" class="border p-2 rounded">
            <input type="number" wire:model.defer="making_charge" placeholder="Making Charge" class="border p-2 rounded">
            <input type="number" wire:model.defer="stone_weight" placeholder="Stone Weight" class="border p-2 rounded">
            <input type="text" wire:model.defer="stone_type" placeholder="Stone Type" class="border p-2 rounded">
            <input type="number" wire:model.defer="purchase_price" placeholder="Purchase Price" class="border p-2 rounded">
            <input type="number" wire:model.defer="sale_price" placeholder="Sale Price" class="border p-2 rounded">
            <input type="number" wire:model.defer="stock_qty" placeholder="Stock Quantity" class="border p-2 rounded">
            <input type="file" wire:model="image_path" class="border p-2 rounded">
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
