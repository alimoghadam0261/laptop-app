<div dir="rtl">
        <div class="topmenu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="padding-top:.5em;font-weight: bold" id="datetime1" ></div>
            <div class="col-md-4" style="padding-top:.5em;font-weight: bold"><p>شعار سال : سرمایه‌گذاری برای تولید</p></div>

            <div class="col-md-4" style="text-align: left">
                <a href="{{route('admin.profile.index')}}"><i class="fa fa-users" style="font-size: 1.5em"></i></a>
                <a href="{{url()->previous()}}">
                    <button class="btn btn-danger btn-sm" style="transform: translateY(-.7em)">بازگشت</button>
                </a>
            </div>
        </div>
    </div>

</div>
    </div>

<script>
    function updateDateTime() {
        const now = new Date();

        // گرفتن ساعت و دقیقه و ثانیه
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        // seconds = seconds < 10 ? "0" + seconds : seconds;

        // گرفتن تاریخ شمسی با Intl
        const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
        const persianDate = new Intl.DateTimeFormat('fa-IR', options).format(now);

        // نمایش
        document.getElementById("datetime1").innerHTML = `${persianDate} - ${hours}:${minutes}`;
    }

    // اجرای اولیه
    updateDateTime();

    // بروزرسانی هر 1 ثانیه
    setInterval(updateDateTime, 10000);


</script>
