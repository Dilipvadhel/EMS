<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin-top: 30px;
            background: #FAFAFA;
        }

        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.10px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 40px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;

        }

        .card .card-block {
            padding: 29px;
        }

        .chart-container {
            margin-top: 259px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 30px;

        }

        .chart-wrapper {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            /* justify-content: space-between; */
            align-items: flex-start;

        }

        .chart-card {
            flex: 1 1 calc(50% - 50px);
            max-width: calc(37% - 60px);
            max-height: 250px;
            margin-left: 290px;
            margin-top: -15%;
            flex-grow: 1;

        }

        .custom-col-md-3 {
            margin-bottom: 20px;
            margin-left: 155px;
            margin-right: 15px;
        }

    </style>

</head>
<body>
    @include('welcome')
    <div class="container" style="margin-right: 150px;">

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-success" style="margin-left:-50%; width:24rem">
                    <div class="card-header text-light">
                        <h6>Vendors</h6>
                    </div>
                    <div class="card-body">
                        <span class="text-light">
                            <h3 id="vendorCount">{{ $vendorCount }}</h3>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-primary" style="margin-left:-30%; width:24rem">
                    <div class="card-header text-light">
                        <h6> Total Expenses</h6>
                    </div>
                    <div class="card-body">
                        <span class="text-light">
                            <h3 id="totalExpense">{{ $totalExpense }}</h3>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-secondary" style="margin-left:-10%; width:24rem">
                    <div class="card-header text-light">
                        <h6>Payments</h6>
                    </div>
                    <div class="card-body">
                        <h3 class="text-light" id="totalPayment">{{ $totalPayment }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-info" style="margin-left:10%; width:24rem">
                    <div class="card-header text-light">
                        <h6>Tota Users</h6>
                    </div>
                    <div class="card-body">
                        <h3 class="text-light" id="userCount">{{$userCount}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-wrapper">
            <div class="chart-card">
                <div class="card">
                    <div class="card-header bg-info">
                        Expense View
                    </div>
                    <select name="yearSelect" id="yearSelect" class="form-control w-25 mb-3 mt-2 ml-1">year
                        @foreach(array_combine(range(date("Y"), 2010), range(date("Y"), 2010)) as $year)
                        <option value="{{ $year }}" @if($year===old('year', Request::get('year', date('Y')))) selected @endif>
                            {{ $year }}
                        </option>
                        @endforeach
                    </select>
                    <div class="card-body">
                        <canvas id="barChart" width="300" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-wrapper">
                    <div class="card" style="width: 40rem;">
                        <div class="card-header bg-light">
                            Transactios Details
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" width="300" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    function getTransactionsBalance(month) {
                        fetch(`/transactions-balance/${month}`)
                            .then(response => response.json())
                            .then(data => {
                                lineChart.data.labels = data.months;
                                lineChart.data.datasets[0].data = data.balances;
                                lineChart.update();
                            });
                    }

                    var barChartCtx = document.getElementById('barChart').getContext('2d');
                    let barChart = new Chart(barChartCtx, {
                        type: 'bar'
                        , data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
                            , datasets: [{
                                label: 'Expense'
                                , data: Array(12).fill(0)
                                , backgroundColor: 'rgba(54, 162, 235, 0.2)'
                                , borderColor: 'rgba(54, 162, 235, 1)'
                                , borderWidth: 2
                            }]
                        }
                        , options: {
                            responsive: true
                            , plugins: {
                                legend: {
                                    position: 'top'
                                }
                                , title: {
                                    display: true
                                    , text: 'Monthly Expense Data'
                                }
                            }
                            , scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    fetch('/expense-amount')
                        .then(response => response.json())
                        .then(data => {
                            const months = Object.keys(data).map(month => parseInt(month) - 1);
                            const expenses = Object.values(data);

                            months.forEach((monthIndex, index) => {
                                barChart.data.datasets[0].data[monthIndex] = expenses[index];
                            });

                            barChart.update();
                        });

                    var lineChartCtx = document.getElementById('lineChart').getContext('2d');
                    var lineChart = new Chart(lineChartCtx, {
                        type: 'line'
                        , data: {
                            labels: []
                            , datasets: [{
                                label: 'Balance'
                                , data: []
                                , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                                , borderColor: 'rgba(75, 192, 192, 1)'
                                , borderWidth: 2
                            }]
                        }
                        , options: {
                            responsive: true
                            , plugins: {
                                legend: {
                                    position: 'top'
                                }
                                , title: {
                                    display: true
                                    , text: 'Transaction Balances'
                                }
                            }
                            , scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    fetch('/transaction-balances')
                        .then(response => response.json())
                        .then(data => {
                            const months = data.map(entry => {
                                return entry.year + '/' + entry.month;
                            });
                            const balances = data.map(entry => entry.balance);

                            lineChart.data.labels = months;
                            lineChart.data.datasets[0].data = balances;
                            lineChart.update();
                        });

                    document.getElementById('yearSelect').addEventListener('change', function() {
                        const selectedYear = this.value;
                        fetchExpenseData(selectedYear);
                    });

                    function fetchExpenseData(year) {
                        fetch(`/expense-data/${year}`)
                            .then(response => response.json())
                            .then(data => {
                                const months = Object.keys(data).map(month => parseInt(month) - 1);
                                const expenses = Object.values(data);

                                barChart.data.datasets[0].data = Array(12).fill(0);
                                months.forEach((monthIndex, index) => {
                                    barChart.data.datasets[0].data[monthIndex] = expenses[index];
                                });

                                barChart.update();
                            })
                            .catch(error => {
                                console.error('Error fetching expense data:', error);
                            });
                    }

                    const initialYear = document.getElementById('yearSelect').value;
                    fetchExpenseData(initialYear);

                </script>
</body>
</html>
