<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
<div class="container">
    <br>
    <h6>فرم تعییرات تجهیزات</h6>
    <br>
    <form class="form-control" wire:submit.prevent="update">
       <div class="row">
           <div class="col-md-6">
               <label>نام :</label><br>
               <select class="form-control-plaintext form-input-create" wire:model="name">
                   <option value="">انتخاب کنید</option>
                   <option value="لپتاپ">لپتاپ</option>
                   <option value="تبلت">تبلت</option>
                   <option value="موبایل">موبایل</option>
               </select>
               @error('name') <span class="text-danger">{{ $message }}</span> @enderror
               <br>
               <label>برند</label><br>
               <input type="text" wire:model="brand" class="form-control col-md-4"><br>
               <label>شماره سریال آی تی</label><br>
               <input type="text" wire:model="serial_it" class="form-control col-md-4"><br>
               <label>شماره سریال جم</label><br>
               <input type="text" wire:model="serial_jam" class="form-control col-md-4"><br>
           </div>
           <div class="col-md-6">
               <label>ram</label><br>
               <input type="text" wire:model="ram" class="form-control col-md-4"><br>
               <br>
               <label>cpu</label><br>
               <input type="text" wire:model="cpu" class="form-control col-md-4"><br>
               <br>
               <label>اقلام همراه :</label><br>
               <div class="form-check1">
                   <input type="checkbox" id="accessory1" class="form-check-input" wire:model="accessories" value="شارژر">
                   <label class="form-check-label" for="accessory1">شارژر</label>
               </div>
               <div class="form-check1">
                   <input type="checkbox" id="accessory2" class="form-check-input" wire:model="accessories" value="کیف لپتاپ">
                   <label class="form-check-label" for="accessory2">کیف لپتاپ</label>
               </div>
               <div class="form-check1">
                   <input type="checkbox" id="accessory3" class="form-check-input" wire:model="accessories" value="موس">
                   <label class="form-check-label" for="accessory3">موس</label>
               </div>
               <div class="form-check1">
                   <input type="checkbox" id="accessory4" class="form-check-input" wire:model="accessories" value="هارد اکسترنال">
                   <label class="form-check-label" for="accessory4">هارد اکسترنال</label>
               </div>
               @error('accessories') <span class="text-danger">{{ $message }}</span> @enderror
               <label>توضیخات</label><br>
               <textarea type="text" wire:model="content" class="form-control col-md-4"></textarea><br>
               <br>
               <br>
           </div>
       </div>

        <button class="btn btn-outline-dark" type="submit">ثبت تغییرات</button>
    </form>
    <br>
</div>
</div>

        </div>
    </div>
</div>
