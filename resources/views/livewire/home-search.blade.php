<div dir="rtl" class="container mt-5">
    <a class="btn btn-dark" href="{{ route('login') }}">ورود</a>

    <h4 class="mb-3 text-center">جستجوی سوابق اموال دریافتی</h4>

    <input type="text" wire:model.live="search" class="form-control mb-4"
           placeholder="نام یا شماره پرسنلی را وارد کنید...">

    {{-- هشدارها --}}
    @if(!empty($warnings))
        <div class="alert alert-warning">
            @foreach($warnings as $warn)
                <p>{{ $warn }}</p>
            @endforeach
        </div>
    @endif

    @if($search)
        @if($histories->isEmpty())
            <p class="text-center text-muted">هیچ سابقه‌ای یافت نشد.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>نوع ابزار</th>
                        <th>نام ابزار</th>
                        <th>شماره سریال جم</th>
                        <th>نام گیرنده</th>
                        <th>شماره پرسنلی</th>
                        <th>پروژه</th>
                        <th>تاریخ تحویل</th>
                        <th>وضعیت</th>
                        <th>توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($histories as $h)
                        <tr style="{{ $h->has_duplicate_send ? 'background-color:#f8d7da;' : '' }}">
                            <td>{{ $h instanceof \App\Models\tools_history ? 'ابزار عمومی' : 'ابزار دیجیتال' }}</td>
                            <td>{{ $h instanceof \App\Models\tools_history ? $h->tool->name ?? '-' : $h->laptop->name ?? '-' }}</td>
                            <td>{{ $h instanceof \App\Models\tools_history ? $h->tool->serial_jam ?? '-' : $h->laptop->serial_jam ?? '-' }}</td>
                            <td>{{ $h->name_receiver }}</td>
                            <td>{{ $h->card_number }}</td>
                            <td>{{ $h->name_project }}</td>
                            <td>{{ jdate($h->from_date)->format('Y/m/d') }}</td>
                            <td>{{ $h->status }}</td>
                            <td>{{ $h->content }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>
