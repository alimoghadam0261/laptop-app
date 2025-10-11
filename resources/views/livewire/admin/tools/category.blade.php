<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>

                <br>
                <h5><i class="fa fa-arrow-alt-circle-left"></i> فرم ایجاد دسته بندی جدید</h5><br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form wire:submit.prevent="save" class="form-control">
                            <label>نام دسته بندی:</label><br>
                            <input wire:model="name" type="text" class="form-control"
                                   placeholder="نام دسته بندی جدید را وارد نمایید"><br>

                            <label>توضیحات دسته بندی:</label><br>
                            <textarea wire:model="description" class="form-control"></textarea><br><br>
                            <button type="submit" class="btn btn-dark text-white">ایجاد دسته بندی جدید</button>
                        </form>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </div>
            <br>

        </div>
        <br>
        <div class="container">
            <h5><i class="fa fa-arrow-alt-circle-left"></i> لیست دسته بندی های موجود </h5><br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="transform: translateX(-12em)">
                    <table class="table table-striped">
                        <thead class="table-dark text-white">
                        <tr>

                            <th>نام</th>
                            <th>توضیحات</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $index=>$cat)
                            <tr>

                                <td>{{$cat->name}}</td>
                                <td>{{$cat->description}}</td>
                                <td><i class="fa fa-trash" style="color:red;cursor: pointer" wire:click="delete ({{$cat->id}})"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>
