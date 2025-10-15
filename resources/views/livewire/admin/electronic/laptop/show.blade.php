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
                       <p>{{ is_array($tools->accessories) ? implode(', ', $tools->accessories) : $tools->accessories }}</p>

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
                                                    @elseif($toolsLoc->status === 'بازگشت') bg-success
                                                    @else bg-dark text-white
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


            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/vis-network.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // گراف ارتباطی
        const nodesData = @json($nodes);
        const edgesData = @json($edges);

        // تعیین رنگ بر اساس وضعیت
        const coloredNodes = nodesData.map(node => {
            let color = '#999'; // رنگ پیش‌فرض خاکستری

            if (node.status === 'ارسال') color = '#F44336';       // قرمز
            else if (node.status === 'در حال ارسال') color = '#FFEB3B'; // زرد
            else if (node.status === 'بازگشت') color = '#4CAF50';  // سبز

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
                shape: 'circle',
                borderWidth: 2
            },
            physics: true
        };

        new vis.Network(container, data, options);
    });

</script>

