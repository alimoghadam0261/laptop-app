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

            <div>
                <form class="form-control" wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
                            <label>انتخاب تجیهزات:</label>
                            <select class="form-control" wire:model="digitaltool_id" class="form-select">
                                <option value="">انتخاب کنید</option>
                                @foreach($laptops as $laptop)
                                    <option value="{{ $laptop->id }}">{{ $laptop->name }} / {{ $laptop->serial_jam }}</option>
                                @endforeach
                            </select>

                            <label>نام تحویل گیرنده:</label>
                            <input class="form-control" type="text" wire:model="name_receiver">

                            <label>شماره پرسنلی:</label>
                            <input class="form-control"  type="text" wire:model="card_number">

                            <label>شماره تماس:</label>
                            <input class="form-control" type="text" wire:model="phone">

                            <label>پروژه:</label>
                            <input class="form-control" type="text" wire:model="name_project">
                        </div>
                        <div class="col-md-6">
                            <label>تاریخ تحویل:</label>
                            <input class="form-control" type="date" wire:model="from_date">

                            <label>تاریخ برگشت (اختیاری):</label>
                            <input class="form-control" type="date" wire:model="to_date">
                            <label for="">وضعیت</label>
                            <select class="form-control" name="status" wire:model="status" id="">
                                <option value="" selected>انتخاب کتید</option>
                                <option value="ارسال" selected>ارسال</option>
                                <option value="در حال ارسال" selected>در حال ارسال</option>
                                <option value="بازگشت" selected> بازگشت</option>
                            </select>
                            <div class="col-md-12 mt-3">
                                <label>موقعیت مکانی:</label>
                                <div id="map" style="height: 300px;"></div>
                                <input type="hidden" wire:model="latitude">
                                <input type="hidden" wire:model="longitude">
                            </div>
                            <label>توضیحات :</label>
                            <textarea class="form-control" wire:model="content" name="" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>





                    <button class="btn btn-dark" type="submit">تحویل لپتاپ</button>
                </form>

            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("livewire:initialized", () => {
        setTimeout(() => {
            var map = L.map('map').setView([35.6892, 51.3890], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            let marker;
            map.on('click', function(e) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(e.latlng).addTo(map);

                // ارسال مختصات به Livewire
            @this.set('latitude', e.latlng.lat);
            @this.set('longitude', e.latlng.lng);
            });
        }, 300);
    });
</script>



