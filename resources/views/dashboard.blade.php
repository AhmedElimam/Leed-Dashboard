@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @extends('partials.sidebar')

    <h1 class="text-3xl text-black pb-6">Dashboard</h1>

    <div class="flex flex-wrap mt-6">
        <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-plus mr-3"></i> Monthly Reports
            </p>
            <div class="p-6 bg-white">
                <canvas id="chartOne" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-check mr-3"></i> Resolved Reports
            </p>
            <div class="p-6 bg-white">
                <canvas id="chartTwo" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, { /* Chart JS Code */ });

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, { /* Chart JS Code */ });
    </script>
@endpush
