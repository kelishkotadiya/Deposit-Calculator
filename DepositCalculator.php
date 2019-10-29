<?php include './Lab4Common/Header.php'; ?>
<?php include './Lab4Common/Footer.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
header('Cache-Control: no-cache');
header('Pragma: no-cache');

if(!isset($_SESSION["name"])){
    header("Location: CustomerInfo.php");
    exit();
}
?>
    <?php
    if (!empty($_POST)) 
        {
            extract($_POST);
            $error = array();
            $principalAmountError = ValidatePrincipalAmount($principalAmount);            
            $interestRateError = ValidateInterestRate($interestRate);
            $depositYearsError = ValidateDepositYears($yearsToDeposit);
            if ($principalAmountError !== "") {
                $error["principalAmount"] = $principalAmountError;
            }
            if ($interestRateError !== "") {
                $error["interestRate"] = $interestRateError;
            }
            if ($depositYearsError !== "") {
                $error["yearsToDeposit"] = $depositYearsError;
            } 
        }
    ?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>    
    
    <div >
    <?php
        function ValidatePrincipalAmount($amount) {
            if ($amount === ""){
                return "*Principal amount is required";
            }
            if (preg_match("/^\d+/", $amount) === 1) {
                return "";
            }
            return "*Principal amount must be numeric";
        }
        function ValidateInterestRate($rate) {
            if ($rate === "") {
                return "*Interest rate is required";
            }
            if (preg_match("/^\d+/", $rate) === 1){
                return "";
            }
            return "*Interest rate must be non-negative numeric";
        }
        function ValidateDepositYears($years) {
            if($years == "Select"){
                return "Years to deposit must be selected";
            }
            if (preg_match("/^([1-9]{1}[0-9]{0,1})$/", $years) === 1) {
                return "";
            }
            return "*Years to deposit must be numeric and between 1 and 20";
        }
    ?>   
<form class="container border border-primary mt-4 mb-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="DepositCalculator" method="post">
    <p class="h4" style="text-align: center;">Enter principal amount, interest rate and select number of years to deposit </p>
    <div class="form-row">
        <div class="col-md mt-1">
            <label>Principal Amount</label>
            <input type="text" class="form-control" name = "principalAmount" placeholder="Principal Amount" >
            <small class="form-text alert-danger"><?php echo $error["principalAmount"]; ?></small>
        </div>
        <div class="col-md mt-1">
            <label>Interest Rate(%)</label>
            <input type="text" class="form-control" name = "interestRate" placeholder="Interest Rate(%)" >
            <small class="form-text alert-danger"><?php echo $error["interestRate"]; ?></small>
        </div>
        <div class="col-md mt-1">
            <label>Years to Deposit</label>
            <select class="form-control" name = "yearsToDeposit">
                <option value="Select" selected="selected">Select . . .</option>
                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
                <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
            </select>
            <small class="form-text alert-danger"><?php echo $error["yearsToDeposit"]; ?></small>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 5px;" name="bCalculate" value="Submit">Calculate</button>
    <button type="reset" class="btn btn-primary" style="margin-top: 5px;" name="bClear" value="Reset" onclick="hide()">Clear</button>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
    <?php if(isset($bCalculate) && empty($error)) : ?>    
        <div class="echo" id="hidden_div">        
        <form class="container border border-primary mt-4 mb-4" name="calculationTable">
            <?php $interest_per_year = $principal_amount * $interest_rate / 100 ;
                  $interest_amount = $principal_amount + $interest_per_year; ?>
            <P style="margin-top: 25px;">The following is the result of the calculation:</p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Principal at Year Start</th>
                        <th scope="col">Interest for the Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i <= $yearsToDeposit; $i++) : ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php printf("\$%.2f", $principalAmount); ?></td>
                        <td><?php $interest = $principalAmount * $interestRate / 100; 
                            $principalAmount += $interest; 
                            printf("\$%.2f", $interest); ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </form>
        </div>
    <?php endif; ?>    
<?php endif; ?>         
    </div>
    
    <script type="text/javascript">
    function hide() {
            document.getElementById("hidden_div").style.display = "none";
    }
    </script>
        
    <?php if (!empty($_POST)) : ?>
    <script>
    <?php foreach ($_POST as $key => $value) : ?>
        <?php if ($value != "" && $key !== "bCalculate") : ?>
        document.DepositCalculator.<?php echo $key; ?>.value = <?php echo '"' . $value . '"'; ?>;
        <?php endif; ?>
    <?php endforeach; ?>
    </script>
    <?php endif; ?>
   
    </body>
</html>

