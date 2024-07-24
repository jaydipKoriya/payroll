<?php
include 'connection.php';

if (isset($_POST['salary_id'])) {
    $salaryId = $_POST['salary_id'];

    // Fetch salary details from the database using the provided $salaryId
    $query = "SELECT * FROM salary_info WHERE salary_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $salaryId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Split allowances and deductions using explode
            $allowances = explode(',', $row['pay_ear']);
            $deductions = explode(',', $row['pay_ded']);

            // Output the salary details in the modal
            ?>
            <div id="divToPrint">

                <!-- front end -->
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
                <!-- front end end -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>

            </div>
            <?php
        } else {
            echo "Salary details not found.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Function to convert numbers to words
function convertToWords($number)
{
    // You can implement your logic to convert numbers to words here
    // For a simple implementation, you can check online resources or PHP libraries
    return "Amount in words"; // Replace with your implementation
}


?>