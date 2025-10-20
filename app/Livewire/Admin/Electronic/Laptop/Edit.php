<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $edit;

    public $name,$brand,$serial_it,$serial_jam,
    $cpu,$ram,$content;
    public $accessories=[];


    public function mount($id)
    {
        $this->edit = Digitaltool::findOrFail($id);
        $this->name = $this->edit->name;
        $this->brand = $this->edit->brand;
        $this->serial_it = $this->edit->serial_it;
        $this->serial_jam = $this->edit->serial_jam;
        $this->cpu = $this->edit->cpu;
        $this->ram = $this->edit->ram;
        $this->content = $this->edit->content;

        // همیشه accessories را آرایه نگه دارید
        $this->accessories = is_array($this->edit->accessories)
            ? $this->edit->accessories
            : json_decode($this->edit->accessories ?? '[]', true);
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'serial_it' => [
                'required',
                Rule::unique('digitaltools', 'serial_it')->ignore($this->edit->id),
            ],
            'serial_jam' => [
                'required',
                Rule::unique('digitaltools', 'serial_jam')->ignore($this->edit->id),
            ],
            'brand' => 'required|min:2',
            'cpu' => 'required|min:2',
            'ram' => 'required|min:2',
            'content' => 'required|min:3',
        ];
    }



    public function update()
    {


        $this->validate();


// مطمئن می‌شویم که accessories به صورت آرایه هست
        if (is_string($this->accessories)) {
            $decoded = json_decode($this->accessories, true);
            $this->accessories = is_array($decoded) ? $decoded : [$this->accessories];
        }


        $this->edit->update([
            'name' => $this->name,
            'brand' => $this->brand,
            'serial_it' => $this->serial_it,
            'serial_jam' => $this->serial_jam,
            'cpu' => $this->cpu,
            'ram' => $this->ram,
            'content' => $this->content,
            'accessories' => $this->accessories,
        ]);


        session()->flash('success', 'تغییرات با موفقیت ذخیره شد');
        return redirect()->route('admin.laptop.index');
    }


    public function render()
    {
        return view('livewire.admin.electronic.laptop.edit');
    }
}
