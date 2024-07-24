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
            font-size: 26px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            width: 50%;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr td:nth-child(2) {
            text-align: right;
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
            width: 60%;
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
            font-size: 40px;
        }

        .salary-slip-subtitle {
            font-size: 36px;
        }

        .salary-slip-details {
            margin-top: 20px;
            font-size: 26px;
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
            padding: 5px 10px;
            text-align: left;
        }

        .center-text {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
        }

        .net-salary {
            font-size: 26px;
        }

        .sal_table {

            margin: 50px 0px;
            /* display: flex;
            flex-wrap: nowrap; */
        }
    </style>

</head>

<body>

    <?php

    include 'connection.php';
    if (isset($_POST['view_sal'])) {

        $a = $_POST['input_view_sal'];
        $salaryId = $_POST['input_view_sal'];
        // echo "<script>alert($a)</script>";
    

        $query = "SELECT * FROM salary_info WHERE salary_id = ?";

        if ($stmt = $conn->prepare($query)) {
            // echo "<script>alert('1')</script>";
            $stmt->bind_param('i', $salaryId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // echo "<script>alert('2')</script>";
                // Split allowances and deductions using explode
                $allowances = explode(',', $row['pay_ear']);
                $deductions = explode(',', $row['pay_ded']);


                ?>

                <!-- Salary Slip Modal -->
                <div class="modal-body">
                    <div class="salary-slip-container" id="sal_con">
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
                                <?= $row['employee_name'] ?>
                            </p>
                            <p>Designation:
                                <?= $row['designation'] ?>
                            </p>
                            <p>Month:
                                <?= $row['salary_month'] ?>,
                                <?= $row['salary_year'] ?>
                            </p>

                        </div>

                        <div class="sal_table">
                            <table class="salary-details-table">
                                <tr>
                                    <th>Earnings</th>
                                    <th>Amount</th>

                                </tr>
                                <?php

                                // Loop through and display allowances
                    

                                for ($i = 0; $i < sizeof($allowances) - 1; $i++) {
                                    $allowanceParts = explode('-', $allowances[$i]);
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
                                for ($i = 0; $i < sizeof($deductions) - 1; $i++) {
                                    $deductionParts = explode('-', $deductions[$i]);
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
                        </div>
                        <p class="center-text net-salary">Net Salary:
                            <?= $row['net_salary'] ?>
                        </p>


                        <div class="salary-slip-details">
                            <p>Cheque No: 12345</p>
                            <p>Bank Name: ABC Bank</p>
                            <p>Dated As: 2023-01-31</p>
                            <br><br><br>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Employee's Signature</p>
                                <p>Director's Signature</p>
                            </div>
                        </div>
                        <form>
                            <center>
                                <input type="button" id="print_btn" value="Print" onclick="sal_print()" />
                                <!-- <input type="button" value="Print" onclick="printDiv('divToPrint')" /> -->

                            </center>
                        </form>
                    </div>
                </div>


                <?php
            }
        }
    }

    // function convertToWords($number)
    // {
    //     // You can implement your logic to convert numbers to words here
    //     // For a simple implementation, you can check online resources or PHP libraries
    //     return "Amount in words"; // Replace with your implementation
    // }
    // ?>



</body>
<script>

    function sal_print() {

        var pbtn = document.getElementById('print_btn');
        var content = document.getElementById('sal_con');
        content.style.width = "90%";
        pbtn.style.display = "none";
        window.print();
        content.style.width = "60%";
        pbtn.style.display = "block";

    }
</script>

</html>