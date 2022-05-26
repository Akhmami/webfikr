<x-dash-layout>
    <x-slot name="breadtitle">
        Dashboard
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row space-x-4 mb-6">
            <div class="md:w-4/6 flex flex-col px-4 md:px-0">
                <!-- Stat here -->
                @include('dash._stat')

                <!-- Chart -->
                @include('dash._chart')
            </div>

            <!-- Report -->
            <div class="md:w-2/6 mt-6 pr-4 md:pr-0 md:mt-0 flex flex-col">
                @include('dash._report')
            </div>
        </div>

        <div class="flex space-x-4">
            <!-- User Activity -->
            <div class="w-4/6">
                @include('dash._user_activity')
            </div>

            <!-- Balance -->
            <div class="w-2/6">
                @include('dash._balance')
            </div>
        </div>
    </main>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>
            Number.prototype.m_formatter = function() {
                    return this > 999999 ? (this / 1000000).toFixed(1) + 'M' : this
                };
            let stockTicker = function(){
                return {
                    chartData: {
                        labels: ['10:00','','','','12:00','','','','2:00','','','','4:00'],
                        data: [2.23,2.215,2.22,2.25,2.245,2.27,2.28,2.29,2.3,2.29,2.325,2.325,2.32],
                    },
                    renderChart: function(){
                        let c = false;
        
                        Chart.helpers.each(Chart.instances, function(instance) {
                            if (instance.chart.canvas.id == 'chart') {
                                c = instance;
                            }
                        });
        
                        if(c) {
                            c.destroy();
                        }
        
                        let ctx = document.getElementById('chart').getContext('2d');
        
                        let chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: this.chartData.labels,
                                datasets: [
                                    {
                                        label: '',
                                        backgroundColor: "rgba(37, 99, 235, 0.2)",
                                        borderColor: "rgba(37, 99, 235, 1)",
                                        pointBackgroundColor: "rgba(37, 99, 235, 1)",
                                        data: this.chartData.data,
                                    },
                                ],
                            },
                            layout: {
                                padding: {
                                    right: 10
                                }
                            },
                            options: {
                                legend: {
                                    display: false,
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            fontColor: "rgba(55, 65, 81, 1)",
                                        },
                                        gridLines: {
                                            color: "rgba(55, 65, 81, .2)",
                                            borderDash: [5, 5],
                                            zeroLineColor: "rgba(55, 65, 81, .2)",
                                            zeroLineBorderDash: [5, 5]
                                        },
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            fontColor: "rgba(55, 65, 81, 1)",
                                        },
                                        gridLines: {
                                            display: false,
                                        },
                                    }]
                                }
                            }
                        });
                    }
                }
            }
        </script>
    @endpush
</x-dash-layout>
