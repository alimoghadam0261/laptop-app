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
                    <br>
               <div class="row">
                   <div class="col-md-4" style="background:rgba(255,255,255,.4);margin:.3em;width: 30%;padding:10px;text-align: center">
                       <h5>نام:</h5>
                       <p>{{ $tools->name }}</p>
                       <h5>برند:</h5>
                       <p>{{ $tools->brand }}</p>
                       <h5>Cpu:</h5>
                       <p>{{ $tools->cpu }}</p>
                   </div>
                   <div class="col-md-4" style="background:rgba(255,255,255,.4);margin:.3em;width: 30%;padding:10px;text-align: center">
                       <h5>Ram:</h5>
                       <p>{{ $tools->ram }}</p>
                       <h5>سریال جمع داری:</h5>
                       <p>{{ $tools->serial_jam }}</p>
                       <h5> سریال فناوری اطلاعات:</h5>
                       <p>{{ $tools->serial_it }}</p>
                   </div>
                   <div class="col-md-4" style="background:rgba(255,255,255,.4);margin:.3em;width: 30%;padding:10px;text-align: center">
                       <h5> اقلام همراه:</h5>
                       @php
                           $acc = $tools->accessories;

                           if (is_string($acc)) {
                               // سعی در decode یک بار
                               $tmp = json_decode($acc, true);

                               // اگر بعد از decode هنوز یک رشته بود (double-encoded) سعی در decode دوباره کن
                               if (is_string($tmp)) {
                                   $tmp2 = json_decode($tmp, true);
                                   if (is_array($tmp2)) $tmp = $tmp2;
                               }

                               // اگر json_decode موفق بود، $acc را آرایه کن
                               if (is_array($tmp)) {
                                   $acc = $tmp;
                               }
                           }
                       @endphp

                       <p>{{ is_array($acc) ? implode(', ', $acc) : $acc }}</p>



                       <h5> توضیحات:</h5>
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
                                        <th>حذف</th>
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
                                                    @if($toolsLoc->status === 'send') bg-danger

                                                    @elseif($toolsLoc->status === 'return') bg-success
                                                    @else bg-dark text-white
                                                    @endif
                                                ">
                                                {{ $toolsLoc->status }}
                                            </td>
                                            <td>{{ jdate($toolsLoc->from_date)->format('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger"
                                                        wire:click="deleteHistory({{ $toolsLoc->id }})"
                                                        onclick="return confirm('آیا از حذف این مورد مطمئن هستید؟')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
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


            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/vis-network.js') }}"></script>
<script src="{{ asset('js/vis-network.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nodesData = @json($nodes);
        const edgesData = @json($edges);

        // تعیین رنگ هر نود بر اساس وضعیت
        const coloredNodes = nodesData.map(node => {
            let color = '#9E9E9E'; // پیش‌فرض خاکستری

            if (node.status === 'send') color = '#e68882';       // قرمز

            else if (node.status === 'return') color = '#a0daa2';  // سبز


            return {
                ...node,
                color: {
                    background: color,
                    border: '#333',
                    highlight: { background: color, border: '#000' }
                },
                font: { color: '#000', size: 14 }
            };
        });

        const nodes = new vis.DataSet(coloredNodes);
        const edges = new vis.DataSet(edgesData);

        const container = document.getElementById('mynetwork');
        const data = { nodes, edges };
        const options = {
            layout: {
                hierarchical: {
                    direction: "UD", // بالا به پایین
                    sortMethod: "directed"
                }
            },
            edges: {
                arrows: 'to',
                color: 'gray',
                font: { align: 'middle', size: 12 }
            },
            nodes: {
                shape: 'circle',
                borderWidth: 2
            },
            physics: false // تا گراف ثابت بمونه
        };

        new vis.Network(container, data, options);
    });
</script>


