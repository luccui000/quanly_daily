@extends('layouts.app')
@section('content')
    <div> 
        @livewire('phieu-xuat.cong-cu-phieu-xuat')
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
                @foreach ($phieuxuat as $px)
                    <x-table.row>
                        <x-table.cell> <x-input.checkbox></x-input.checkbox></x-table.cell> 
                        <x-table.cell> {{ 'PX000' .  $px->id }}</x-table.cell> 
                        <x-table.cell> {{ $px->ngay_lap }}</x-table.cell> 
                        <x-table.cell> {{ $px->nhanvien->HoTenNV }}</x-table.cell> 
                        <x-table.cell> {{$px->khachhang->HoTenKH }}</x-table.cell> 
                        <x-table.cell class="font-semibold"> {{ money_format('%.0n', $px->TongChietKhau) }}</x-table.cell> 
                        <x-table.cell class="font-semibold"> {{ money_format('%.0n', $px->TongThanhToan) }}</x-table.cell> 
                        <x-table.cell> 
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $px->mau_sac_trang_thai }}-100 text-{{ $px->mau_sac_trang_thai }}-800">
                                {{ $px->TrangThai ? 'Đã tính tiền' : 'Chưa thanh toán' }}
                            </span> 
                        </x-table.cell> 
                        <x-table.cell> 
                            @livewire('phieu-chi.edit-phieu-chi', ['id' => $px->id], key($px->id))
                        </x-table.cell> 
                    </x-table.row>
                @endforeach 
            </x-slot>
        </x-table> 
    </div>
    @livewire('phieu-xuat.them-moi-phieu-xuat')
@endsection