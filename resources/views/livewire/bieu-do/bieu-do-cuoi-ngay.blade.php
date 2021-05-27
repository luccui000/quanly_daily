<div>   
    <div class="container-fluid mx-auto space-y-4 sm:p-0 mt-2">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 40rem;">
                <livewire:livewire-column-chart
                    key="{{ $columnChartModel->reactiveKey() }}"
                    :column-chart-model="$columnChartModel"
                />
            </div>  
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 40rem;">
                <livewire:livewire-column-chart
                    key="{{ $columnChartModel2->reactiveKey() }}"
                    :column-chart-model="$columnChartModel2"
                />
            </div>   
        </div> 
    </div>
</div>
