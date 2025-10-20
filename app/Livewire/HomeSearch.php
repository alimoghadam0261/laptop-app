<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\tools_history;
use App\Models\Digital_history;

class HomeSearch extends Component
{
    public $search = '';

    public function render()
    {
        $warnings = collect();

        if (trim($this->search) === '') {
            return view('livewire.home-search', [
                'histories' => collect(),
                'warnings' => $warnings,
            ]);
        }

        // Step 1: Find matching histories based on search
        $matching_tools = tools_history::with('tool')
            ->where(function($q) {
                $q->where('name_receiver', 'like', "%{$this->search}%")
                    ->orWhere('card_number', 'like', "%{$this->search}%");
            })
            ->orderBy('created_at')
            ->get();

        $matching_digitals = Digital_history::with('laptop')
            ->where(function($q) {
                $q->where('name_receiver', 'like', "%{$this->search}%")
                    ->orWhere('card_number', 'like', "%{$this->search}%");
            })
            ->orderBy('created_at')
            ->get();

        // Step 2: Get unique tool/digital IDs from matching histories
        $unique_tool_ids = $matching_tools->pluck('tool_id')->unique();
        $unique_digital_ids = $matching_digitals->pluck('digitaltool_id')->unique();

        // Step 3: Fetch ALL histories for these unique IDs (global view for duplicate check)
        $all_tools_histories = tools_history::with('tool')
            ->whereIn('tool_id', $unique_tool_ids)
            ->orderBy('created_at')
            ->get()
            ->groupBy('tool_id');

        $all_digitals_histories = Digital_history::with('laptop')
            ->whereIn('digitaltool_id', $unique_digital_ids)
            ->orderBy('created_at')
            ->get()
            ->groupBy('digitaltool_id');

        // Step 4: For each unique tool/digital, compute active records and check for duplicates
        $filtered = collect();
        $duplicate_tool_ids = [];
        foreach ($all_tools_histories as $tool_id => $group) {
            $group = $group->sortBy('created_at')->values();

            // Find the last 'return' index
            $lastReturnIndex = -1;
            foreach ($group as $i => $record) {
                if ($record->status === 'return') {
                    $lastReturnIndex = $i;
                }
            }

            // Active records after last return
            $activeAfterReturn = $group->slice($lastReturnIndex + 1)->values();

            // Check if there are multiple 'send' at the end (duplicate allocation)
            $sendCount = $activeAfterReturn->where('status', 'send')->count();
            if ($sendCount > 1) {
                $duplicate_tool_ids[] = $tool_id;
            }

            // Only include active records that match the search
            $matching_active = $activeAfterReturn->filter(function ($record) {
                return stripos($record->name_receiver, $this->search) !== false ||
                    stripos($record->card_number, $this->search) !== false;
            });

            $filtered = $filtered->merge($matching_active);
        }

        $duplicate_digital_ids = [];
        foreach ($all_digitals_histories as $digital_id => $group) {
            $group = $group->sortBy('created_at')->values();

            // Find the last 'return' index
            $lastReturnIndex = -1;
            foreach ($group as $i => $record) {
                if ($record->status === 'return') {
                    $lastReturnIndex = $i;
                }
            }

            // Active records after last return
            $activeAfterReturn = $group->slice($lastReturnIndex + 1)->values();

            // Check if there are multiple 'send' at the end (duplicate allocation)
            $sendCount = $activeAfterReturn->where('status', 'send')->count();
            if ($sendCount > 1) {
                $duplicate_digital_ids[] = $digital_id;
            }

            // Only include active records that match the search
            $matching_active = $activeAfterReturn->filter(function ($record) {
                return stripos($record->name_receiver, $this->search) !== false ||
                    stripos($record->card_number, $this->search) !== false;
            });

            $filtered = $filtered->merge($matching_active);
        }

        // Step 5: Mark duplicates for rendering
        foreach ($filtered as $h) {
            if ($h instanceof tools_history) {
                if (in_array($h->tool_id, $duplicate_tool_ids)) {
                    $h->duplicate_send = true;
                }
            } else {
                if (in_array($h->digitaltool_id, $duplicate_digital_ids)) {
                    $h->duplicate_send = true;
                }
            }
        }

        // Sort filtered by created_at desc
        $filtered = $filtered->sortByDesc('created_at');

        return view('livewire.home-search', [
            'histories' => $filtered,
            'warnings' => $warnings,
        ]);
    }
}
