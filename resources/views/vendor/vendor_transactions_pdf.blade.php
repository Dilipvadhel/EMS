<!DOCTYPE html>
{{-- resources/views/vendor/vendor_transactions_pdf.blade.php --}}
<html>
<head>
    <title>Vendor Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2> VendorName: {{ $vendor->vendor_name }}  </h2>
    <table>
        <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->credit }}</td>
                    <td>{{ $transaction->debit }}</td>
                    <td>{{ $transaction->balance }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
