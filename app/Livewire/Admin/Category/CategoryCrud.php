<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CategoryCrud extends Component
{   
    public $name = '';
    public $status = true;
    public $parent_id = null;
    public $categoryId = null;
    public $isEditing = false;
    public $showModal = false;

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $this->categoryId,
        ]);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status,
            'parent_id' => $this->parent_id,
        ];

        if ($this->isEditing && $this->categoryId) {
            Category::findOrFail($this->categoryId)->update($data);
        } else {
            Category::create($data);
        }

        $this->resetForm();
        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->name = $category->name;
        $this->status = $category->status;
        $this->parent_id = $category->parent_id;
        $this->categoryId = $category->id;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Category::destroy($id);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->status = true;
        $this->parent_id = null;
        $this->categoryId = null;
        $this->isEditing = false;
    }
    public function render()
    {
        return view('livewire.admin.category.category-crud', [
            'categories' => Category::with('parent')->latest()->get(),
            'parents' => Category::whereNull('parent_id')->where('id', '!=', $this->categoryId)->get(),
        ]);
    }
}
