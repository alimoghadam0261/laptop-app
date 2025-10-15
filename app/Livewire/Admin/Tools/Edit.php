<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Category_tools;
use App\Models\Tools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $tool_id;
    public $name, $category_id, $status, $serial_jam, $content, $color, $size, $model, $year, $price;
    public $categories = [];

    public function mount($id)
    {
        $tool = Tools::findOrFail($id);
        $this->tool_id = $tool->id;
        $this->name = $tool->name;
        $this->category_id = $tool->category_id;
        $this->status = $tool->status;
        $this->serial_jam = $tool->serial_jam;
        $this->content = $tool->content;
        $this->color = $tool->color;
        $this->size = $tool->size;
        $this->model = $tool->model;
        $this->year = $tool->year;
        $this->price = $tool->price;

        $this->categories = Category_tools::select('id', 'name')->get();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
            'serial_jam' => 'required|unique:tools,serial_jam,' . $this->tool_id,
            'category_id' => 'required',
        ]);

        $tool = Tools::findOrFail($this->tool_id);

        $tool->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'serial_jam' => $this->serial_jam,
            'content' => $this->content,
            'color' => $this->color,
            'size' => $this->size,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
        ]);

        session()->flash('success', 'مشخصات با موفقیت به‌روزرسانی شد ✅');
        return redirect()->route('admin.tools.index');
    }

    public function render()
    {
        return view('livewire.admin.tools.edit');
    }
}
