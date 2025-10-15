<?php

namespace App\Livewire\Admin;

use App\Models\Digitaltool;
use App\Models\Tools;
use Livewire\Component;

class Dashboard extends Component
{
    public $countall;
    public $countlaptop;
    public $counttablet;
    public $countcomputer;
    public $countmobile;

    public function mount()
    {
        $this->countall = Digitaltool::all()->count() + Tools::all()->count();

        $this->countcomputer = Digitaltool::where('name', 'کامپیوتر')->count();
        $this->countlaptop = Digitaltool::where('name', 'لپتاپ')->count();
        $this->counttablet = Digitaltool::where('name', 'تبلت')->count();
        $this->countmobile = Digitaltool::where('name', 'موبایل')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
