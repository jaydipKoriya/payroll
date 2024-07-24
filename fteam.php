<?php
include 'connection.php';

if (!isset($_SESSION['employee_id']) || !isset($_SESSION['role']) || !strpos($_SESSION['employee_id'], 'finance_') === 0 || $_SESSION['role'] !== 'finance') {
    header("Location: login.html"); // Redirect to a restricted access page
    exit();
}
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
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.html">
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
                    <span>Employees Section</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fsalary.php">
                    <i class="fas fa-file-invoice-dollar"></i>

                    <span>Salary Slips</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fpayhead.php">
                    <i class="fas fa-money-bill-wave"></i>

                    <span>Pay Head</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fmanage.php">
                    <i class="fas fa-hand-holding-usd"></i>

                    <span>Manage Salary</span></a>
            </li>
            <li class="nav-item active">
                  <a class="nav-link" href="empProfile.php"> 
                     <i class="fas fa-user-plus"></i> 
                    <span>Add Employee</span>
        </a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Finance Team</span>
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
                    <h1 class="h3 mb-2 text-gray-800">Employees Section</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                        </div>
                        <div class="card-body">
                        <!-- <label for="designation" style="margin-right: 10px;">Filter by Employee Designation:</label>
                                <select id="designation" class="form-control" style="width: 200px; border-radius: 5px; background-color: #f2f2f2;">
                                    <option value="All">All</option>
                                    <option value="IT_coordinator">IT Coordinator</option>
                                    <option value="computer_programmer">Computer Programmer</option>
                                    <option value="data_analyst">Data Analyst</option>
                                    <option value="Application_analyst">Application Analyst</option>
                                 
                                </select>
                                <br> -->
                                <label for="designation" style="margin-right: 10px;">Filter by Employee Designation:</label>
                                <select id="designation" class="form-control" style="width: 200px; border-radius: 5px; background-color: #f2f2f2;">
                                   <option value="All">All</option>
                                  <option value="IT coordinator">IT Coordinator</option>
                                  <option value="Computer programmer">Computer programmer</option>
                                 <option value="Data Analyst">Data analyst</option>
                                 <option value="Application analyst">Application analyst</option>

                                </select>
                                <br>

                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>CONTACT</th>
                                        <th>IDENTITY</th>
                                        <th>DOB</th>
                                        <th>JOINING</th>
                                        <th>DESIGNATION</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    // Your existing PHP code for fetching and displaying employee data
                                    $sql = "SELECT * FROM employee";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        
                                        <tr>
                                        <td><?= $row['employee_id']?> </td>
                                        <td><img src="<?= $row['photo_path'] ?>" alt="Employee Photo" ></td>
                                        <td><?= $row['first_name'] ?> </td>
                                        <td><?= $row['email'] ?> </td>
                                        <td><?= $row['mobile'] ?> </td>
                                        <td><?= $row['identity_no'] ?> </td>
                                        <td><?= $row['dob'] ?> </td>
                                        <td><?= $row['joining_date'] ?> </td>
                                        <td><?= $row['designation'] ?></td>
                                        <td><a href='editT.php?id=<?=$row['employee_id']?>'>Edit</a> | <a href='manageE.php?id=<?=$row['employee_id']?>'>Salary</a></td>
                                        <!-- | <a href='deletePro.php?id='>Delete</a> -->
                                        
                                        </tr>
                                        
                                        <?php 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script>
        const employeeTypeSelect = document.getElementById("designation");
        const tableRows = document.querySelectorAll("tbody tr");

        employeeTypeSelect.addEventListener("change", () => {
            const selectedType = employeeTypeSelect.value;
            tableRows.forEach((row) => {
                const employeeTypeCell = row.querySelector("td:nth-child(9)").textContent.trim();
                if (selectedType === "All" || employeeTypeCell === selectedType) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        });
   

    </script>


</body>

</html>