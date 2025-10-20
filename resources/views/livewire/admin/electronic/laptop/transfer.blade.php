<div dir="rtl" class="container-fluid g-0">
    <div class="row g-0">
        <div class="col-md-2">
            @livewire('components.sidebar')
        </div>

        <div class="col-md-10 content">
            @livewire('components.topmenu')
            <br>

            <div class="container">
                <h5><i class="fa fa-arrow-alt-circle-left"></i> فرم ارسال / بازگشت تجهیزات الکترونیکی</h5>
                <br>

                <form class="form-control" wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
                            <label>انتخاب تجهیزات:</label>
                            <select class="form-control" wire:model.live="digitaltool_id">
                                <option value="">انتخاب کنید</option>
                                @foreach($laptops as $l)
                                    <option value="{{ $l->id }}">{{ $l->name }} / {{ $l->serial_jam }}</option>
                                @endforeach
                            </select>
                            @error('digitaltool_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">نام تحویل گیرنده:</label>
                            <input class="form-control" type="text" wire:model="name_receiver"
                                   @if($selectedLaptopHasActiveSend) disabled @endif>

                            <label class="mt-2">شماره پرسنلی:</label>
                            <input class="form-control" type="text" wire:model="card_number"
                                   @if($selectedLaptopHasActiveSend) disabled @endif>

                            <label class="mt-2">شماره تماس:</label>
                            <input class="form-control" type="text" wire:model="phone"
                                   @if($selectedLaptopHasActiveSend) disabled @endif>

                            <label class="mt-2">پروژه:</label>
                            <input class="form-control" type="text" wire:model="name_project"
                                   @if($selectedLaptopHasActiveSend) disabled @endif>
                        </div>

                        <div class="col-md-6">
                            <label>تاریخ تحویل:</label>
                            <input class="form-control" type="date" wire:model="from_date"
                                   @if($selectedLaptopHasActiveSend) disabled @endif>

                            <label class="mt-2">تاریخ برگشت (اختیاری):</label>
                            <input class="form-control" type="date" wire:model="to_date">

                            <label class="mt-3">وضعیت:</label>
                            <select class="form-control" wire:model="status">
                                <option value="{{ \App\Models\Digital_history::STATUS_SEND }}"
                                        @if($selectedLaptopHasActiveSend) disabled @endif>
                                    ارسال
                                </option>
                                <option value="{{ \App\Models\Digital_history::STATUS_RETURN }}">بازگشت</option>
                            </select>

                            {{-- هشدار درجا --}}
                            @if($warningMessage)
                                <div class="alert alert-warning mt-3" style="font-weight:bold; font-size:15px;">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    {{ $warningMessage }}
                                </div>
                            @endif

                            <label class="mt-3">توضیحات:</label>
                            <textarea class="form-control" wire:model="content" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-dark" style="width: 40%;" type="submit">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
