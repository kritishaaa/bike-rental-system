<div>
    {{ $month }}
    <div style="width: 70vw;height: 400px;" class="flex justify-center items-center m-3">
        <canvas id="dfds" style="width: inherit; height: inherit;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById("dfds");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Revenue of this month',
                    data: @json($total_rental_price),
                    backgroundColor: '#708090',
                    borderWidth: 3.5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Set to false to control the chart's aspect ratio based on the provided width and height
            }
        });
    </script>
</div>
