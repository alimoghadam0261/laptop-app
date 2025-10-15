<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <div class="form form-control">

                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <label>نام</label>
                            <p>{{ $name }}</p><br>

                            <label>شماره پرسنلی</label>
                            <p>{{ $cardNumber }}</p><br>

                            <label>نقش سیستمی</label>
                            <p>{{ $rules }}</p><br>

                            <form wire:submit.prevent="update">
                                <label>واحد</label>
                                <input type="text" class="form form-control" wire:model="department"><br>

                                <label>شماره تماس:</label>
                                <input type="text" class="form form-control" wire:model="phone"><br>

                                <label>تغییر رمز عبور:</label>
                                <input type="password" class="form form-control" wire:model="password" placeholder="رمز جدید (اختیاری)"><br>

                                <button class="btn btn-dark" type="submit">به‌روزرسانی اطلاعات</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
