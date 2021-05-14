@extends('layouts.app')
@section('content')
<div>
    <div>   
        @livewire('phieu-chi.cong-cu-phieu-chi')
        <x-table>
            <x-slot name="head"> 
                <x-table.heading >
                    <x-input.checkbox></x-input.checkbox>
                </x-table.heading >
                <x-table.heading >#</x-table.heading> 
                <x-table.heading >Ngày lập</x-table.heading>  
                <x-table.heading >Nhân viên lập</x-table.heading>
                <x-table.heading >Nội dung chi</x-table.heading>
                <x-table.heading >Tổng chi</x-table.heading> 
                <x-table.heading></x-table.heading>  
            </x-slot>
            <x-slot name="body">
                @foreach ($phieuchi as $pc)
                    <x-table.row>
                        <x-table.cell>
                            @livewire('phieu-chi.checkbox-phieu-chi', ['idPhieuchi' => $pc->id])
                        </x-table.cell>
                        <x-table.cell>{{ $loop->iteration }}</x-table.cell> 
                        <x-table.cell>{{  $pc->ngay_lap }}</x-table.cell>
                        <x-table.cell>{{  $pc->nhanvien->HoTenNV }}</x-table.cell>
                        <x-table.cell>{{  $pc->NoiDungChi }}</x-table.cell>
                        <x-table.cell class="font-semibold">{{  money_format('%.0n', $pc->TongTien) }}</x-table.cell>
                        <x-table.cell style="max-width: 70px">
                            @livewire('phieu-chi.edit-phieu-chi', ['id' => $pc->id], key($pc->id))
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>   
        @livewire('phieu-chi.them-moi-phieu-chi')
    </div>
</div>
@endsection