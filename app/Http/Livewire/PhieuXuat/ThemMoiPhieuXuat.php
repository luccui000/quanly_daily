<?php

namespace App\Http\Livewire\PhieuXuat;

use App\Models\CodeGenerator;
use App\Models\KhachHang;
use App\Models\Kho;
use App\Models\MatHang;
use Carbon\Carbon;
use Livewire\Component;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class ThemMoiPhieuXuat extends Component
{
    protected $listeners = ['themmoi' => 'ThemMoi', 'ThemMatHang' => 'ThemMatHang']; 
     
    public $showModal = false;  

    public $PTGiamGia = 0;
    public $PTVAT = 0;
    public $NgayLap;

    public $danhsachBanHang = [];
    public $danhsachMatHang = [];
    public $khachhang = [];
    public $kho = [];
    public $MaPX;
    public $inPhieu = 0;
    
    public function mount() {
        $this->NgayLap = Carbon::now()->format('d/m/Y');
    
        $this->MaPX = CodeGenerator::layMa('MaPhieuXuat');
        $this->khachhang = KhachHang::orderBy('created_at')->get();
        $this->kho = Kho::all();
        $this->danhsachMatHang = MatHang::with('donvitinh')->latest()->get();
    }
    public function ThemMoi($index = 0) 
    { 
        $mathang = MatHang::with('donvitinh')->inRandomOrder()->first();
        if($index == 0)
            array_shift($this->danhsachBanHang);
        $this->danhsachBanHang[] = [ 
            'id' => $mathang->id,
            'prevId' => $mathang->id,
            'MaMH' => $mathang->MaMH,
            'TenMH' => $mathang->TenMH,
            'TenDVT' => $mathang->donvitinh->TenDVT,
            'DonGia' => (float)$mathang->GiaXuat,
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $mathang->GiaXuat,
        ];
        $this->showModal = true;
    } 
    public function decrement($index) {
        $this->danhsachBanHang[$index]['SoLuong'] > 0 ? $this->danhsachBanHang[$index]['SoLuong']-- : 0;
    }
    public function increment($index) {
        $this->danhsachBanHang[$index]['SoLuong']++;
    }
    public function boMatHang($index)
    {  
        unset($this->danhsachBanHang[$index]);
        $this->danhsachBanHang = array_values($this->danhsachBanHang); 
    }
    public function ThemMatHang(MatHang $mathang) 
    {
        if(in_array($mathang->id, $this->idMatHangDachon())) {
            $index = array_search($mathang->id, $this->idMatHangDachon());
            $this->danhsachBanHang[$index]['SoLuong'] += 1; 
        } else {
            $this->danhsachBanHang[count($this->danhsachBanHang)] = $this->capnhatThongTinMatHangDaChon($mathang);   
        }
    }
    private function idMatHangDachon()
    {
        $ids = [];
        foreach($this->danhsachBanHang as $index => $banhang) {
            $ids[$index] = $banhang['id'];
        }
        return $ids;
    }
    public function export($ext) 
    {
        if(count($this->danhsachBanHang) == 0) {
            $this->dispatchBrowserEvent('swal.modal', [
                'title' => 'Vui lòng chọn ít nhất 1 mặt hàng',
                'type' => 'warning'
            ]);
        } else {
            $this->inPhieu = 1;
            $this->dispatchBrowserEvent('swal.modal', [
                'title' => 'Phiếu hàng sẽ tải xuống sau khi lưu',
                'type' => 'success'
            ]); 
            abort_if(!in_array($ext, ['pdf']), Response::HTTP_NOT_IMPLEMENTED);
            $pdf = PDF::loadView('pdf.hello')->output();
            return response()->streamDownload(
                fn () => print($pdf),
                "filename.pdf"
           );
        }
    }
    public function render()
    {   
        $TongTienHang = 0;
        $TongChietKhau = 0;
        $TongVAT = 0;
        foreach($this->danhsachBanHang as $index => $banhang) {   
            if($banhang['prevId'] != $banhang['id']) {   
                $mathang = MatHang::where('id', $banhang['id'])->with('donvitinh')->first(); 
                $banhang = $this->capnhatThongTinMatHangDaChon($mathang);   
            }   
            $GiaGoc =  $banhang['SoLuong'] * $banhang['DonGia'];
            $banhang['ThanhTien'] = $GiaGoc - ($GiaGoc * $banhang['GiamGia'] / 100);
            $this->danhsachBanHang[$index] = $banhang; 
            $TongTienHang += $banhang['ThanhTien'];
        } 
        $TongChietKhau = $TongTienHang * $this->PTGiamGia / 100;
        $TongVAT = $TongTienHang * $this->PTVAT / 100;
        $TongThanhToan = $TongTienHang + $TongVAT -  $TongChietKhau;
        return view('livewire.phieu-xuat.them-moi-phieu-xuat', [
            'TongTienHang' => $TongTienHang, 
            'TongThanhToan' => $TongThanhToan
        ]);
    }
    public function capnhatThongTinMatHangDaChon($mathang)
    {
        return [
            'id' => $mathang->id,
            'prevId' => $mathang->id,
            'MaMH' => $mathang->MaMH,
            'TenMH' => $mathang->TenMH,
            'TenDVT' => $mathang->donvitinh->TenDVT, 
            'DonGia' => $mathang->GiaXuat, 
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $mathang->GiaXuat
        ];
    } 
}
