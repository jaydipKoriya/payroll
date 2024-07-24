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

    <title>Payroll-Dashbord</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
       
       .profile-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .profile-details {
            flex: 1;
        }

        .info-heading {
            font-weight: bold;
            color: #007bff; /* Blue color for headings */
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            margin: 10px 0;
            font-size: 16px;
            color: #333; /* Dark gray text color */
        }

        .card-section {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 20px;
        }

        .card {
            background-color: #ffffff; /* White cards */
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
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

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-user"></i>

                    <span> Profile Details</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="editProfile.php">
                    <i class="fas fa-edit"></i> 
                    <span>Edit Profile</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="salary2.php">
                <i class="fas fa-file-invoice-dollar"></i>
                    <span>Salary Slips</span></a>
            </li>

            </ul>
                   
            
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
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
                                <img class="img-profile rounded-circle"
                                    src="<?= $employee['photo_path'] ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
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
                <!-- End of Topbar -->
                <?php
   
   // Ensure user is authenticated
//    if (!isset($_SESSION['employee_id'])) {
//        // Redirect to a login page or display an error message
//        header("Location: login.php");
//        exit();
//    }

   $emp_id = $_SESSION['employee_id'];
   $query = "SELECT * FROM employee WHERE employee_id ='$emp_id'";
   $result = mysqli_query($conn, $query);
  
   

   if ($result && mysqli_num_rows($result) > 0) {
       $employee = mysqli_fetch_assoc($result);
       ?>
 <!-- Begin Page Content --> <div class="container-fluid">
                    
    <!-- Profile Details Section -->
    <div class="profile-section animate-fade-in">
        <!-- <img src="img/undraw_profile.svg" alt="Profile Photo" class="profile-photo"> -->
        <img src="<?= $employee['photo_path'] ?>" alt="Profile Photo" class="profile-photo">
        <div class="profile-details">
            <!-- Personal Details -->
            <div class="personal-details">
                <h2 class="info-heading">Personal Details</h2>
                <ul class="info-list">
                    <li>First Name: <?= $employee['first_name']; ?></li>
                    <li>Last Name: <?= $employee['last_name']; ?></li>
                    <li>Date of Birth: <?= $employee['dob']; ?></li>
                    <li>Gender: <?= $employee['gender']; ?></li>
                </ul>
            </div>
        </div>
    </div>
                            <!-- Three Cards for Contact Info, Additional Info, and Employment Info -->
    <div class="card-section">
        <div class="card">
            <h2 class="info-heading">Contact Info</h2>
            <ul class="info-list">
                <!-- <li>Address: 123 Main St</li> -->
                <li>City: <?= $employee['city']; ?></li>
                <li>State: <?= $employee['state']; ?></li>
                <li>Country: <?= $employee['country']; ?></li>
            </ul>
        </div>
        <div class="card">
            <h2 class="info-heading">Additional Info</h2>
            <ul class="info-list">
                <li>Marital Status: <?= $employee['marital_status']; ?></li>
                <li>Nationality: <?= $employee['nationality']; ?> </li>
            </ul>
        </div>
        <div class="card">
            <h2 class="info-heading">Employment Info</h2>
            <ul class="info-list">
                <li>Email: <?= $employee['email']; ?></li>
                <li>Mobile: <?= $employee['mobile']; ?></li>
                <li>Identity Number: <?= $employee['identity_no']; ?></li>
                <li>Employee Type: <?= $employee['employment_type']; ?> </li>
                <li>Joining Date: <?= $employee['joining_date']; ?></li>
                <!-- <li>Blood Group: A+</li> -->
                <li>Designation: <?= $employee['designation']; ?></li>
                <li>Department: <?= $employee['department']; ?></li>
            </ul>
        </div>
    </div>
                    </div>
                </div>
                <?php
    } else {
        ?>
        <h1>No record found</h1>
        <?php
    }
    ?>
                <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Payroll Management System </span>
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
