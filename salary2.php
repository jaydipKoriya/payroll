<?php
include 'connection.php';

if (!isset($_SESSION['employee_id']) || !isset($_SESSION['role']) || !strpos($_SESSION['employee_id'], 'user_') === 0 || $_SESSION['role'] !== 'employee') {
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
    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->

    <!-- Bootstrap CSS (add this line) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
        .salary-slip-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }

        .salary-slip-header {
            text-align: center;
        }

        .salary-slip-title {
            font-size: 24px;
        }

        .salary-slip-subtitle {
            font-size: 20px;
        }

        .salary-slip-details {
            margin-top: 20px;
        }

        .salary-details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .salary-details-table,
        .salary-details-table th,
        .salary-details-table td {
            border: 1px solid #000;
        }

        .salary-details-table th,
        .salary-details-table td {
            padding: 10px;
            text-align: left;
        }

        .center-text {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
        }

        .net-salary {
            font-size: 20px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Payroll <sup></sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-user"></i>
                    <span> Profile Details</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="editProfile.php">
                    <i class="fas fa-edit"></i>
                    <span>Edit Profile</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="salary2.php">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Salary Slips</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php
                        $emp_id = $_SESSION['employee_id'];
                        $query = "SELECT * FROM employee WHERE employee_id ='$emp_id'";
                        $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
       $employee = mysqli_fetch_assoc($result);
       ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Employee</span>
                                <img class="img-profile rounded-circle" src="<?= $employee['photo_path'] ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <?php
    } else {
        ?>
        <h1>No record found</h1>
        <?php
    }
    ?>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Salary Slip</h1>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="monthFilter">Select Month:</label>
                            <select class="form-control" id="monthFilter">
                                <option value="All">All</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="yearFilter">Select Year:</label>
                            <select class="form-control" id="yearFilter">
                                <!-- <option value="2023">2023</option>
                                <option value="2022">2022</option> -->
                                <?php
                                // Get the current year and a few years in the past and future
                                $currentYear = date("Y");
                                $yearsInPast = $currentYear - 5;
                                $yearsInFuture = $currentYear + 5;
                                echo "<option value='All'>All</option>";
                                // Generate options for a range of years
                                for ($year = $yearsInPast; $year <= $yearsInFuture; $year++) {
                                    echo "<option value='$year'>$year</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="salarySlipTable">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>January</td>
                                    <td>2023</td>
                                    <td>1000.00</td>
                                    <td>
                                        <button type="button" class="btn btn-primary view-salary-slip">View</button>
                                        <a href="#" class="btn btn-secondary">Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>February</td>
                                    <td>2022</td>
                                    <td>1000.00</td>
                                    <td>
                                        <button type="button" class="btn btn-primary view-salary-slip">View</button>
                                        <a href="#" class="btn btn-secondary">Download</a>
                                    </td>
                                </tr> -->
                                <?php
                                // $sql = "SELECT * FROM your_table_name"; // Replace 'your_table_name' with the actual table name
                                $employee_id = $_SESSION['employee_id']; // Replace this with the actual employee_id value
                                // echo $employee_id;
                                // Perform a SQL query to fetch data from your database table based on the employee_id
// $sql = "SELECT * FROM `salary_info` WHERE employee_id='22'";
// $result = $conn->query($sql);
                                
                                $result = mysqli_query($conn, "SELECT * FROM `salary_info` WHERE employee_id='$employee_id';");
                                while ($row = mysqli_fetch_array($result)) {


                                    echo "<tr>";
                                    echo "<td>" . $row['salary_month'] . "</td>";
                                    echo "<td>" . $row['salary_year'] . "</td>";
                                    echo "<td>" . $row['net_salary'] . "</td>";
                                    echo '<td>
                                    
                                    <form action="sal_slip.php" method="POST">
                                    <input name="input_view_sal" type="hidden" value="' . $row['salary_id'] . '">
                                <button type="submit" name="view_sal" class="btn btn-primary view-salary-slip" data-salaryid="' . $row['salary_id'] . '" onclick="sal_view()">View</button>
                                </form>
                                  </td>';
                                    echo "</tr>";

                                }
                                //  else {
                                //     echo "No data found in the database.";
                                // }
                                
                                // if ($result->num_rows > 0) {
//     // Output data of each row
//     while ($row = $result->fetch_assoc()) {
                                
                                //     }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Salary Slip Modal -->
                <div class="modal" id="salarySlipModal" tabindex="-1" role="dialog">
                         <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Salary Slip</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="salary-slip-container">
                                                <div class="salary-slip-header">
                                                    <h1 class="salary-slip-title">Company Name</h1>
                                                    <p>Company Address</p>
                                                    <h2 class="salary-slip-subtitle">Salary Slip</h2>
                                                </div>
                                                <div class="salary-slip-details">
                                                    <p>Employee ID:
                                                        <?= $row['employee_id'] ?>
                                                    </p>
                                                    <p>Employee Name:
                                                        <?= $row['first_name'] ?>
                                                    </p>
                                                    <p>Designation:
                                                        <?= $row['designation'] ?>
                                                    </p>
                                                    <p>Month:
                                                        <?= $row['joining_date'] ?>
                                                    </p>
                                                </div>
                                                <table class="salary-details-table">
                                                    <tr>
                                                        <th>Earnings</th>
                                                        <th>Amount</th>
                                                        <th>Deductions</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Basic</td>
                                                        <td>$1000</td>
                                                        <td>Provident Fund</td>
                                                        <td>$50</td>
                                                    </tr>
                                                    <tr>
                                                        <td>HRA</td>
                                                        <td>$300</td>
                                                        <td>Loan</td>
                                                        <td>$20</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Conveyance</td>
                                                        <td>$50</td>
                                                        <td>Professional Tax</td>
                                                        <td>$10</td>
                                                    </tr>
                                                    <tr class="total-row">
                                                        <td>Total Earnings</td>
                                                        <td>$1350</td>
                                                        <td>Total Deductions</td>
                                                        <td>$80</td>
                                                    </tr>
                                                </table>
                                                <p class="center-text net-salary">Net Salary: $1270</p>
                                                <p class="center-text">Amount in Words: One Thousand Two Hundred Seventy</p>
                                                <p>Cheque No: 12345</p>
                                                <p>Bank Name: ABC Bank</p>
                                                <p>Dated As: 2023-01-31</p>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p>Employee's Signature</p>
                                                    <p>Director's Signature</p>
                                                </div>
                                     </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Payroll Management System</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <!-- <script>
        // Function to open the salary slip modal
        $(document).ready(function () {
            $('.view-salary-slip').on('click', function () {
                const modal = $('#salarySlipModal');
                modal.modal('show');
            });
        });
    </script> -->
    <script>
        // Function to open the salary slip modal
        $(document).ready(function () {
            $('.view-salary-slip').on('click', function () {
                const modal = $('#salarySlipModal');
                const salaryId = $(this).data('salaryid');
                // Update the modal content with the selected salary details
                $.ajax({
                    url: 'get_salary_details.php',
                    method: 'POST',
                    data: { salary_id: salaryId },
                    success: function (data) {
                        modal.find('.modal-body').html(data);
                    }
                });
                modal.modal('show');
            });
        });
    </script>
    <!-- <script>
        // Function to open the salary slip modal
        $('.view-salary-slip').on('click', function () {
            const modal = $('#salarySlipModal');
            modal.modal('show');
        });
    </script> -->
    <script>
        // Function to filter the table based on the selected month and year
        function filterTable() {
            // const month = document.getElementById("monthFilter").value;
            // const year = document.getElementById("yearFilter").value;
            // const table = document.getElementById("salarySlipTable");
            // const rows = table.getElementsByTagName("tr");
            // for (let row of rows) {
            //     const cells = row.getElementsByTagName("td");
            //     if (cells.length >= 2) {
            //         const rowMonth = cells[0].textContent;
            //         const rowYear = cells[1].textContent;
            //         if (month === "All" || (rowMonth === month && rowYear === year)) {
            //             row.style.display = "block";
            //         } else {
            //             row.style.display = "none";
            //         }
            //     }
            // }
            const month = document.getElementById("monthFilter").value;
            const year = document.getElementById("yearFilter").value;
            const table = document.getElementById("salarySlipTable");
            const rows = table.getElementsByTagName("tr");
            for (let row of rows) {
                const cells = row.getElementsByTagName("td");
                if (cells.length >= 2) {
                    const rowMonth = cells[0].textContent;
                    const rowYear = cells[1].textContent;
                    if (
                        (month === "All" || rowMonth === month) &&
                        (year === "All" || rowYear === year)
                    ) {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        }
        // Attach the filter function to the filter elements
        document.getElementById("monthFilter").addEventListener("change", filterTable);
        document.getElementById("yearFilter").addEventListener("change", filterTable);
        // Initial table filter
        filterTable();
    </script>
</body>

</html>