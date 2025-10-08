<?php

namespace App\Livewire\Admin;

use App\Models\Digitaltool;
use Livewire\Component;

class Dashboard extends Component
{
    public $countall;
    public $countlaptop;
    public $counttablet;

    public function mount()
    {
        $this->countall = Digitaltool::all()->count();
        $this->countlaptop = Digitaltool::where('name', 'laptop')->count();

        $this->counttablet = Digitaltool::where('name', 'تبلت')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
