{{-- SIDEBAR FILE --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div id="sidebar-wrapper">
    <h4 class="text-info mt-5 ml-4">Expense Manage</h4>
    <ul class="sidebar">
        <a class="sidebar-link text-light mt-5 mb-3 {{ Request::is('dashboard') ? 'active' : '' }}" href="dashboard"><i class="fas fa-tachometer-alt text-lights mb-2 mr-1"></i> Dashboard</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('role','role/create') ? 'active' : '' }}" href="{{ route('role.index') }}"><i class="fas fa-user-tag text-lights mb-2 mr-1"></i> Roles</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('user','user/create') ? 'active' : '' }}" href="{{ route('user.index') }}"><i class="fas fa-users text-lights mb-2 mr-1"></i> Users</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('vendor','vendor/create') ? 'active' : '' }}" href="{{ route('vendor.index') }}"><i class="fas fa-store text-lights mb-2 mr-1"></i> Vendors</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('category','category/create') ? 'active' : '' }}" href="{{ route('category.index') }}"><i class="fas fa-th-list text-lights mb-2 mr-1"></i> Categories</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('subcategory') ? 'active' : '' }}" href="{{ route('subcategory.index') }}"><i class="fas fa-list-alt text-lights mb-2 mr-1"></i> SubCategories</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('expense','expense/create') ? 'active' : '' }}" href="{{ route('expense.index') }}"><i class="fas fa-money-bill text-lights mb-2 mr-1"></i> Expenses</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('payment','payment/create') ? 'active' : '' }}" href="{{ route('payment.index') }}"><i class="fas fa-money-check text-lights mb-2 mr-1"></i> Payments</a>

        <a class="sidebar-link text-light mt-4 {{ Request::is('transaction') ? 'active' : '' }}" href="{{ route('transaction.index') }}"><i class="fas fa-exchange-alt text-lights mb-2 mr-1"></i> Transactions</a>


        {{-- <a class="sidebar-link text-light mt-4 {{ Request::is('expense-report-by-category') ? 'active' : '' }}" href="{{ route('reports.report') }}"><i class="fas fa-chart-bar text-lights mb-2 mr-1"></i>Report</a> --}}



    </ul>
</div>
<script>
</script>
