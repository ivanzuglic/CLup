@extends('layouts.base')

@section('title','Store Statistics')

@section('main')
<div class="form widget widget-extra-large">
    @if($stat_exists == true || $occ_exists == true)
        <div class="widget-header title-only">
            <h2 class="widget-title">Store Statistics</h2>
        </div>
    @else
        <div class="widget-header title-only">
            <h2 class="widget-title">Store Statistics Not Available For This Store</h2>
        </div>
    @endif
    @if($occ_exists == true)
        <div class="chart-cotainer-large">
            <canvas id="myLargeChart"></canvas>
        </div>
    @endif
    @if($stat_exists == true)
        <div class="stat-parameters">
            <div class="stat-container">
                <section class="stat-label">
                    Visits Per Day (AVG):
                </section>
                <section class="stat-value">
                    {{ $statistical_data->avg_customers }}
                </section>
            </div>
            <div class="stat-container">
                <section class="stat-label">
                    Total Visits:
                </section>
                <section class="stat-value">
                    {{ $statistical_data->n_customers }}
                </section>
            </div>
            <div class="stat-container">
                <section class="stat-label">
                    Visit Length (AVG):
                </section>
                <section class="stat-value">
                    {{ $statistical_data->avg_time_spent_min }}'
                </section>
            </div>
            <div class="stat-container">
                <section class="stat-label">
                    Days Tracked:
                </section>
                <section class="stat-value">
                    {{ $statistical_data->n_days }}
                </section>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    var chartOccupancyData = {{ json_encode($occupancy_array) }};
</script>
@endsection
