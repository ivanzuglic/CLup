@extends('layouts.base')

@section('title','Store Statistics')

@section('main')
<div class="form widget widget-extra-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Store Statistics</h2>
    </div>
    <div class="chart-cotainer-large">
        <canvas id="myLargeChart"></canvas>
    </div>
    <div class="stat-parameters">
        <div class="stat-container">
            <section class="stat-label">
                Stat 1:
            </section>
            <section class="stat-value">
                120
            </section>
        </div>
        <div class="stat-container">
            <section class="stat-label">
                Stat 2:
            </section>
            <section class="stat-value">
                120
            </section>
        </div>
        <div class="stat-container">
            <section class="stat-label">
                Stat 3:
            </section>
            <section class="stat-value">
                120
            </section>
        </div>
        <div class="stat-container">
            <section class="stat-label">
                Stat 4:
            </section>
            <section class="stat-value">
                120
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
    var chartOccupancyData = [.1,.3,.5,.4,.9,.3,.4,.5,.6,.7,.8,.9,.2,.2,.4,.5,.3,.7];
</script>
@endsection