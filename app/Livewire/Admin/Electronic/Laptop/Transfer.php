<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use Livewire\Component;

class Transfer extends Component
{
    public $digitaltool_id;
    public $name_receiver;
    public $card_number;
    public $phone;
    public $name_project;
    public $from_date;
    public $to_date;
    public $status = 'تحویل';
    public $latitude;
    public $longitude;

    public function save()
    {
        $this->validate([
            'digitaltool_id' => 'required|exists:digitaltools,id',
            'name_receiver'  => 'required|string|min:3',
            'card_number'    => 'required|string',
            'phone'          => 'required|min:11|max:11',
            'name_project'   => 'required|string|min:3',
            'from_date'      => 'required|date',
        ]);

        $laptop = Digitaltool::findOrFail($this->digitaltool_id);

        $laptop->histories()->create([
            'name_receiver' => $this->name_receiver,
            'card_number'   => $this->card_number,
            'phone'         => $this->phone,
            'content'       => $this->content ?? '-', // <-- اضافه شد
            'name_project'  => $this->name_project,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'status'        => $this->status,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
        ]);

        session()->flash('message', 'لپتاپ با موفقیت تحویل داده شد!');
        return redirect()->route('admin.laptop.index');
    }

    public function render()
    {
        $laptops = Digitaltool::all();
        return view('livewire.admin.electronic.laptop.transfer', compact('laptops'));
    }
}
