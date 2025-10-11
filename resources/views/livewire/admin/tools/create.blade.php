<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>
<h5><i class="fa fa-arrow-alt-circle-left"></i> ثبت ابزار جم داری جدید</h5>
                <br>
                <form wire:submit.prevent="save" class="form form-control table-dark">
                    <label>نام:</label><br>
                    <input wire:model="name" type="text" class="form form-control" placeholder="نام کالا یا ابزار"><br>

                    <select class="form form-control" wire:model="category_id">
                        <option value="">انتخاب کنید</option>
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select><br>


                    <label>مدل:</label><br>
                    <input wire:model="model" type="text" class="form form-control" placeholder="مدل کالا یا ابزار"><br>
                    <label>اندازه:</label><br>
                    <input wire:model="size" type="text" class="form form-control" placeholder="اندازه کالا یا ابزار"><br>
                    <label>رنگ:</label><br>
                    <input wire:model="color" type="text" class="form form-control" placeholder="رنگ کالا یا ابزار"><br>
                    <label>شماره سریال:</label><br>
                    <input wire:model="serial_jam" type="text" class="form form-control" placeholder="شماره سریال یا جم داری کالا یا ابزار"><br>
                    <label>توضیحات :</label><br>
                    <textarea class="form form-control" wire:model="content" cols="70" rows="5"></textarea>
                    <button type="submit" class="btn btn-dark text-white">ثبت ابزار جدید</button>
                </form>




            </div>
        </div>
    </div>
</div>
