@extends('layouts.app')
@section('content') 
    @livewire('phieu-xuat.cong-cu-phieu-xuat')
    <div x-data="{ openTab: 0 }"  data-tabs-active-tab="-mb-px border-l border-t border-r rounded-t" data-tabs-index="2">
        <ul class="flex border-b">
        @foreach (App\MyApp::TRANG_THAI_PHIEU_XUAT as $index => $trangthai)
            <li @click="openTab = {{ $index }}" class="-mb-px mr-1">
                <a x-bind:class="{ 'bg-gray-50 text-green-500': openTab === {{$index}} }" class="cursor-pointer inline-block border-l border-t border-r rounded-t py-2 px-4 text-gray-500 font-semibold hover:text-green-500">{{ $trangthai }}</a>
            </li>  
            @endforeach
        </ul> 
        <div class="w-full" >
            @php
                $TrangThai = [0 => "DangChoXacNhan", 1 => "DangGiaoHang", 2 => "DaThanhToan"]
            @endphp 
            @foreach (App\MyApp::TRANG_THAI_PHIEU_XUAT as $index => $trangthai)
                <div x-show="openTab === {{ $index }}"> 
                    <x-table>
                        <x-slot name="head">  
                            <x-table.heading >
                                <x-input.checkbox></x-input.checkbox>
                            </x-table.heading > 
                            <x-table.heading >#</x-table.heading> 
                            <x-table.heading >Ngày lập</x-table.heading>  
                            <x-table.heading >Nhân viên lập</x-table.heading>
                            <x-table.heading >Khách hàng</x-table.heading>
                            <x-table.heading >Tổng giảm giá</x-table.heading>
                            <x-table.heading >Tổng thanh toán</x-table.heading>
                            <x-table.heading>Trạng thái</x-table.heading>  
                            <x-table.heading></x-table.heading>  
                        </x-slot>
                        <x-slot name="body">  
                            @foreach (${$TrangThai[$index]} as $px)
                                <x-table.row>
                                    <x-table.cell> 
                                        @livewire('phieu-xuat.check-box', ['idPhieuXuat' => $px->id])
                                    </x-table.cell> 
                                    <x-table.cell> {{  $px->ma_phieu_xuat }}</x-table.cell> 
                                    <x-table.cell> {{ $px->ngay_lap }}</x-table.cell> 
                                    <x-table.cell> {{ $px->nhanvien->HoTenNV }}</x-table.cell> 
                                    <x-table.cell> {{$px->khachhang->HoTenKH }}</x-table.cell> 
                                    <x-table.cell class="font-semibold"> {{ money_format('%.0n', $px->TongChietKhau) }}</x-table.cell> 
                                    <x-table.cell class="font-semibold"> {{ money_format('%.0n', $px->TongThanhToan) }}</x-table.cell> 
                                    <x-table.cell> 
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $px->mau_sac_trang_thai }}-100 text-{{ $px->mau_sac_trang_thai }}-800">
                                            {{ $px->ten_trang_thai }}
                                        </span> 
                                    </x-table.cell> 
                                    <x-table.cell> 
                                        <div class="space-x-2">
                                            <a href="{{ route('dashboard.phieuxuat.show', ['id' => $px->id]) }}"  type="button" class="text-cool-gray-700 text-sm font-medium border-r border-gray-600 hover:text-green-500" >
                                                Xem
                                            </a>
                                            <a href="{{ route('dashboard.phieuxuat.exportPdf', ['id' => $px->id ]) }}"  type="button" class="text-cool-gray-700 text-sm font-medium  hover:text-green-500" >
                                                In phiếu
                                            </a>
                                        </div>
                                    </x-table.cell> 
                                </x-table.row>
                            @endforeach 
                        </x-slot>
                    </x-table> 
                </div>
            @endforeach 
        </div>
    </div>
    @livewire('phieu-xuat.them-moi-phieu-xuat')
@endsection