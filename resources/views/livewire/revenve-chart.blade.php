<div class="w-[50%] hover:scale-110 rounded shadow-md bg-white">

    <canvas id="dfds"></canvas>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById("dfds");

        var revenvechart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Revenue of this month',
                    data: @json($total_rental_price),
                    backgroundColor: '#708090',
                    borderWidth: 2
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
