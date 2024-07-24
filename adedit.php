<?php
include 'connection.php';
// session_start();
// if ($_SESSION['role'] == 'admin') {
//     // If the user is an admin, they will be redirected to the admin page
//     header("Location: admin.php");
//     exit;
// }

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

        .form-group {
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .form-group:hover {
            transform: scale(1.05);
        }

        .form-group label {
            transition: all 0.3s;
        }

        .form-group:hover label {
            transform: translateX(-10px);
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
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

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile Details</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Salary Slips</a> -->
                    </div>
                    <!-- Begin Page Content -->
<div class="container-fluid">

    

    <!-- Begin Page Content -->
<div class="container-fluid">

    
    <!-- Form to edit profile details -->
    <?php
   
   // Ensure user is authenticated
//    if (!isset($_GET['employee_id'])) {
//        // Redirect to a login page or display an error message
//        header("Location: login.php");
//        exit();
//    }

   $emp_id = $_GET['id'];
   $query = "SELECT * FROM employee WHERE employee_id ='$emp_id'";
   $result = mysqli_query($conn, $query);
  
   

   if ($result && mysqli_num_rows($result) > 0) {
       $employee = mysqli_fetch_assoc($result);
       ?>
       
       <!-- Form to edit profile details -->
       <form method="post" action="updateA.php">
       <div class="row">
           <!-- Column 1 - Personal Information -->
           <div class="col-md-3">
               <h2>Personal Information</h2>
               <div class="form-group">
                   <label for="firstName">First Name</label>
                   <input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name" value="<?= $employee['first_name']; ?>">
                   <input type="hidden" class="form-control"   name="emp_id" value="<?= $employee['employee_id']; ?>">
               </div>
               <div class="form-group">
                   <label for="lastName">Last Name</label>
                   <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="last_name" value="<?= $employee['last_name']; ?>">
               </div>
               <div class="form-group">
                   <label for="dob">Date of Birth </label>
                   <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="dob"  value="<?= $employee['dob']; ?>">
               </div>
               <div class="form-group">
                   <label>Gender</label>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($employee['gender'] === 'Male') echo 'checked'; ?>>
                       <label class="form-check-label" for="male">Male</label>
                   </div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($employee['gender'] === 'Female') echo 'checked'; ?>>
                       <label class="form-check-label" for="female">Female</label>
                   </div>
               </div>
           </div>

           <!-- Column 2 - Contact Information -->
           <div class="col-md-3">
               <h2>Contact Information</h2>
               
               <div class="form-group">
                   <label for="city">City</label>
                   <input type="text" class="form-control" id="city" placeholder="City" name="city"  value="<?= $employee['city']; ?>">
               </div>
               <div class="form-group">
                   <label for="state">State</label>
                   <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?= $employee['state']; ?>">
               </div>
               <div class="form-group">
                   <label for="country">Country</label>
                   <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?= $employee['country']; ?>">
               </div>
           </div>

           <!-- Column 3 - Additional Information -->
           <div class="col-md-3">
               <h2>Additional Information</h2>
               <div class="form-group">
                   <label for="maritalStatus">Marital Status</label>
                   <select class="form-control" id="maritalStatus" name="marital_status">
                   <option value="single" <?php if ($employee['marital_status'] === 'single') echo 'selected'; ?>>Single</option>
                           <option value="married" <?php if ($employee['marital_status'] === 'married') echo 'selected'; ?>>Married</option>
                           <option value="divorced" <?php if ($employee['marital_status'] === 'divorced') echo 'selected'; ?>>Divorced</option>
                   </select>
               </div>
               <div class="form-group">
                   <label for="nationality">Nationality</label>
                   <input type="text" class="form-control" id="nationality" placeholder="Nationality" name="nationality" value="<?= $employee['nationality']; ?>">
               </div>
           </div>

           <!-- Column 4 - Employment Information -->
           <div class="col-md-3">
               <h2>Employment Information</h2>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $employee['email']; ?>">
               </div>
               <div class="form-group">
                   <label for="mobile">Mobile (10 digits only)</label>
                   <input type="tel" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="<?= $employee['mobile']; ?>">
               </div>
               <div class="form-group">
                   <label for="identityDocument">Identity Document</label>
                   <select class="form-control" id="identityDocument" name="identity_document">
                   <option value="passport" <?php if ($employee['identity_document'] === 'passport') echo 'selected'; ?>>Passport</option>
           <option value="voterId" <?php if ($employee['identity_document'] === 'voterId') echo 'selected'; ?>>Voter ID</option>
           <option value="aadharCard" <?php if ($employee['identity_document'] === 'aadharCard') echo 'selected'; ?>>Aadhar Card</option>
           <option value="drivingLicense" <?php if ($employee['identity_document'] === 'drivingLicense') echo 'selected'; ?>>Driving License</option>
                   </select>
               </div>
               <div class="form-group">
                   <label for="identityNumber">Identity Number</label>
                   <input type="text" class="form-control" id="identityNumber" placeholder="Identity Number" name="identity_no" value="<?= $employee['identity_no']; ?>">
               </div>

               <div class="form-group">
                   <label for="joiningDate">Joining Date </label>
                   <input type="date" class="form-control" id="joiningDate" placeholder="Joining Date" name="joining_date"value="<?= $employee['joining_date']; ?>" >
               </div>

               <div class="form-group">
                   <label for="employeeType">Employee Type</label>
                   <select class="form-control" id="employeeType" name="employment_type">
                   <option value="partTime" <?php if ($employee['employment_type'] === 'partTime') echo 'selected'; ?>>Part-Time Employee</option>
                   <option value="intern" <?php if ($employee['employment_type'] === 'intern') echo 'selected'; ?>>Intern</option>
                   <option value="holidayWorker" <?php if ($employee['employment_type'] === 'holidayWorker') echo 'selected'; ?>>Holiday Worker</option>
                   <option value="permanentPosition" <?php if ($employee['employment_type'] === 'permanentPosition') echo 'selected'; ?>>Permanent Position</option>
                   </select>
               </div>

               <div class="form-group">
                   <label for="department">Department</label>
                   <input type="text" class="form-control" id="department" placeholder="Department" name="department" value="<?= $employee['department']; ?>">
               </div>
               
               <div class="form-group">
                   <label for="designation">Designation</label>
   
                   <div class="form-group">
                       <select class="form-control" id="designation" placeholder="Designation" name="designation">
                           <option value="IT Coordinator" <?php if ($employee['designation'] === 'IT Coordinator') echo 'selected'; ?>>IT Coordinator</option>
                           <option value="Computer Programmer" <?php if ($employee['designation'] === 'Computer Programmer') echo 'selected'; ?>>Computer Programmer</option>
                           <option value="Data Analyst" <?php if ($employee['designation'] === 'Data Analyst') echo 'selected'; ?>>Data Analyst</option>
                           <option value="Application Analyst" <?php if ($employee['designation'] === 'Application Analyst') echo 'selected'; ?>>Application Analyst</option>
                       </select>
                   </div>
                   
               </div>
             
               <div class="form-group">
                   <label for="panNo">PAN Number</label>
                   <input type="text" class="form-control" id="panNo" placeholder="PAN Number" name="pan" value="<?= $employee['pan']; ?>">
               </div>
               <div class="form-group">
                   <label for="bankName">Bank Name</label>
                   <input type="text" class="form-control" id="bankName" placeholder="Bank Name" name="bank_name"value="<?= $employee['bank_name']; ?>">
               </div>
               <div class="form-group">
                   <label for="bankAccountNo">Bank Account Number</label>
                   <input type="text" class="form-control" id="bankAccountNo" placeholder="Bank Account Number" name="bank_account_no"value="<?= $employee['bank_account_no']; ?>">
               </div>
               <div class="form-group">
                   <label for="ifscCode">IFSC Code</label>
                   <input type="text" class="form-control" id="ifscCode" placeholder="IFSC Code" name="ifsc_code"value="<?= $employee['ifsc_code']; ?>">
               </div>
               <div class="form-group">
            <label for="employeePhoto">Upload photo</label>
                <input type="file" class="form-control-file" id="employeePhoto" name="employeePhoto">
            </div>
           </div>
       </div>
       <div class="form-group text-center mt-4">
           <!-- <button type="submit" class="btn btn-primary btn-lg btn-center">Update</button> -->
           <button type="submit" class="btn btn-primary btn-lg btn-center" name="update_user">Update</button>
       </div>
       </form>
   <?php
   } else {
       ?>
       <h1>No record found</h1>
       <?php
   }
   ?>
</div>

</div>


                    
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
