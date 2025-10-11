<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br><br>
                <div class="container">


                    <h4>فرم ثبت تجهیزات الکترونیکی</h4>
                    <br>
                    <div class="row">

                        <div class="col-md-1"></div>
                        <div class="col-md-10 form-create">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>نام :</label><br>
                                        <select class="form-input-create" wire:model="name">
                                            <option value="">انتخاب کنید</option>
                                            <option value="لپتاپ">لپتاپ</option>
                                            <option value="کامپیوتر">کامپیوتر</option>
                                            <option value="تبلت">تبلت</option>
                                            <option value="موبایل">موبایل</option>
                                        </select>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>برند :</label><br>
                                        <input type="text" class="form-input-create" wire:model="brand">
                                        @error('brand') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>شماره جم داری :</label><br>
                                        <input type="text" class="form-input-create" wire:model="serial_jam">
                                        @error('serial_jam') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>شماره سریال IT :</label><br>
                                        <input type="text" class="form-input-create" wire:model="serial_it">
                                        @error('serial_it') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>Cpu :</label><br>
                                        <input type="text" class="form-input-create" wire:model="cpu">
                                        @error('cpu') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>Ram :</label><br>
                                        <input type="text" class="form-input-create" wire:model="ram">
                                        @error('ram') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>اقلام همراه :</label><br>
                                        <div class="form-check">
                                            <input type="checkbox" id="accessory1" class="form-check-input" wire:model="accessories" value="شارژر">
                                            <label class="form-check-label" for="accessory1">شارژر</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="accessory1" class="form-check-input" wire:model="accessories" value="کیبورد">
                                            <label class="form-check-label" for="accessory1">کیبورد</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="accessory1" class="form-check-input" wire:model="accessories" value="مانیتور">
                                            <label class="form-check-label" for="accessory1">مانیتور</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" id="accessory2" class="form-check-input" wire:model="accessories" value="کیف لپتاپ">
                                            <label class="form-check-label" for="accessory2">کیف لپتاپ</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="accessory3" class="form-check-input" wire:model="accessories" value="موس">
                                            <label class="form-check-label" for="accessory3">موس</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="accessory4" class="form-check-input" wire:model="accessories" value="هارد اکسترنال">
                                            <label class="form-check-label" for="accessory4">هارد اکسترنال</label>
                                        </div>
                                        @error('accessories') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>نام تحویل گیرنده :</label><br>
                                        <input type="text" class="form-input-create" wire:model="name_receiver">
                                        @error('name_receiver') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>شماره پرسنلی تحویل گیرنده :</label><br>
                                        <input type="text" class="form-input-create" wire:model="card_number">
                                        @error('card_number') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>شماره تماس تحویل گیرنده :</label><br>
                                        <input type="text" class="form-input-create" wire:model="phone">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>پروژه :</label><br>
                                        <input type="text" class="form-input-create" wire:model="name_project">
                                        @error('name_project') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>تاریخ تحویل :</label><br>
                                        <input type="date" class="form-input-create" wire:model="from_date">
                                        @error('from_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>تاریخ برگشت :</label><br>
                                        <input type="date" class="form-input-create" wire:model="to_date">
                                        @error('to_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label>توضیحات :</label><br>
                                        <textarea class="form-input-create" cols="60" rows="5" wire:model="content"></textarea>
                                        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <button class="btn btn-dark w-50" type="submit">ثبت تجهیزات جدید</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
