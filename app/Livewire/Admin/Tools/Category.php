<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Category_tools;
use Livewire\Component;

class Category extends Component
{
    public $name;
    public $description;
    public $category;

    public function mount()
    {
        $this->category = Category_tools::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Category_tools::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // ریست فرم
        $this->reset(['name', 'description']);

        // بروز رسانی لیست
        $this->category = Category_tools::all();

        // پیام موفقیت
        session()->flash('success', 'ابزار جدید با موفقیت ثبت شد ✅');
    }

    public function delete($id)
    {
        $tool = Category_tools::findOrFail($id);
        $tool->delete();

        // بروز رسانی لیست
        $this->category = Category_tools::all();

        // پیام حذف
        session()->flash('success', 'دسته بندی با موفقیت حذف شد ✅');
    }

    public function render()
    {
        return view('livewire.admin.tools.category');
    }
}
