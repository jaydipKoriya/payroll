<?php
include 'connection.php';
// session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $conn->real_escape_string($_POST['employeeId']);
    $employeeName = $conn->real_escape_string($_POST['employeeName']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $salary = (float)$conn->real_escape_string($_POST['salary']);
    $overtime = (float)$conn->real_escape_string($_POST['overtime']);
    $salaryMonth = $conn->real_escape_string($_POST['salaryMonth']);
    $salaryYear = $conn->real_escape_string($_POST['salaryYear']);

    // Calculate overtime amount based on $500 per hour
    $overtimeAmount = $overtime * 500;

    // Initialize total salary and total deduction
    $totalSalary = $salary + $overtimeAmount;
    $totalDeduction =0;

    // Check if pay heads are provided and calculate totals
    if (isset($_POST['payhead']) && is_array($_POST['payhead']) && is_array($_POST['master'])) {
        $ae = $_POST['payhead'];
        $as = $_POST['master'];

        // for($i=0;$i<2;$i++){
        // echo '<script>alert('.$ae[$i].')</script>';
        // echo '<script>alert('.$as[$i].')</script>';
        // }

        $i = 0;
        $allow_e = "";
         $allow_d="";
         $allow_de="";
        foreach ($_POST['master'] as $payheadId) {
            // Determine the type of pay head (earning or deduction) based on your database
            $sql = "SELECT * FROM payhead WHERE payhead_id = '$payheadId'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $payheadType = $row['payhead_type'];
                $payname = $row['payhead_name'];
                $payheadAmount = $ae[$i];
                $i++;
                  
                // Assuming you have an input for this
                
                if ($payheadType === 'earning') {
                  
                    $allow_e = $allow_e.$payname."-".$payheadAmount.",";
                    $allow_de = $allow_de.$payname."-".$payheadAmount.",";


                    $totalSalary += (double)$payheadAmount;
                        
                } elseif ($payheadType === 'deduction') {

                    // $allow_d = $allow_d.$payname."-".$payheadAmount.",";
                    // $allow_d = $allow_d.$payname."-".$payheadAmount.",";
                    $allow_d = $allow_d.$payname."-".$payheadAmount.",";
                    $allow_de = $allow_de.$payname."-".$payheadAmount.",";
                    $totalDeduction += (double)$payheadAmount;

                }

            }
        }
    }
    // if (isset($_POST['payhead']) && is_array($_POST['payhead'])) {
    //     foreach ($_POST['payhead'] as $payheadId) {
    //         // Assuming you have a table named "payhead_amounts" with columns "payhead_id" and "amount"
    //         $sql = "SELECT payhead_amount FROM payhead WHERE payhead_id = " . (int)$payheadId;
    //         $result = $conn->query($sql);
    
    //         if ($result->num_rows > 0) {
    //             $row = $result->fetch_assoc();
    //             $payheadAmount = (float)$row['payhead_amount'];
    //             $payheadType = $conn->real_escape_string($_POST['payheadType']);
    
    //             if ($payheadType === 'earning') {
    //                 $totalSalary += $payheadAmount;
    //             } elseif ($payheadType === 'deduction') {
    //                 $totalDeduction += $payheadAmount;
    //             }
    //         }
    //     }
    // }


    // if (isset($_POST['payhead']) && is_array($_POST['payhead'])) {
    //     foreach ($_POST['payhead'] as $payheadId) {
    //         // Fetch payheadType from the payhead table
    //         function getPayheadType($conn, $payheadId) {
    //             $payheadType = '';
            
    //             $sql = "SELECT payheadType FROM payhead WHERE payhead_id = " . (int)$payheadId;
    //             $result = $conn->query($sql);
            
    //             if ($result->num_rows > 0) {
    //                 $row = $result->fetch_assoc();
    //                 $payheadType = $row['payheadType'];
    //             }
            
    //             return $payheadType;
    //         }
    //         $payheadType = getPayheadType($conn, $payheadId);
            
    //         // Assuming you have a table named "payhead_amounts" with columns "payhead_id" and "amount"
    //         $sql = "SELECT payhead_amount FROM payhead WHERE payhead_id = " . (int)$payheadId;
    //         $result = $conn->query($sql);
    
    //         if ($result->num_rows > 0) {
    //             $row = $result->fetch_assoc();
    //             $payheadAmount = (float)$row['payhead_amount'];
    
    //             if ($payheadType === 'earning') {
    //                 $totalSalary += $payheadAmount;
    //             } elseif ($payheadType === 'deduction') {
    //                 $totalDeduction += $payheadAmount;
    //             }
    //         }
            
    //     }
    // }
    
    
    // Calculate the net salary
    $netSalary = $totalSalary - $totalDeduction;

    // Insert the data into the salary_info table
    $sql = "INSERT INTO salary_info (employee_id, employee_name, designation, salary, overtime, salary_month, salary_year, total_salary, total_deduction, net_salary,allow_details,pay_ear,pay_ded)
            VALUES ('$employeeId', '$employeeName', '$designation', '$salary', '$overtimeAmount', '$salaryMonth', '$salaryYear', '$totalSalary', '$totalDeduction', '$netSalary','$allow_de','$allow_e','$$allow_d')";

    if ($conn->query($sql) === TRUE) {
        // echo '<script type="text/javascript">alert("Data added successfully!");</script>';
        echo '<script type="text/javascript">
        alert("Data added successfully!");
        window.location.href = "fmanage.php"; // Redirect to employe.php
      </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
