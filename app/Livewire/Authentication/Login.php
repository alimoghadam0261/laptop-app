<?php

namespace App\Livewire\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    // 🔹 فیلدها
    public $name;
    public $cardNumber;
    public $phone;
    public $department;
    public $rules;


    /**
     * ثبت‌نام کاربر جدید
     */
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
            'password' => Hash::make($this->phone), // 👈 شماره موبایل پسورد میشه
        ]);

        session()->flash('success', 'اطلاعات کاربر با موفقیت ثبت شد.');
        return redirect()->route('admin.profile.personal');
    }

    /**
     * ورود کاربر
     */
    public function login()
    {

        if (Auth::attempt([
            'cardNumber' => $this->cardNumber,
            'password' => $this->phone, // 👈 مقایسه پسورد (که در DB هش شده)
        ])) {
            return redirect()->route('admin.dashboard');
        }

        $this->addError('loginError', 'شماره پرسنلی یا رمز عبور اشتباه است.');
    }

    public function render()
    {
        return view('livewire.authentication.login');
    }
}
