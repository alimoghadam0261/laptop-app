<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Index extends Component
{
    public $name;
    public $cardNumber;
    public $rules;
    public $department;
    public $phone;
    public $password;

    public function mount()
    {
        $user = auth()->user();

        // مقداردهی اولیه به فیلدها
        $this->name = $user->name;
        $this->cardNumber = $user->cardNumber;
        $this->rules = $user->rules;
        $this->department = $user->department;
        $this->phone = $user->phone;
    }

    public function update()
    {
        $user = auth()->user();

        $this->validate([
            'department' => 'required|string|max:255',
            'phone' => 'required|min:11|max:11|unique:users,phone,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        // بروزرسانی اطلاعات
        $user->update([
            'department' => $this->department,
            'phone' => $this->phone,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('success', 'اطلاعات شما با موفقیت بروزرسانی شد.');
    }

    public function render()
    {
        return view('livewire.admin.profile.index');
    }
}
