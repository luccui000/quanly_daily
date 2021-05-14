@extends('layouts.app') 
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid mt-2">
        <div class="row"> 
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white opacity-90">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h2 class="mb-0 font-semibold" style="font-size: large;"> {{ App\Models\MatHang::all()->count() }}</h2>
                                <p class="mb-0">{{ __('Mặt hàng')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div> 
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white opacity-90">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0" style="font-size: large">{{ __('865')}}</h4>
                                <p class="mb-0">{{ __('Đặt hàng')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-balance-scale f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white opacity-90">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0" style="font-size: large">{{ __('865')}}</h4>
                                <p class="mb-0">{{ __('Khách Hàng')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-user-cog f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div> 
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white opacity-90">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0" style="font-size: large">{{ __(money_format('%.0n', 90000000))}}</h4>
                                <p class="mb-0">{{ __('Tổng doanh thu')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-user-cog f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="">
            @livewire('bieu-do.bieu-do-cuoi-ngay')
        </div> 
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>    
    <script src="{{ URL::asset('js/widget-statistic.js') }}"></script> 
    <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script> 
@endpush