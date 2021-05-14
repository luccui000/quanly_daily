<?php

namespace App\Http\Livewire\BieuDo;

use App\Models\LoaiMatHang;
use App\Models\MatHang;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class BieuDoCuoiNgay extends Component
{ 
    public $types = []; 
    public $colors = [
        '1' => '#cccccc',
        '2' => '#fc8181'
    ];
    public $loaiMatHang = [
        '1' => 'Điện thoại',
        '2' => 'Máy tính'
    ];
    public $firstRun = true;
    public $showDataLabels = false;
    
    public function mount()
    {
        $this->types = LoaiMatHang::select('id')->get(); 
    }
    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function render()
    { 
        $expenses = MatHang::whereIn('loaimathang_id', $this->types)->get();
        $columnChartModel = $expenses->groupBy('loaimathang_id')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->loaimathang_id;
                $value = $data->sum('GiaNhap');

                return $columnChartModel->addColumn($this->loaiMatHang[$type], $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Trung bình giá nhập')
                ->setAnimated($this->firstRun) 
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                // ->setOpacity(0.25)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
                ->withGrid()
            );  
        $lineChartModel = $expenses
            ->reduce(function ($lineChartModel, $data) use ($expenses) {
                $index = $expenses->search($data); 
                $amountSum = $expenses->take($index + 1)->sum('GiaNhap'); 

                return $lineChartModel->addPoint($index, $data->GiaNhap, ['id' => $data->id]);
            }, LivewireCharts::lineChartModel()
                ->setTitle('Biến động bán hàng')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            ); 
        $this->firstRun = false;
        return view('livewire.bieu-do.bieu-do-cuoi-ngay')
            ->with([
                'columnChartModel' => $columnChartModel,
                'lineChartModel' => $lineChartModel
            ]);
    }
}
