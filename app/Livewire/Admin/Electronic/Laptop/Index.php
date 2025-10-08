<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 25;


    public function goToShow($id)
    {
        return redirect()->route('admin.laptop.show', $id);
    }

    public function delete($id)
    {
        Digitaltool::findOrFail($id)->delete();
    }

    public function render()
    {
        $tools = Digitaltool::query()
            ->select('id','name','serial_jam','serial_it','brand')
            ->with('latestHistory') // ← اینو استفاده کن
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('serial_jam', 'like', "%{$this->search}%")
                        ->orWhere('serial_it', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($this->perPage);


        return view('livewire.admin.electronic.laptop.index', compact('tools'));
    }
}
