<div class="w-[50%] hover:scale-110 rounded shadow-md bg-white">


    <canvas id="variantcounts"></canvas>

    <script>
        // Data for the chart
        const labels = @json($variant_names);
        const data = @json($variant_counts);


        // Get the chart canvas element
        const variantcounts = document.getElementById('variantcounts').getContext('2d');

        // Create the bar chart
        var variantchart = new Chart(variantcounts, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Variants Rent Counts',
                    data: data,
                    backgroundColor: '#708090', // Set the bar color
                    borderColor: '#708099', // Set the border color
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</div>
