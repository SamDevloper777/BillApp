<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Component;

class SupplierList extends Component
{
    public $name, $phone, $email, $address;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string',
    ];

   

    public function save()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        $this->reset(['name', 'phone', 'email', 'address', 'showModal']);
        session()->flash('message', 'Supplier added successfully.');
        $this->loadSuppliers();
    }
    #[On('update-supplier-list')]
    public function render()
    {
        $suppliers = Supplier::latest()->get();
        return view('livewire.admin.supplier.supplier-list', [
            'suppliers' => $suppliers,
        ]);
    }
}
