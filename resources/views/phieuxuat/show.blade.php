@extends('layouts.app')
@section('content')
<form action="{{ route('dashboard.nhaphang.store') }}" method="POST" class="flex space-x-2 m-0 h-screen" >
    @csrf  
    <div class="flex-grow h-full" style=" overflow: auto">  
        <div class=""> 
            <div class="flex justify-between">
                <div class="flex space-x-2">
                    <a href="{{ url()->previous() }}" class="hover:text-green-200 font-semibold" style="margin-top: 12px;" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div class=" inline flex space-between space-x-2" style="width: 500px;">
                        <h2 class="flex-none text-md font-semibold mt-3 uppercase">Xuất hàng</h2> 
                    </div>  
                </div> 
            </div>
            <div class="mt-2">
                <x-table>
                    <x-slot name="head">  
                        <x-table.heading >STT</x-table.heading>
                        <x-table.heading >Mã hàng</x-table.heading>
                        <x-table.heading >Tên hàng</x-table.heading> 
                        <x-table.heading >Số lượng</x-table.heading>
                        <x-table.heading >Đơn giá</x-table.heading>
                        <x-table.heading >Giảm giá</x-table.heading> 
                        <x-table.heading >Thành tiền</x-table.heading>   
                    </x-slot>
                    <x-slot name="body">     
                        @foreach ($phieuxuat->mathang as $index => $mathang) 
                            <x-table.row>
                                <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                                <x-table.cell>{{ $mathang->MaMH }}</x-table.cell>
                                <x-table.cell>{{ $mathang->TenMH }}</x-table.cell> 
                                <x-table.cell>{{ $mathang->pivot->SoLuong }}</x-table.cell> 
                                <x-table.cell class="text-md font-bold text-gray-700">{{ money_format('%.0n', $mathang->pivot->DonGia) }}</x-table.cell>
                                <x-table.cell class="text-md font-bold text-gray-700">{{ money_format('%.0n', $mathang->pivot->TienChietKhau) }}</x-table.cell>
                                <x-table.cell class="text-md font-bold text-gray-700">{{ money_format('%.0n', $mathang->pivot->ThanhTien) }}</x-table.cell>
                            </x-table.row>
                        @endforeach 
                    </x-slot>
                </x-table> 
            </div>
        </div>
    </div> 
    <div class="h-full flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative" >   
        <div class="relative mb-3">   
            <h1 class="font-bold text-lg">Thông tin đơn hàng</h1> 
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Mã phiếu xuất</h2>
                <p>{{ $phieuxuat->ma_phieu_xuat}}</p>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Ngày lập</h2>
                <p>{{ $phieuxuat->ngay_lap}}</p>
            </div>
            <x-input.group label="Nhân viên lập" for="nhanvien_id">
                <x-input.select name="nhanvien_id" > 
                    @foreach ($nhanviens as $nhanvien)
                    <option value="{{ $nhanvien->id }}">{{ $nhanvien->HoTenNV }}</option> 
                    @endforeach 
                </x-input.select>
            </x-input.group>
            <div class="mt-6 mb-2">
                <hr>
            </div>
            <h1 class="font-bold text-lg">Thông tin khách hàng</h1> 
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Họ tên khách hàng</h2>
                <p>{{ $phieuxuat->khachhang->HoTenKH }}</p>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Số điện thoại KH</h2>
                <p>{{ $phieuxuat->khachhang->DienThoai }}</p>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold w-60">Địa chỉ KH</h2>
                <p>{{ $phieuxuat->khachhang->DiaChi }}</p>
            </div>
            <div class="mt-6 mb-6">
                <hr>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Trạng thái</h2>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $phieuxuat->mau_sac_trang_thai }}-100 text-{{ $phieuxuat->mau_sac_trang_thai }}-800">
                    {{ $phieuxuat->ten_trang_thai }}
                </span>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Tổng tiền hàng</h2>
                <p class="font-bold">{{ money_format('%.0n', $phieuxuat->TongTien) }}</p>
            </div> 
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Tổng VAT</h2>
                <p class="font-bold">{{ money_format('%.0n', $phieuxuat->TongVAT) }}</p>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold">Tổng giảm giá</h2>
                <p class="font-bold">{{ money_format('%.0n', $phieuxuat->TongChietKhau) }}</p>
            </div>
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold mt-1">Tiền khách phải trả</h2>
                <p class="text-lg text-blue-400 font-semibold">{{ money_format('%.0n', $phieuxuat->TongThanhToan) }}</p>
            </div>
            <div class="mt-6 mb-6">
                <hr>
            </div> 
            <div class="flex justify-between mt-3 mb-3">
                <h2 class="text-gray-800 font-bold mt-1">Hình thức thanh toán</h2>
                <p class="font-bold">{{ $phieuxuat->ten_hinh_thuc_thanh_toan }}</p> 
            </div>
            <x-input.group label="Mô tả" for="MoTa">
                <textarea class="p-2 border-2 border-gray-200 rounded-md " name="MoTa" cols="38" rows="5" placeholder="Mô tả... "></textarea>
            </x-input.group> 
            <div class="flex float-right mt-12 space-x-2"> 
                <x-button type="button"><p class="text-gray-900">Hủy</p></x-button>
                <x-button.success type="button">Xác nhận</x-button.success>
                <x-button.primary type="button" wire:click="export('pdf')">In phiếu</x-button.primary>
            </div> 
        </div> 
    </div> 
</form> 
@endsection