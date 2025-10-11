<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Tools;
use Livewire\Component;

class Index extends Component
{
    public $tools;

    public function mount()
    {
        $this->tools = Tools::all();
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
