<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')

                <br>
                <h5>فرم تغییر مشخصات اموال جمع داریداری</h5>
                <p>این فرم فقط برای ویرایش مشخصات است و به فرآیند ارسال یا برگشت اموال ارتباطی ندارد.</p>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="container mt-4">
                    <form wire:submit.prevent="update" class="form form-control p-4">

                        <div class="row">
                            <div class="col-md-6">
                                <label>نام:</label>
                                <input wire:model="name" type="text" class="form-control"><br>

                                <label>دسته‌بندی:</label>
                                <select wire:model="category_id" class="form-select">
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select><br>

                                <label>وضعیت:</label>
                                <select wire:model="status" class="form-select">
                                    <option value="">انتخاب کنید</option>
                                    <option value="سالم">سالم</option>
                                    <option value="نیاز به تعمیر">نیاز به تعمیر</option>
                                    <option value="تعمیر شده">تعمیرشده</option>
                                    <option value="اسقاط">اسقاط</option>
                                </select><br>

                                <label>مدل:</label>
                                <input wire:model="model" type="text" class="form-control"><br>

                                <label>قیمت:</label>
                                <input wire:model="price" type="text" class="form-control"><br>
                            </div>

                            <div class="col-md-6">
                                <label>سایز:</label>
                                <input wire:model="size" type="text" class="form-control"><br>

                                <label>سریال جم‌داری:</label>
                                <input wire:model="serial_jam" type="text" class="form-control"><br>

                                <label>سال تولید:</label>
                                <input wire:model="year" type="text" class="form-control"><br>

                                <label>رنگ:</label>
                                <input wire:model="color" type="text" class="form-control"><br>

                                <label>توضیحات:</label>
                                <textarea wire:model="content" class="form-control" rows="3"></textarea><br>
                            </div>
                        </div>

                        <button class="btn btn-dark mt-3" type="submit">
                            به‌روزرسانی اطلاعات اموال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
