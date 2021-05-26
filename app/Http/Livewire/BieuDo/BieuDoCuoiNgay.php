<?php

namespace App\Http\Livewire\BieuDo;

use App\Models\ChiTietPhieuXuat;
use App\Models\LoaiMatHang;
use App\Models\MatHang;
use App\Models\PhieuXuat;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class BieuDoCuoiNgay extends Component
{ 
    public $types = []; 
    public $colors = [
        '1' => '#cccccc',
        '2' => '#fc8181',
        '3' => '#56403E',
        '4' => '#FCFCFC',
    ];
    public $loaiMatHang = [
        '1' => 'Điện thoại',
        '2' => 'Máy tính',
        '3' => 'Phụ kiện',
        '4' => 'Thiết bị văn phòng',
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
        $phieuxuat = PhieuXuat::orderBy('created_at')->get();
        $lineChartModel = $phieuxuat
            ->reduce(function ($lineChartModel, $data) use ($phieuxuat) {
                $index = $phieuxuat->first()->created_at->format('m');
                $amountSum = $phieuxuat->take($index + 1)->sum('TongThanhToan'); 
                
                return $lineChartModel->addPoint($index, $data->TongThanhToan, ['id' => $data->id]);
            }, LivewireCharts::lineChartModel()
                ->setTitle('Biến động bán hàng')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            ); 
        
        $chitietPX = \DB::table('CHITIET_PHIEUXUAT')
                        ->join('MATHANG', 'MATHANG.id', '=', 'CHITIET_PHIEUXUAT.mathang_id')
                        ->select('TenMH', \DB::raw('count(SoLuong) as SoLuongBan'))
                        ->groupBy('mathang_id')
                        ->get();
        
            
        $columnChartModel2 = $chitietPX
            ->reduce(function ($columnChartModel2, $data) {   
                return $columnChartModel2->addColumn($data->TenMH, $data->SoLuongBan, $this->colors[1]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Số lượng bán được')
                ->setAnimated($this->firstRun) 
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                // ->setOpacity(0.25)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
                ->withGrid()
            ); 
         
        $this->firstRun = false;
        return view('livewire.bieu-do.bieu-do-cuoi-ngay')
            ->with([
                'columnChartModel' => $columnChartModel2,
                'lineChartModel' => $lineChartModel
            ]);
    }
}
