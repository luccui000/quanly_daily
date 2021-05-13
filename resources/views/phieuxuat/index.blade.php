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
                <x-table.heading >Mã phiếu xuất</x-table.heading>
                <x-table.heading >Ngày lập</x-table.heading>  
                <x-table.heading >Nhân viên lập</x-table.heading>
                <x-table.heading >Khách hàng</x-table.heading>
                <x-table.heading >Tổng giảm giá</x-table.heading>
                <x-table.heading >Tổng thanh toán</x-table.heading>
                <x-table.heading>Trạng thái</x-table.heading>  
                <x-table.heading></x-table.heading>  
            </x-slot>
            <x-slot name="body">

            </x-slot>
        </x-table> 
    </div>
    @livewire('phieu-xuat.them-moi-phieu-xuat')
@endsection