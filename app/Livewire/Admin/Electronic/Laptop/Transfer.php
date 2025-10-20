<?php

namespace App\Livewire\Admin\Electronic\Laptop;

use App\Models\Digitaltool;
use App\Models\Digital_history;
use Illuminate\Support\Facades\DB;
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
    public $status;
    public $latitude;
    public $longitude;
    public $content;

    public $selectedLaptopHasActiveSend = false;
    public $warningMessage = null;

    public function mount()
    {
        $this->status = Digital_history::STATUS_SEND;
        $this->selectedLaptopHasActiveSend = false;
        $this->warningMessage = null;
    }

    public function updatedDigitaltoolId()
    {
        $this->resetErrorBag('digitaltool_id');
        $this->warningMessage = null;

        if (!$this->digitaltool_id) {
            $this->selectedLaptopHasActiveSend = false;
            $this->status = Digital_history::STATUS_SEND;
            return;
        }

        $laptop = Digitaltool::find($this->digitaltool_id);
        if (!$laptop) {
            $this->addError('digitaltool_id', 'کالای انتخاب‌شده یافت نشد.');
            return;
        }

        $lastHistory = $laptop->histories()->latest('id')->first();

        if ($lastHistory && $lastHistory->status === Digital_history::STATUS_SEND && $lastHistory->to_date === null) {
            // ابزار فعلاً خارج از انبار است
            $this->selectedLaptopHasActiveSend = true;
            // پیشنهادِ وضعیت به RETURN (اما کاربر می‌تواند آن را تایید/send را تغییر ندهد چون send غیرفعال است)
            $this->status = Digital_history::STATUS_RETURN;
            $this->warningMessage = '⚠️ این ابزار قبلاً ارسال شده و در حال حاضر خارج از انبار است. فقط می‌توانید آن را بازگردانید (Return).';
        } else {
            $this->selectedLaptopHasActiveSend = false;
            $this->status = Digital_history::STATUS_SEND;
            $this->warningMessage = null;
        }
    }

    public function save()
    {
        // حداقل اعتبارسنجی اولیه (همیشه مورد نیاز)
        $this->validate([
            'digitaltool_id' => 'required|exists:digitaltools,id',
            'status' => 'required|in:' . Digital_history::STATUS_SEND . ',' . Digital_history::STATUS_RETURN,
        ]);

        DB::beginTransaction();
        try {
            $laptop = Digitaltool::lockForUpdate()->findOrFail($this->digitaltool_id);
            $lastHistory = $laptop->histories()->latest('id')->first();

            // اگر کاربر می‌خواهد SEND ثبت کند:
            if ($this->status === Digital_history::STATUS_SEND) {
                // اعتبارسنجی فیلدهای مورد نیاز برای SEND
                $this->validate([
                    'name_receiver'  => 'required|string|min:3',
                    'card_number'    => 'required|string|min:1',
                    'phone'          => 'required|string|size:11',
                    'name_project'   => 'required|string|min:3',
                    'from_date'      => 'required|date',
                ]);

                // اگر آخرین وضعیت SEND است و to_date == null => ارسال مجدد ممنوع
                if ($lastHistory && $lastHistory->status === Digital_history::STATUS_SEND && $lastHistory->to_date === null) {
                    DB::rollBack();
                    $this->addError('digitaltool_id', '❌ این ابزار قبلاً ارسال شده و هنوز بازنگشته است. ابتدا باید بازگشت (Return) ثبت شود.');
                    // برای اطمینان، وضعیت فرم پیشنهاداً به RETURN تغییر کند
                    $this->status = Digital_history::STATUS_RETURN;
                    $this->selectedLaptopHasActiveSend = true;
                    $this->warningMessage = '❌ این ابزار قبلاً ارسال شده و هنوز بازنگشته است. ابتدا باید بازگشت (Return) ثبت شود.';
                    return;
                }

                // ثبت ارسال جدید
                $laptop->histories()->create([
                    'name_receiver' => $this->name_receiver,
                    'card_number'   => $this->card_number,
                    'phone'         => $this->phone,
                    'content'       => $this->content ?? '-',
                    'name_project'  => $this->name_project,
                    'from_date'     => $this->from_date,
                    'to_date'       => null,
                    'status'        => Digital_history::STATUS_SEND,
                    'latitude'      => $this->latitude,
                    'longitude'     => $this->longitude,
                ]);

                DB::commit();
                session()->flash('message', '✅ تجهیزات با موفقیت ارسال شد.');
                $this->redirectRoute('admin.laptop.index');
                return;
            }

            // اگر کاربر می‌خواهد RETURN ثبت کند:
            if ($this->status === Digital_history::STATUS_RETURN) {
                // بررسی اینکه یک ارسال فعال وجود دارد
                if (! $lastHistory || $lastHistory->status !== Digital_history::STATUS_SEND || $lastHistory->to_date !== null) {
                    DB::rollBack();
                    $this->addError('digitaltool_id', 'هیچ رکورد ارسال فعالی برای بازگشت وجود ندارد.');
                    return;
                }

                // ثبت بازگشت (تاریخ برگشت در صورتی که کاربر نداد، امروز ثبت می‌شود)
                $lastHistory->update([
                    'to_date' => $this->to_date ?: now()->toDateString(),
                    'status'  => Digital_history::STATUS_RETURN,
                    'content' => $this->content ?? $lastHistory->content,
                ]);

                DB::commit();
                session()->flash('message', '✅ تجهیزات با موفقیت بازگردانده شد.');
                $this->redirectRoute('admin.laptop.index');
                return;
            }

            DB::rollBack();
            $this->addError('status', 'وضعیت نامعتبر است.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Transfer save error: ' . $e->getMessage());
            $this->addError('general', '⚠️ خطایی رخ داد. لطفاً دوباره تلاش کنید.');
        }
    }

    public function render()
    {
        $laptops = Digitaltool::all();
        return view('livewire.admin.electronic.laptop.transfer', compact('laptops'));
    }
}
