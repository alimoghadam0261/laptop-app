<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ToolsExport;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 25;

    public $from_date;
    public $to_date;

    protected $queryString = ['search']; // برای حفظ سرچ در URL
    protected $updatesQueryString = ['search'];
    protected $paginationTheme = 'bootstrap'; // برای نمایش صحیح صفحه‌بندی

    public function updatingSearch()
    {
        $this->resetPage(); // در هنگام تغییر سرچ، صفحه ریست شود
    }

    public function goToShow($id)
    {
        return redirect()->route('admin.laptop.show', $id);
    }

    public function delete($id)
    {
        Digitaltool::findOrFail($id)->delete();
    }


    public function exportExcel()
    {
        $query = Digitaltool::query()
            ->select('id', 'name', 'serial_jam', 'serial_it', 'brand')
            ->with('latestHistory')
            ->orderByDesc('id');

        if ($this->from_date && $this->to_date) {
            $query->whereHas('latestHistory', function ($q) {
                $q->whereBetween('from_date', [$this->from_date, $this->to_date]);
            });
        }

        $tools = $query->get();

        return Excel::download(new ToolsExport($tools), 'tools_export.xlsx');
    }




    public function render()
    {
        $tools = Digitaltool::query()
            ->select('id', 'name', 'serial_jam', 'serial_it', 'brand')
            ->with('latestHistory')
            ->when(strlen($this->search) > 0, function ($query) {
                $query->where(function ($q) {
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
