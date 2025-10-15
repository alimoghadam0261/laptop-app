<div dir="rtl">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-2">
                @livewire('components.sidebar')
            </div>
            <div class="col-md-10 content">
                @livewire('components.topmenu')
                <br>
                <h4>تعداد کاربران عضو شده : {{$count}}</h4>
                <hr style="width: 17%">

                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div>
                                <form class="form form-control" wire:submit.prevent="save">

                                    <label>نام:</label><br>
                                    <input class="form form-control" type="text" wire:model="name"
                                           placeholder="name"><br>

                                    <label>شماره تماس:</label><br>
                                    <input class="form form-control" type="number" wire:model="phone"
                                           placeholder="phone"><br>

                                    <label>شماره پرسنلی</label><br>
                                    <input class="form form-control" type="number" wire:model="cardNumber"
                                           placeholder="cardNumber"><br>

                                    <label>واحد :</label>br
                                    <input class="form form-control" type="text" wire:model="department"
                                           placeholder="department"><br>

                                    <label>نوع دسترسی:</label><br>
                                    <select class="form form-control" wire:model="rules">
                                        <option value="admin">مدیریت</option>
                                        <option value="it">فناوری اطلاعات (IT)</option>
                                        <option value="jam">جم داری</option>
                                    </select>

                                    <button class="btn btn-dark" type="submit">اضافه کردن</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead class=" table table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>شماره پرسنلی</th>
                                    <th>شماره تماس</th>
                                    <th>واحد</th>
                                    <th>نقش سیستمی</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($personal as $index => $item)
                                    <tr wire:key="user-{{ $item->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->cardNumber }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->department }}</td>

                                        <td>
                                            @if($editingRuleId == $item->id)
                                                <select style="color:#000;font-weight:bold;" wire:model="newRule" wire:change="updateRule" class="form form-control">
                                                    <option value="مدیریت">مدیریت</option>
                                                    <option value="فناوری اطلاعات (IT)">فناوری اطلاعات (IT)</option>
                                                    <option value="جمع داری">جمع داری</option>
                                                </select>
                                            @else
                                                <span style="cursor: pointer; color:#6c6cb8"
                                                      wire:click="editRule({{ $item->id }})">
                    {{ $item->rules }}
                </span>
                                            @endif
                                        </td>

                                        <td><i wire:click="delete({{ $item->id }})" class="fa fa-trash " style="cursor: pointer; color:red"></i></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
