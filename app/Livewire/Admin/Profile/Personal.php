<?php

namespace App\Livewire\Admin\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Personal extends Component
{
    public $name;
    public $phone;
    public $rules;
    public $department;
    public $cardNumber;

    // متغیرهای مورد نیاز برای ویرایش inline
    public $personal;
    public $editingRuleId = null;
    public $newRule = null;

    public function mount()
    {
        // مقدار اولیه‌ی لیست کاربران
        $this->personal = User::all();
    }

    public function editRule($id)
    {
        $this->editingRuleId = $id;
        $user = User::find($id);
        $this->newRule = $user ? $user->rules : null;
    }

    public function updateRule()
    {
        if (! $this->editingRuleId) {
            return;
        }

        $user = User::find($this->editingRuleId);
        if ($user && $this->newRule) {
            $user->rules = $this->newRule;
            $user->save();

            // آپدیت لیست کاربران تا view تازه شود
            $this->personal = User::all();

            // اختیاری: پیام موفقیت
            session()->flash('success', 'نقش کاربر با موفقیت بروزرسانی شد.');
        }

        // بستن حالت ویرایش
        $this->editingRuleId = null;
        $this->newRule = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'cardNumber' => 'required|unique:users,cardNumber',
            'department' => 'required',
            'rules' => 'required',
            'phone' => 'required|min:11|max:11|unique:users,phone',
        ]);

        User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'rules' => $this->rules,
            'department' => $this->department,
            'cardNumber' => $this->cardNumber,
            'password' => Hash::make($this->phone),
        ]);

        session()->flash('success', 'اطلاعات کاربر با موفقیت ثبت شد.');

        // آپدیت لیست به‌صورت زنده بدون ریدایرکت
        $this->personal = User::all();

        // پاک کردن فیلدها (اختیاری)
        $this->name = $this->phone = $this->rules = $this->department = $this->cardNumber = null;
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            session()->flash('success', 'کاربر با موفقیت حذف شد.');
        }

        // لیست کاربران را به‌روزرسانی کن تا جدول بلافاصله تغییر کند
        $this->personal = User::all();
    }



    public function render()
    {
        // اگر خواستی همیشه fresh باشه، اینجا هم می‌تونی بازخوانی کنی:
        // $this->personal = User::all();

        $count = User::count();
        return view('livewire.admin.profile.personal', compact('count'));
    }
}
