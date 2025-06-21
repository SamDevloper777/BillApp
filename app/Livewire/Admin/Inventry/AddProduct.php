<?php

namespace App\Livewire\Admin\Inventry;

use App\Models\Category;
use App\Models\Metal;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public $name, $sku, $category, $metal_type, $purity;
    public $net_weight, $gross_weight, $wastage_percent, $making_charge;
    public $stone_weight, $stone_type, $purchase_price, $sale_price;
    public $stock_qty, $image_path;

   

    public function save()
    {
        $data = $this->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'category' => 'required|integer',
            'metal_type' => 'required|integer',
            'purity' => 'required',
            'net_weight' => 'required|numeric',
            'gross_weight' => 'nullable|numeric',
            'wastage_percent' => 'nullable|numeric',
            'making_charge' => 'nullable|numeric',
            'stone_weight' => 'nullable|numeric',
            'stone_type' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock_qty' => 'required|integer',
            'image_path' => 'nullable|image|max:2048'
        ]);

        if ($this->image_path) {
            $data['image_path'] = $this->image_path->store('products', 'public');
        }

        Product::create($data);

        session()->flash('message', 'Product added!');
        return redirect()->route('products.index');
    }
    public function render()
    {
        return view('livewire.admin.inventry.add-product',[
            'metals' => Metal::all(),
            'categories' => Category::all(),
        ]);
    }
}
