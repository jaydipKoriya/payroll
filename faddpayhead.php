<?php
// Include the database connection file
include 'connection.php';
// session_start();

// Query to fetch data from the "payhead" table

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payroll-Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .animate-fade-in {
            animation: fadeIn 1s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .action-icons a {
            color: #007bff;
            margin: 0 5px;
        }

        .container-fluid {
            padding: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: space-between;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        select.form-control {
            width: 100px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .earning-type {
            background-color: #4CAF50;
            color: white;
        }

        .deduction-type {
            background-color: #FF0000;
            color: white;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="payhead.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Payroll <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="fteam.php">
                    <i class="fas fa-users"></i>
                    <span>Employees Section</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fsalary.html">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Salary Slips</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fpayhead.php">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pay Head</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fmanage.php">
                    <i class="fas fa-hand-holding-usd"></i>

                    <span>Manage Salary</span></a>
            </li>
        </ul>

        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Page content goes here -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Pay Head</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">List of Pay Head
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addPayHeadModal">
                                    <i class="fas fa-plus"></i> Add Pay Head
                                </button>
                            </h6>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Show Entries</label>
                                <select class="form-control">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="payHeadTable" width="100%" cellspacing="0">

                            <tr>
                                <th>#</th>
                                <th>Head Name</th>
                                <th>Description</th>
                                <th>Head Type</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM payhead";
                            $result = $conn->query($sql);
                            // Fetch and display payhead data
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['payhead_id'] . "</td>";
                                echo "<td>" . $row['payhead_name'] . "</td>";
                                echo "<td>" . $row['payhead_desc'] . "</td>";
                                echo "<td>" . $row['payhead_type'] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>

                        </table>
                    </div>
                    <!-- <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>

                <!-- Add Pay Head Modal -->
                <div class="modal fade" id="addPayHeadModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <!-- Add modal content for adding a pay head here -->
                    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Pay Head</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <!-- <form method="post" action="addpayhead.php">
                        <div class="form-group">
                            <label for="payHeadName">Pay Head Name</label>
                            <input type="text" class="form-control" id="payHeadName" placeholder="Enter Pay Head Name">
                        </div>
                        <div class="form-group">
                            <label for="payHeadName">Pay Head Amount</label>
                            <input type="text" class="form-control" id="payHeadName" placeholder="Enter Pay Head Amount">
                        </div>
                        <div class="form-group">
                            <label for="payHeadDescription">Pay Head Description</label>
                            <textarea class="form-control" id="payHeadDescription" rows="4" placeholder="Enter Pay Head Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pay Head Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payHeadType" id="earningType" value="earning">
                                <label class="form-check-label" for="earningType">
                                    Earning
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payHeadType" id="deductionType" value="deduction">
                                <label class="form-check-label" for="deductionType">
                                    Deduction
                                </label>
                            </div>
                        </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Pay Head</button>
                        </div>
                    </div> -->

                    <form method="post" action="addpayhead.php">
    <div class="form-group">
        <label for="payHeadName">Pay Head Name</label>
        <input type="text" class="form-control" id="payHeadName" name="payhead_name" placeholder="Enter Pay Head Name">
    </div>
    <div class="form-group">
        <label for="payHeadAmount">Pay Head Amount</label>
        <input type="text" class="form-control" id="payHeadAmount" name="payhead_amount" placeholder="Enter Pay Head Amount">
    </div>
    <div class="form-group">
        <label for="payHeadDescription">Pay Head Description</label>
        <textarea class="form-control" id="payHeadDescription" name="payhead_desc" rows="4" placeholder="Enter Pay Head Description"></textarea>
    </div>
    <div class="form-group">
        <label>Pay Head Type</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payhead_type" id="earningType" value="earning">
            <label class="form-check-label" for="earningType">
                Earning
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payHeadType" id="deductionType" value="deduction">
            <label class="form-check-label" for="deductionType">
                Deduction
            </label>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Pay Head</button>
    </div>
</form>

           
                <script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize the Bootstrap modal
        $('#addPayHeadModal').modal({ show: false });

        // Show the modal when the button is clicked
        $('.btn-primary').on('click', function () {
            $('#addPayHeadModal').modal('show');
        });
    });
</script>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
               
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Payroll Management System</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>