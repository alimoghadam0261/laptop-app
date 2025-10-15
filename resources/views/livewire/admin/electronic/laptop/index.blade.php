<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                {{-- دکمه ثبت --}}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.laptop.create') }}">
                            <div class="create-laptop">
                                ثبت تجهیزات الکترونیکی جدید
                            </div>
                        </a>
                        <br>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="بستن"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">

                        <a href="{{ route('admin.laptop.transfer') }}">
                            <div class="create-laptop">
                                ارسال تجهیزات الکترونیکی
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <br>

                {{-- سرچ --}}
                <div class="container">
                    <div>
                        <input wire:model.live="search"
                               class="input-search"
                               type="text"
                               placeholder="جستجو بر اساس نام یا شماره سریال">
                    </div>
                </div>
                <br>
                {{-- فیلتر و خروجی اکسل --}}
                <div class="container mt-4">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="from_date">از تاریخ:</label>
                            <input type="date" id="from_date" wire:model="from_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date">تا تاریخ:</label>
                            <input type="date" id="to_date" wire:model="to_date" class="form-control">
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                            <button style="transform: translateY(1.2em)" wire:click="exportExcel" class="btn btn-outline-dark w-100">
                                <i class="fa fa-file-excel"></i> خروجی اکسل
                            </button>
                        </div>
                    </div>

                    {{-- وضعیت لود --}}
                    <div wire:loading wire:target="exportExcel" class="mt-2 text-secondary">
                        در حال آماده‌سازی فایل...
                    </div>
                    <br>
                    <label>مرتب‌سازی بر اساس:</label>
                    <select wire:model.live="sortBy" class="form-select" style="width:auto;display:inline-block;">
                        <option value="name">نام</option>
                        <option value="serial_jam">شماره جم</option>
                        <option value="model">مدل</option>
                        <option value="category">دسته بندی</option>
                    </select>
                </div>


                <br>

                {{-- جدول --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>شماره جم</th>
                                    <th>برند</th>
                                    <th>تحویل گیرنده</th>
                                    <th>تغییرات</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($tools as $index => $item)
                                    <tr style="cursor:pointer;" wire:click="goToShow({{ $item->id }})">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->serial_jam }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ optional($item->latestHistory)->name_receiver ?? '—' }}</td>
                                        <td><a href="{{route('admin.laptop.edit',$item->id)}}"><i
                                                    class="fa fa-edit"></i></a></td>
                                        <td><i
                                                onclick="event.stopPropagation(); return confirm('آیا مطمئن هستید؟')"
                                                class="fa fa-trash" style="cursor:pointer;color:red;"
                                                wire:click="delete({{ $item->id }})"></i></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">موردی یافت نشد</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <label for="perPage">تعداد نمایش در هر صفحه:</label>
                                <select id="perPage" wire:model.live="perPage" class="form-select"
                                        style="width:auto;display:inline-block;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-center mt-4 pagination pagination-sm">
                                {{ $tools->links() }}
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
