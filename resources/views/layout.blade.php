<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /*!
 * Start Bootstrap - Simple Sidebar (https://startbootstrap.com/)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */

        body {
            overflow-x: hidden;
        }

        /* Toggle Styles */

        #wrapper {
            padding-left: 0;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .bg-dark {
            background-color: #000 !important;
            width: 40cm;
            margin-left: -1cm;
            margin-top: -20px;
        }

        #wrapper.toggled {
            padding-left: 250px;
        }

        #sidebar-wrapper {
            z-index: 1000;
            position: fixed;
            left: 250px;
            width: 0;
            height: 100%;
            margin-left: -250px;
            overflow-y: auto;
            background: #000;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .btn {
            padding: .55rem 1.5rem .45rem;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        #page-content-wrapper {
            width: 100%;
            position: absolute;
            padding: 15px;
        }

        #wrapper.toggled #page-content-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        /* Sidebar Styles */

        .sidebar-nav {
            position: absolute;
            top: 0;
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav li {
            text-indent: 20px;
            line-height: 40px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #999999;
        }

        .sidebar-nav li a:hover {
            text-decoration: none;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
            text-decoration: none;
        }

        .sidebar-nav>.sidebar-brand {
            height: 65px;
            font-size: 18px;
            line-height: 60px;
        }

        .sidebar-nav>.sidebar-brand a {
            color: #999999;
        }

        .sidebar-nav>.sidebar-brand a:hover {
            color: #fff;
            background: none;
        }

        @media(min-width:768px) {
            #wrapper {
                padding-left: 250px;
            }

            #wrapper.toggled {
                padding-left: 0;
            }

            #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 0;
            }

            #page-content-wrapper {
                padding: 20px;
                position: relative;
            }

            #wrapper.toggled #page-content-wrapper {
                position: relative;
                margin-right: 0;
            }
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            height: 25cm;
            max-width: 8cm;

        }

        .header {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            width: 125%;
            margin-left: -2%;

        }

        .header .title {
            text-align: center;
        }

        .footer {
            background-color: #000 !important;
            ;
            margin-left: -20px;
            margin-right: -10px;
            color: white;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        @include('includes.sidebar')

        <div id="page-content-wrapper">
            <!-- Header -->
            @include('includes.header')

            <!-- Main Content -->
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Hello Prakash</h1>
                        <!-- Your main content goes here -->
                        <p>This is your main content.</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('includes.footer')
        </div>
    </div>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    </script>

</body>

</html>
