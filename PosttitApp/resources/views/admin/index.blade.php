@extends('layouts.app')

@section('content')

    <div class="container w-100">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Statistics</h5>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">

                                    <div class="col-sm" >
                                        <canvas id="doughnut-chart" width="400" height="225"></canvas>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <canvas id="bar-chart" width="400" height="225"></canvas>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>

        </div>

    <script>

        var ctx = document.getElementById('doughnut-chart').getContext('2d');
        var myChart = new Chart(ctx, {

            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($Topics); ?>,
                // labels: month,
                datasets: [
                    {
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderWidth: 1,
                        data: <?php echo json_encode($Data); ?>
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total posts by topics'
                }
            }

        })



    </script>

    <script>

        var ctx = document.getElementById('bar-chart').getContext('2d');
        var myChart = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: <?php echo json_encode($Profile_Names); ?>,
                // labels: month,
                datasets: [
                    {
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderWidth: 1,
                        data: <?php echo json_encode($Profile_Ratings); ?>
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Profiles with the most ratings'
                }
            }

        })



    </script>


@endsection
