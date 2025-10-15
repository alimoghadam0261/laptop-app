<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">

                            {{-- پیام موفقیت ثبت --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="form-control " wire:submit.prevent="save">

                                <div class="row">
                                    {{-- ستون سمت چپ --}}
                                    <div class="col-md-6">
                                        {{-- انتخاب تجهیزات --}}
                                        <label>انتخاب تجهیزات:</label>
                                        <select class="form-control @error('tools_id') is-invalid @enderror"
                                                wire:model="tools_id">
                                            <option value="">انتخاب کنید</option>
                                            @foreach($tools as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }} / {{ $item->serial_jam }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tools_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- نام تحویل گیرنده --}}
                                        <label>نام تحویل گیرنده:</label>
                                        <input type="text"
                                               class="form-control @error('name_receiver') is-invalid @enderror"
                                               wire:model="name_receiver"
                                               placeholder="نام تحویل گیرنده را وارد کنید">
                                        @error('name_receiver')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- شماره پرسنلی --}}
                                        <label>شماره پرسنلی:</label>
                                        <input type="text"
                                               class="form-control @error('card_number') is-invalid @enderror"
                                               wire:model="card_number"
                                               placeholder="شماره پرسنلی">
                                        @error('card_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- شماره تماس --}}
                                        <label>شماره تماس:</label>
                                        <input type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               wire:model="phone"
                                               placeholder="شماره تماس">
                                        @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- پروژه --}}
                                        <label>پروژه:</label>
                                        <input type="text"
                                               class="form-control @error('name_project') is-invalid @enderror"
                                               wire:model="name_project"
                                               placeholder="نام پروژه">
                                        @error('name_project')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- ستون سمت راست --}}
                                    <div class="col-md-6">
                                        {{-- تاریخ تحویل --}}
                                        <label>تاریخ تحویل:</label>
                                        <input type="date"
                                               class="form-control @error('from_date') is-invalid @enderror"
                                               wire:model="from_date">
                                        @error('from_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- تاریخ برگشت (اختیاری) --}}
                                        <label>تاریخ برگشت (اختیاری):</label>
                                        <input type="date" class="form-control" wire:model="to_date">
                                        <br>

                                        {{-- وضعیت --}}
                                        <label>وضعیت:</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                                wire:model="status">
                                            <option value="">انتخاب کنید</option>
                                            <option value="ارسال">ارسال</option>
                                            <option value="در حال ارسال">در حال ارسال</option>
                                            <option value="بازگشت">بازگشت</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <br>

                                        {{-- توضیحات --}}
                                        <label>توضیحات:</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror"
                                                  wire:model="content"
                                                  rows="6"
                                                  placeholder="توضیحات مربوط به تحویل یا وضعیت تجهیزات"></textarea>
                                        @error('content')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="bg-light">

                                <div class="text-center">
                                    <button class="btn btn-dark px-5 py-2" type="submit">
                                       تحویل اموال
                                    </button>
                                </div>

                            </form>

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
