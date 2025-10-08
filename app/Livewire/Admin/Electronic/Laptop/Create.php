<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use Livewire\Component;

class Create extends Component
{
    // مشخصات ثابت لپتاپ
    public $name;
    public $serial_it;
    public $serial_jam;
    public $brand;
    public $cpu;
    public $ram;
    public $content;
    public $accessories = [];

    // مشخصات تحویل
    public $card_number;
    public $name_receiver;
    public $phone;
    public $name_project;
    public $from_date;
    public $to_date;
    public $status ='بازگشت'; // پیش‌فرض

    public function save()
    {
        $this->validate([
            // لپتاپ
            'name'       => 'required|string|max:255',
            'serial_it'  => 'required|unique:digitaltools,serial_it',
            'serial_jam' => 'required|unique:digitaltools,serial_jam',
            'brand'      => 'required|min:2',
            'cpu'        => 'required|min:2',
            'ram'        => 'required|min:2',
            'content'    => 'required|min:3',
            // تحویل
            'card_number'  => 'required|string',
            'name_receiver' => 'required|string|min:3',
            'phone'        => 'required|min:11|max:11',
            'name_project' => 'required|string|min:3',
            'from_date'    => 'required|date',
        ]);

        // ذخیره لپتاپ
        $laptop = Digitaltool::create([
            'name'        => $this->name,
            'serial_it'   => $this->serial_it,
            'serial_jam'  => $this->serial_jam,
            'brand'       => $this->brand,
            'cpu'         => $this->cpu,
            'ram'         => $this->ram,
            'status'         => $this->status,
            'content'     => $this->content,
            'accessories' => json_encode($this->accessories),
        ]);

        // ذخیره تاریخچه‌ی اولیه
        $laptop->histories()->create([
            'card_number'  => $this->card_number,
            'status'       => $this->status,
            'name_receiver'         => $this->name_receiver,
            'phone'        => $this->phone,
            'name_project' => $this->name_project,
            'from_date'    => $this->from_date,
            'to_date'      => $this->to_date,
            'content'      => $this->content,
            'accessories'  => json_encode($this->accessories),
        ]);

        session()->flash('message', 'لپتاپ و اولین تحویل با موفقیت ذخیره شدند!');
        return redirect()->route('admin.laptop.index');
    }

    public function render()
    {
        return view('livewire.admin.electronic.laptop.create');
    }
}
