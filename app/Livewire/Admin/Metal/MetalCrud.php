<?php

namespace App\Livewire\Admin\Metal;

use App\Models\Metal;
use Livewire\Component;

class MetalCrud extends Component
{
     public $metals, $name, $metalId;
    public $showModal = false;

    public function mount()
    {
        $this->metals = Metal::all();
        $this->resetInput();
    }
  
    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $metal = Metal::findOrFail($id);
        $this->name = $metal->name;
        $this->metalId = $id;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:metals,name,' . $this->metalId,
        ]);

        Metal::updateOrCreate(
            ['id' => $this->metalId],
            ['name' => $this->name]
        );

        $this->showModal = false;
        $this->resetInput();
    }

    public function delete($id)
    {
        Metal::destroy($id);
    }

    public function resetInput()
    {
        $this->name = '';
        $this->metalId = null;
    }
    public function render()
    {   
        return view('livewire.admin.metal.metal-crud');
    }
}
