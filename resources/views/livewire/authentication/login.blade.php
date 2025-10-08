<div dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 login">
                <div class="login-page">
                    <div style="display: flex;gap: 10px">
                        <img src="{{asset('./img/1.png')}}" width="50" loading="lazy" alt="1">
                        <h4 style="transform: translateY(.2em)">فرم ورود</h4>
                    </div>
                    <br>
                    <form  class="form form-control login-form" wire:submit.prevent="login">
                        <label>شماره پرسنلی:</label><br><br>
                        <input type="text" wire:model="cardNumber" class="form form-control" placeholder="شماره پرسنلی خود را وار نمایید"><br><br>
                        <label>رمز عبور:</label><br><br>
                        <input wire:model="phone" type="password" class="form form-control" placeholder="شماره موبایل خود را وار نمایید"><br><br>
                        <button type="submit" class="btn btn-dark text-white">ورود</button>
                        <br><br>
                    </form>
                    <p>برای ثبت نام و رمز عبور به آقای آذر نیا مراجعه کنید</p>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <div style="display: none">
    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="name"><br>
        <input type="number" wire:model="phone" placeholder="phone"><br>
        <input type="number" wire:model="cardNumber" placeholder="cardNumber"><br>
        <input type="text" wire:model="department" placeholder="department"><br>
        <button type="submit">اضافه کردن</button>
    </form>
    </div>
</div>
