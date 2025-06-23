<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Component;

class AddSupplier extends Component
{
        public $name, $phone, $email, $address;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string',
    ];

    #[On('add-supplier-modal')]
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'phone', 'email', 'address']);
    }

    public function save()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Supplier added successfully.');

        $this->reset(['name', 'phone', 'email', 'address', 'showModal']);
        $this->dispatch('update-supplier-list');
    }

    public function render()
    {
        return view('livewire.admin.supplier.add-supplier');
    }
}
