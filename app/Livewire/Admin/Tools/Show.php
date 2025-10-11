<?php

namespace App\Livewire\Admin\Tools;

use App\Models\Tools;
use App\Models\tools_history;
use Livewire\Component;

class Show extends Component
{

    public $tools;
    public $toolsID;
    public $toolsLoc;
    public $histories;

    public function mount($id)
    {
        // یک ابزار مشخص
        $this->tools = Tools::findOrFail($id);

        $this->histories = tools_history::where('tools_id', $id)
            ->orderByDesc('from_date')
            ->get();
    }

    public function render()
    {
        // نود اصلی لپتاپ
        $nodes = [
            ['id' => 'tool_'.$this->tools->id, 'label' => $this->tools->name, 'color' => 'skyblue']
        ];

        $edges = [];

        // تاریخچه‌ها → نودها و یال‌ها
        foreach ($this->histories as $index => $history) {
            $nodeId = 'history_'.$history->id;
            $nodes[] = [
                'id' => $nodeId,
                'label' => $history->name_receiver."\n".$history->status."\n".$history->from_date,
                'color' => $history->status === 'ارسال' ? 'red' : ($history->status === 'در حال ارسال' ? 'yellow' : 'green'),
                'shape' => 'box'
            ];

            // یال: لپتاپ → اولین تاریخچه
            if ($index === count($this->histories) - 1) {
                $edges[] = [
                    'from' => 'tool_'.$this->tools->id,
                    'to' => $nodeId,
                    'label' => 'اولین تحویل'
                ];
            } else {
                // بین تاریخچه‌های متوالی
                $nextHistory = $this->histories[$index + 1];
                $edges[] = [
                    'from' => 'history_'.$nextHistory->id,
                    'to' => $nodeId,
                    'label' => 'بعدی'
                ];
            }
        }


        return view('livewire.admin.tools.show',[
            'nodes' => $nodes,
            'edges' => $edges
        ]);
    }
}
