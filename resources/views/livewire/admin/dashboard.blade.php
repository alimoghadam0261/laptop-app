<div dir="rtl">
<div class="container-fluid g-0">
    <div class="row g-0">
        <div class="col-md-2">
            @livewire('components.sidebar')
        </div>
        <div class="col-md-10 content">
            @livewire('components.topmenu')
            <br>

           <div class="wigedits">
               <div class="wigedit-dashboard">
                   <h4>تعداد کل تجهیزات</h4>
                   <br>
                   <h6>{{$countall}}</h6>
               </div>
               <div class="wigedit-dashboard">
                   <h4>تعداد کل کامپیوترها</h4>
                   <br>
                   <h6>{{$countcomputer}}</h6>
               </div>
               <div class="wigedit-dashboard">
                   <h4>تعداد کل لپتاپ ها</h4>
                   <br>
                   <h6>{{$countlaptop}}</h6>
               </div>
               <div class="wigedit-dashboard">
                   <h4>تعداد کل تبلت</h4>
                   <br>
                   <h6>{{$counttablet}}</h6>
               </div>
               <div class="wigedit-dashboard">
                   <h4>تعداد کل موبایل ها</h4>
                   <br>
                   <h6>{{$countmobile}}</h6>
               </div>

           </div>
            <hr>
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div>
                            <div style="width: 50%; margin: auto; padding-top: 50px;">
                                <canvas id="myPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <hr>
            </div>

        </div>
    </div>
</div>
</div>
<script src="{{asset('./js/chart.js')}}"></script>
<script>

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    const data = {
        labels: ['بخش ۱', 'بخش ۲', 'بخش ۳', 'بخش ۴'], // نام بخش‌ها
        datasets: [{
            label: 'نمودار ۴ قسمتی',
            data: [25, 25, 25, 25], // درصد یا مقادیر هر بخش
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    enabled: true
                }
            }
        },
    };

    const myPieChart = new Chart(
        document.getElementById('myPieChart'),
        config
    );


</script>
