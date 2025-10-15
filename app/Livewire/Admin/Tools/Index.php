<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Tools;
use Livewire\Component;

class Index extends Component
{
    public $tools;
    public $sortBy = 'name'; // پیش‌فرض مرتب‌سازی بر اساس نام
    public $perPage = 10;
    public $search = '';

    public function updatedSortBy()
    {
        // وقتی کاربر مرتب سازی را تغییر داد، جدول دوباره رفرش شود
        $this->mount();
    }

    public function mount()
    {
        $query = Tools::query()->with('category');

        // جستجو
        if ($this->search) {
            $query->where(function($q){
                $q->where('name','like','%'.$this->search.'%')
                    ->orWhere('serial_jam','like','%'.$this->search.'%');
            });
        }

        // مرتب سازی
        if ($this->sortBy == 'category') {
            // مرتب سازی بر اساس نام دسته بندی
            $query->join('category_tools', 'tools.category_id', '=', 'category_tools.id')
                ->orderBy('category_tools.name')
                ->select('tools.*'); // فقط ستون های ابزار را نگه می‌داریم
        } else {
            $query->orderBy($this->sortBy);
        }

        $this->tools = $query->get();
    }


    public function delete($id)
    {
        Tools::findOrFail($id)->delete();
        session()->flash('success','ابزار حذف شد');
        $this->mount(); // دوباره رفرش جدول
    }

    public function goToShow($id)
    {
        return redirect()->route('admin.tools.show', $id);
    }

    public function render()
    {
        return view('livewire.admin.tools.index');
    }
}
