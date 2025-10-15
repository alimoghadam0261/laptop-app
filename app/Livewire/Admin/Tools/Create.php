<?php

    namespace App\Livewire\Admin\Tools;

    use App\Models\Category_tools;
    use App\Models\Tools;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Create extends Component
    {
        public $name;
        public $model;
        public $size;
        public $serial_jam;
        public $content;
        public $category_id;
        public $user_id;
        public $color;
        public $price;
        public $year;
        public $status;
        public $categories = [];

        public function mount()
        {
            $this->categories = Category_tools::select('id', 'name')->get();

        }


        public function save()
        {

            $this->validate([
                'name' => 'required',
                'status' => 'required',
                'serial_jam' => 'required|unique:tools,serial_jam',
                'category_id' => 'required',
            ]);

            $tool =Tools::create([
                'name' => $this->name,
                'model' => $this->model,
                'size' => $this->size,
                'price' => $this->price,
                'year' => $this->year,
                'status' => $this->status,
                'serial_jam' => $this->serial_jam,
                'content' => $this->content,
                'category_id' => $this->category_id,
                'user_id' => Auth::id(),
                'color' => $this->color,
            ]);
            session()->flash('success', 'ابزار با موفقیت ثبت شد ✅');
            $this->reset(); // ریست فرم بعد از ثبت
          return redirect()->to('/admin/tools/index');
        }
        public function render()
        {
            return view('livewire.admin.tools.create');
        }
    }
