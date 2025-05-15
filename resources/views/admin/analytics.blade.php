@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Paper Analytics: Views and Downloads</h2>

    <canvas id="analyticsChart" height="100"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('analyticsChart').getContext('2d');

    const data = {
        labels: {!! json_encode($papers->pluck('title')) !!},
        datasets: [
            {
                label: 'Views',
                data: {!! json_encode($papers->pluck('views')) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.6)', // blue
            },
            {
                label: 'Downloads',
                data: {!! json_encode($papers->pluck('downloads')) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.6)', // green
            }
        ]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Top Papers by Views and Downloads'
                }
            }
        }
    };

    new Chart(ctx, config);
</script>
@endpush
