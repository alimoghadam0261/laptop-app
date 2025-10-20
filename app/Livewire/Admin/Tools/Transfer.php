<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Tools;
use Livewire\Component;

class Transfer extends Component
{
    public $tools_id;
    public $tools;
    public $name_receiver;
    public $card_number;
    public $phone;
    public $name_project;
    public $from_date;
    public $to_date;
    public $status = 'return';

    public function mount()
    {
        $this->tools = Tools::all();
    }

    public function save()
    {
        $this->validate([
            'tools_id' => 'required|exists:tools,id',
            'name_receiver'  => 'required|string|min:3',
            'card_number'    => 'required|string',
            'phone'          => 'required|min:11|max:11',
            'name_project'   => 'required|string|min:3',
            'from_date'      => 'required|date',
        ]);

        $tool = Tools::findOrFail($this->tools_id);

        $tool->histories()->create([
            'name_receiver' => $this->name_receiver,
            'card_number'   => $this->card_number,
            'phone'         => $this->phone,
            'content'       => $this->content ?? '-', // <-- اضافه شد
            'name_project'  => $this->name_project,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'status'        => $this->status,

        ]);

        session()->flash('message', 'لپتاپ با موفقیت تحویل داده شد!');
        return redirect()->route('admin.tools.index');
    }



    public function render()
    {

        return view('livewire.admin.tools.transfer');
    }
}
