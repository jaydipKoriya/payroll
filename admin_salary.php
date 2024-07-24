<?php
include 'connection.php';


if (!isset($_SESSION['employee_id']) || !isset($_SESSION['role']) || !strpos($_SESSION['employee_id'], 'admin_') === 0 || $_SESSION['role'] !== 'admin') {
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

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="salary.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Payroll <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

             <!-- Nav Item - Dashboard -->
             <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-users"></i>
                    <span>Employees Section</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_salary.php">
                    <i class="fas fa-file-invoice-dollar"></i>

                    <span>Salary Slips</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="payhead.php">
                    <i class="fas fa-money-bill-wave"></i>

                    <span>Pay Head</span></a>
            </li>

        </ul>

        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Topbar Navbar -->
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
        <!-- Salary Section -->
        <div class="container-fluid">
            <h1 class="h3 mb-0 text-gray-800">Salaries</h1>

            <!-- Filter and Display Options -->
            <!-- <div class="row mt-4">
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
            </div> -->
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
                <div class="col-md-3">
                    <label for="designation" style="margin-right: 10px;">Employee Designation:</label>
                    <select id="designation" class="form-control">
                        <option value="All">All</option>
                        <option value="IT coordinator">IT Coordinator</option>
                        <option value="Computer Programmer">Computer Programmer</option>
                        <option value="Data Analyst">Data Analyst</option>
                        <option value="Application analyst">Application analyst</option>

                    </select>
                </div>
            </div>

            <!-- Salary Slips Table -->
            <div class="table-responsive mt-4">
                <!-- <table class="table table-bordered" id="salarySlipsTable" width="100%" cellspacing="0"> -->
                <table class="table table-bordered" id="salarySlipTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Salary Month</th>
                            <th>Salary Year</th>
                            <th>Earnings</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add more rows for additional employees -->
                        <?php
                        //    $result = mysqli_query($conn, "SELECT * FROM `salary_info` WHERE employee_id='22';");
                        $result = mysqli_query($conn, "SELECT e.employee_id, e.first_name, e.designation, si.salary_month, si.salary_year, si.total_salary, si.total_deduction, si.net_salary,si.salary_id FROM employee e JOIN salary_info si ON e.employee_id = si.employee_id");
                        while ($row = mysqli_fetch_array($result)) {


                            echo "<tr>";
                            echo "<td>" . $row['employee_id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['designation'] . "</td>";

                            echo "<td>" . $row['salary_month'] . "</td>";
                            echo "<td>" . $row['salary_year'] . "</td>";
                            echo "<td>" . $row['total_salary'] . "</td>";
                            echo "<td>" . $row['total_deduction'] . "</td>";
                            echo "<td>" . $row['net_salary'] . "</td>";
                            echo '<td>

                            <form action="sal_slip.php" method="POST">
                            <input name="input_view_sal" type="hidden" value="' . $row['salary_id'] . '">
                        <button type="submit" name="view_sal" class="btn btn-primary view-salary-slip" data-salaryid="' . $row['salary_id'] . '" onclick="sal_view()">View</button>
                        </form>
                      </td>';
                            echo "</tr>";

                        }

                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            if (isset($_POST['view_sal'])) {

                $a = $_POST['input_view_sal'];
                $salaryId = $_POST['input_view_sal'];
                echo "<script>alert($a)</script>";


                $query = "SELECT * FROM salary_info WHERE salary_id = ?";

                if ($stmt = $conn->prepare($query)) {
                    echo "<script>alert('1')</script>";
                    $stmt->bind_param('i', $salaryId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<script>alert('2')</script>";
                        // Split allowances and deductions using explode
                        $allowances = explode(',', $row['pay_ear']);
                        $deductions = explode(',', $row['pay_ded']);


                        ?>

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
                                                    <?= $row['joining_date'] . "kjhjgh" ?>
                                                </p>
                                            </div>

                                            <table class="salary-details-table">
                                                <tr>
                                                    <th>Earnings</th>
                                                    <th>Amount</th>

                                                </tr>
                                                <?php

                                                // Loop through and display allowances
                                                foreach ($allowances as $allowance) {
                                                    $allowanceParts = explode('-', $allowance);
                                                    $allowanceName = $allowanceParts[0];
                                                    $allowanceAmount = $allowanceParts[1];
                                                    echo "<tr><td>$allowanceName</td><td>$allowanceAmount</td></tr>";
                                                }

                                                ?>
                                                <tr class="total-row">
                                                    <td>Total Earnings</td>
                                                    <td>
                                                        <?= $row['total_salary'] ?>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="salary-details-table">
                                                <tr>

                                                    <th>Deductions</th>
                                                    <th>Amount</th>
                                                </tr>
                                                <?php

                                                // Loop through and display allowances
                                    

                                                // Loop through and display deductions
                                                foreach ($deductions as $deduction) {
                                                    $deductionParts = explode('-', $deduction);
                                                    $deductionName = $deductionParts[0];
                                                    $deductionAmount = $deductionParts[1];
                                                    echo "<tr><td>$deductionName</td><td>$deductionAmount</td></tr>";
                                                }

                                                ?>
                                                <tr class="total-row">

                                                    <td>Total Deductions</td>
                                                    <td>
                                                        <?= $row['total_deduction'] ?>
                                                    </td>
                                                </tr>
                                            </table>

                                            <p class="center-text net-salary">Net Salary:
                                                <?= $row['net_salary'] ?>
                                            </p>
                                            <p class="center-text">Amount in Words:
                                                <?= convertToWords($row['net_salary']) ?>
                                            </p>

                                            <p>Cheque No: 12345</p>
                                            <p>Bank Name: ABC Bank</p>
                                            <p>Dated As: 2023-01-31</p>
                                            <div style="display: flex; justify-content: space-between;">
                                                <p>Employee's Signature</p>
                                                <p>Director's Signature</p>
                                            </div>
                                            <form>
                                                <center>
                                                    <input type="button" value="Print" onclick="window.print()" />
                                                    <!-- <input type="button" value="Print" onclick="printDiv('divToPrint')" /> -->

                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
                                </div>
                            </div>
                        </div>


                        <?php
                    }
                }
            }
            ?>
            <!-- Previous and Next Entries -->
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
            <a class="btn btn-primary" href="login.html">Logout</a>
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

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> Include jQuery -->
<script>
// Function to open the salary slip modal
$(document).ready(function () {
$('.view-salary-slip').on('click', function () {
    const modal = $('#salarySlipModal');
    modal.modal('show');
});
});

function sal_view() {

var model = document.getElementById('view-salary-slip');
model.style.display = 'block';
}
// function filterTable() {
//             const month = document.getElementById("monthFilter").value;
//             const year = document.getElementById("yearFilter").value;
//             const table = document.getElementById("salarySlipTable");
//             const rows = table.getElementsByTagName("tr");
//             for (let row of rows) {
//                 const cells = row.getElementsByTagName("td");
//                 if (cells.length >= 2) {
//                     const rowMonth = cells[0].textContent;
//                     const rowYear = cells[1].textContent;
//                     if (month === "All" || (rowMonth === month && rowYear === year)) {
//                         row.style.display = "block";
//                     } else {
//                         row.style.display = "none";
//                     }
//                 }
//             }

//         }
//         // Attach the filter function to the filter elements
//         document.getElementById("monthFilter").addEventListener("change", filterTable);
//         document.getElementById("yearFilter").addEventListener("change", filterTable);
//         // Initial table filter
//         filterTable();
function filterTable() {
const month = document.getElementById("monthFilter").value;
const year = document.getElementById("yearFilter").value;
const designation = document.getElementById("designation").value;
const table = document.getElementById("salarySlipTable");
const rows = table.getElementsByTagName("tr");
for (let row of rows) {
    const cells = row.getElementsByTagName("td");
    if (cells.length >= 7) { // Ensure it's a valid row with data
        const rowMonth = cells[3].textContent;
        const rowYear = cells[4].textContent;
        const rowDesignation = cells[2].textContent;
        if ((month === "All" || rowMonth === month) && (year === "All" || rowYear === year) && (designation === "All" || rowDesignation === designation)) {
            row.style.display = "table-row";
        } else {
            row.style.display = "none";
        }
    }
}
}
document.getElementById("monthFilter").addEventListener("change", filterTable);
document.getElementById("yearFilter").addEventListener("change", filterTable);
document.getElementById("designation").addEventListener("change", filterTable);

// Initial table filter
filterTable();
</script>

<!-- <script>
const employeeTypeSelect = document.getElementById("designation");
const tableRows = document.querySelectorAll("tbody tr");

employeeTypeSelect.addEventListener("change", () => {
const selectedType = employeeTypeSelect.value;
tableRows.forEach((row) => {
    const employeeTypeCell = row.querySelector("td:nth-child(2)").textContent.trim();
    if (selectedType === "All" || employeeTypeCell === selectedType) {
        row.style.display = "table-row";
    } else {
        row.style.display = "none";
    }
});
});


</script> -->
</body>

</html>