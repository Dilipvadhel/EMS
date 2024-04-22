<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
@include('welcome')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <select class="form-select" id="year">
            </select>
        </div>

        <div class="col-md-4">
            <select class="form-select" id="month">
            </select>
        </div>

        <div class="col-md-4">
            <button type="button" class="btn btn-primary" onclick="getData()">Get Data</button>
        </div>
    </div>
</div>

<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel">Expense Data Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss ="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="expenseData"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var currentYear = new Date().getFullYear();
    for (var i = currentYear - 10; i <= currentYear; i++) {
        $('#year').append($('<option>', {
            value: i,
            text: i
        }));
    }
    for (var i = 1; i <= 12; i++) {
        $('#month').append($('<option>', {
            value: i,
            text: new Date(2000, i - 1, 1).toLocaleString('default', { month: 'long' })
        }));
    }

    function getData() {
        var year = document.getElementById('year').value;
        var month = document.getElementById('month').value;

        fetch(`/expense-amount/${year}/${month}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.totalExpense === undefined) { 
                    document.getElementById('expenseData').innerHTML = '<p>No data available for selected month and year.</p>';
                } else {
                    var expenseDataHtml = '<table class="table table-bordered"><thead><tr><th>Month</th><th>Total Amount</th></tr></thead><tbody>';
                    expenseDataHtml += `<tr><td>${getMonthName(month)}</td><td>${data.totalExpense}</td></tr>`; // Access totalExpense property
                    expenseDataHtml += '</tbody></table>';
                    document.getElementById('expenseData').innerHTML = expenseDataHtml;
                }
                $('#expenseModal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function getMonthName(month) {
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        return monthNames[parseInt(month) - 1];
    }
</script>

</body>
</html>



