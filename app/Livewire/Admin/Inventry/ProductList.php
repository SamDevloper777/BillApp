<?php

namespace App\Livewire\Admin\Inventry;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
     public $products;
    public $selectedProductId = null;


    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted!');
    }
    public function render()
    {
        $this->products = Product::with('metal', 'categoryRelation')->latest()->get();
        return view('livewire.admin.inventry.product-list');
    }
}
