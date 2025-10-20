<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digital_history;
use App\Models\Digitaltool;
use Livewire\Component;

class Show extends Component
{
    public $tools;
    public $histories;

    public function mount($id)
    {
        // ابزار اصلی
        $this->tools = Digitaltool::findOrFail($id);

        // جدول: نزولی (جدیدترین بالا)
        $this->histories = Digital_history::where('digitaltool_id', $id)
            ->orderByDesc('from_date')
            ->get();
    }

    public function deleteHistory($id)
    {
        $history = Digital_history::find($id);

        if ($history) {
            $history->delete();
            session()->flash('message', 'رکورد با موفقیت حذف شد.');
        } else {
            session()->flash('error', 'رکورد مورد نظر یافت نشد.');
        }

        // جدول را مجدداً بارگذاری کن
        $this->histories = Digital_history::where('digitaltool_id', $this->tools->id)
            ->orderByDesc('from_date')
            ->get();
    }

    public function render()
    {
        // گراف از قدیمی‌ترین به جدیدترین (صعودی)
        $graphHistories = Digital_history::where('digitaltool_id', $this->tools->id)
            ->orderBy('from_date', 'asc')
            ->get();

        // نود اصلی ابزار
        $nodes = [
            ['id' => 'tool_' . $this->tools->id, 'label' => $this->tools->name, 'status' => 'اصلی']
        ];

        $edges = [];

        // ساخت گراف از تاریخچه‌ها
        foreach ($graphHistories as $index => $history) {
            $nodeId = 'history_' . $history->id;
            $nodes[] = [
                'id' => $nodeId,
                'label' => $history->name_receiver . "\n" . $history->status . "\n" . jdate($history->from_date)->format('Y-m-d'),
                'status' => $history->status,
                'shape' => 'box'
            ];

            if ($index === 0) {
                // اولین تحویل از ابزار
                $edges[] = [
                    'from' => 'tool_' . $this->tools->id,
                    'to' => $nodeId,
                    'label' => 'اولین تحویل'
                ];
            } else {
                // اتصال تاریخچه‌های متوالی
                $prevHistory = $graphHistories[$index - 1];
                $edges[] = [
                    'from' => 'history_' . $prevHistory->id,
                    'to' => $nodeId,
                    'label' => 'بعدی'
                ];
            }
        }

        return view('livewire.admin.electronic.laptop.show', [
            'nodes' => $nodes,
            'edges' => $edges,
            'histories' => $this->histories,
            'tools' => $this->tools
        ]);
    }
}
