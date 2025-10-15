<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                <h5><i class="fa fa-arrow-alt-circle-left"></i> ثبت ابزار جمع‌داری جدید</h5>
                <br>

                {{-- پیام موفقیت --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="form form-control  inverted-form ">
                    <div class="row">
                        {{-- ستون سمت چپ --}}
                        <div class="col-md-6">
                            {{-- نام --}}
                            <label>نام:</label>
                            <input wire:model="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="نام کالا یا ابزار">
                            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <br>

                            {{-- دسته بندی --}}
                            <label>انتخاب دسته‌بندی:</label>
                            <select class="form-control @error('category_id') is-invalid @enderror"
                                    wire:model="category_id">
                                <option value="">انتخاب کنید</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <br>

                            {{-- وضعیت --}}
                            <label>وضعیت:</label>
                            <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                <option value="">انتخاب کنید</option>
                                <option value="سالم">سالم</option>
                                <option value="نیاز به تعمیر">نیاز به تعمیر</option>
                                <option value="تعمیر شده">تعمیرشده</option>
                                <option value="اسقاط">اسقاط</option>
                            </select>
                            @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <br>

                            {{-- سال تولید --}}
                            <label>سال تولید:</label>
                            <input wire:model="year" type="text" class="form-control"
                                   placeholder="سال تولید کالا یا ابزار">
                            <br>

                            {{-- قیمت --}}
                            <label>قیمت:</label>
                            <input wire:model="price" type="text" class="form-control"
                                   placeholder="قیمت کالا یا ابزار">
                            <br>
                        </div>

                        {{-- ستون سمت راست --}}
                        <div class="col-md-6">
                            {{-- مدل --}}
                            <label>مدل:</label>
                            <input wire:model="model" type="text" class="form-control"
                                   placeholder="مدل کالا یا ابزار">
                            <br>

                            {{-- اندازه --}}
                            <label>اندازه:</label>
                            <input wire:model="size" type="text" class="form-control"
                                   placeholder="اندازه کالا یا ابزار">
                            <br>

                            {{-- رنگ --}}
                            <label>رنگ:</label>
                            <input wire:model="color" type="text" class="form-control"
                                   placeholder="رنگ کالا یا ابزار">
                            <br>

                            {{-- شماره سریال --}}
                            <label>شماره سریال:</label>
                            <input wire:model="serial_jam" type="text"
                                   class="form-control @error('serial_jam') is-invalid @enderror"
                                   placeholder="شماره سریال یا جم‌داری کالا یا ابزار">
                            @error('serial_jam') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <br>

                            {{-- توضیحات --}}
                            <label>توضیحات:</label>
                            <textarea class="form-control" wire:model="content" rows="5"
                                      placeholder="توضیحات مربوط به ابزار..."></textarea>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-dark px-4 tag">
                        ثبت ابزار جدید
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
