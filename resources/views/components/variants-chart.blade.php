<div>
    <p>{{ $month }}</p>
    <div style="width: 70vw;height: 400px;" class="flex justify-center items-center m-3">
        <canvas id="{{ $idvalue }}" style="width: inherit; height: inherit;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const {{ $idvalue }} = document.getElementById("{{ $idvalue }}");

        var variantchart = new Chart({{ $idvalue }}, {
            type: 'bar',
            data: {
                labels: @json($variant_names),
                datasets: [{
                    label: 'Variants Rental Counts',
                    data: @json($variant_counts),
                    backgroundColor: '#708090',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false // Set to false to control the chart's aspect ratio based on the provided width and height
            }
        });
    </script>
</div>
