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
                   <h4>تعداد کل لپتاپ</h4>
                   <br>
                   <h6>{{$countlaptop}}</h6>
               </div>
               <div class="wigedit-dashboard">
                   <h4>تعداد کل تبلت</h4>
                   <br>
                   @if($counttablet >0)
                   <h6>{{$counttablet}}</h6>
                       @else
                   <h6>صفر</h6>
                       @endif
               </div>

           </div>
            <br>
            <div class="wigedits">
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تجهیزات</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل لپتاپ</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تبلت</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تبلت</h6>
                    <br>
                    <h6>40</h6>
                </div>
            </div>
            <br>
            <div class="wigedits">
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تجهیزات</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل لپتاپ</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تبلت</h6>
                    <br>
                    <h6>40</h6>
                </div>
                <div class="wiget-error">
                    <h6>تعداد خرابی کل تبلت</h6>
                    <br>
                    <h6>40</h6>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
