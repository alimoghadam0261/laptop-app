<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                {{-- مشخصات لپ‌تاپ --}}
                <div class="container">
                    <div style="display: flex;justify-content: space-evenly">
                        <div class="wigedit-dashboard">
                            <h5>نام:</h5>
                            <p>{{ $tools->name }}</p>
                        </div>
                        <div class="wigedit-dashboard">
                            <h5>برند:</h5>
                            <p>{{ $tools->brand }}</p>
                        </div>
                        <div class="wigedit-dashboard">
                            <h5>Cpu:</h5>
                            <p>{{ $tools->cpu }}</p>
                        </div>
                        <div class="wigedit-dashboard">
                            <h5>Ram:</h5>
                            <p>{{ $tools->ram }}</p>
                        </div>
                    </div>

                    <br>

                    <div style="display: flex;justify-content: space-evenly">
                        <div class="wigedit-dashboard">
                            <h5>اقلام همراه:</h5>
                            @foreach(json_decode($tools->accessories ?? '[]', true) as $accessory)
                                <p>{{ $accessory }}</p>
                            @endforeach
                        </div>
                        <div class="wigedit-dashboard">
                            <h5>شماره سریال:</h5>
                            <p>{{ $tools->serial_it }}</p>
                        </div>
                        <div class="wigedit-dashboard">
                            <h5>شماره جم داری:</h5>
                            <p>{{ $tools->serial_jam }}</p>
                        </div>
                        <div class="wigedit-dashboard">
                            <h6>توضیحات:</h6>
                            <p>{{ $tools->content }}</p>
                        </div>
                    </div>
                </div>

                <hr><br>

                {{-- جدول تاریخچه --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="transfer">
                                <table class="table table-striped text-center">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>نام تحویل گیرنده</th>
                                        <th>شماره پرسنلی</th>
                                        <th>شماره تماس</th>
                                        <th>نام پروژه</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ تحویل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($histories as $toolsLoc)
                                        <tr>
                                            <td>{{ $toolsLoc->name_receiver }}</td>
                                            <td>{{ $toolsLoc->card_number }}</td>
                                            <td>{{ $toolsLoc->phone }}</td>
                                            <td>{{ $toolsLoc->name_project }}</td>
                                            <td class="
                                                    @if($toolsLoc->status === 'ارسال') bg-danger
                                                    @elseif($toolsLoc->status === 'در حال ارسال') bg-warning
                                                    @else bg-success
                                                    @endif
                                                ">
                                                {{ $toolsLoc->status }}
                                            </td>
                                            <td>{{ jdate($toolsLoc->from_date)->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- گراف شبکه --}}
                        <div class="col-md-5">
                            <div id="mynetwork" style="width: 100%; height: 600px; border: 1px solid lightgray;"></div>
                        </div>
                    </div>
                </div>

                {{-- نقشه --}}
                <div id="map" style="height:400px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- اسکریپت‌ها --}}
<script src="{{ asset('js/vis-network.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // گراف ارتباطی
        const nodes = new vis.DataSet(@json($nodes));
        const edges = new vis.DataSet(@json($edges));

        const container = document.getElementById('mynetwork');
        const data = { nodes, edges };
        const options = {
            layout: {
                hierarchical: {
                    direction: "UD",
                    sortMethod: "directed"
                }
            },
            edges: {
                arrows: 'to',
                color: 'gray',
                font: { align: 'middle', size: 12 }
            },
            nodes: {
                font: { size: 14 },
                shape: 'circle'
            },
            physics: false
        };

        new vis.Network(container, data, options);
    });
</script>

@php
    // تبدیل داده‌ها برای نقشه
    $locations = $histories->map(function($h) {
        return [
            'lat' => $h->latitude,
            'lng' => $h->longitude,
            'project' => $h->name_project,
            'status' => $h->status,
        ];
    });
@endphp

<script>
    document.addEventListener("DOMContentLoaded", () => {
        var map = L.map('map').setView([35.7, 51.4], 6);

        // ❌ قبلاً آنلاین بود، اگر آفلاین هستی می‌تونی بعداً حذف یا با ImageOverlay جایگزین کنی
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // ✅ تعریف آیکون سفارشی
        var customIcon = L.icon({
            iconUrl: '/img/gps.gif',     // مسیر داخل public/
            iconSize: [40, 40],          // اندازه تصویر (قابل تنظیم)
            iconAnchor: [20, 40],        // نقطه‌ای که روی مختصات قرار می‌گیرد
            popupAnchor: [0, -40]        // محل نمایش پاپ‌آپ نسبت به آیکون
        });

        const locations = @json($locations);

        // افزودن مارکرها با آیکون سفارشی
        locations.forEach(loc => {
            if (loc.lat && loc.lng) {
                L.marker([loc.lat, loc.lng], { icon: customIcon }).addTo(map)
                    .bindPopup(loc.project + " - " + loc.status);
            }
        });

        const first = locations.find(l => l.lat && l.lng);
        if (first) map.setView([first.lat, first.lng], 12);
    });

</script>
