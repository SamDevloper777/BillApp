<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateSupplier extends Component
{
     public $name, $phone, $email, $address;
    public $showModal = false;
    public $supplierId = null;
    public $supplier;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string',
    ];

    #[On('update-supplier-modal')]
    public function loadSupplier($id)
    {
        $this->supplier = Supplier::findOrFail($id);
        $this->supplierId = $this->supplier->id;
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->email = $this->supplier->email;
        $this->address = $this->supplier->address;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {
        $this->validate();

        $this->supplier->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Supplier updated successfully.');

        $this->resetForm();
        $this->showModal = false;
        $this->dispatch('update-supplier-list');
    }

    public function resetForm()
    {
        $this->reset(['name', 'phone', 'email', 'address', 'supplierId']);
        $this->supplier = null;
    }

    public function render()
    {
        return view('livewire.admin.supplier.update-supplier');
    }
}
