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

if(!isset($_SESSION["checkBox"])){
    header("Location: Disclaimer.php");
    exit();
}

?>
    <?php
        if (!empty($_POST)) 
        {
            extract($_POST);
            $_SESSION["name"] = $name;
            $_SESSION["phoneNumber"] = $phoneNumber;
            $_SESSION["emailAddress"] = $emailAddress;
            $_SESSION["contactMethod"] = $contactMethod;
            $_SESSION["contactTime"]= $contactTime;
            $error = array();
            $nameError = ValidateName($name);
            $postalCodeError = ValidatePostalCode($postalCode);            
            $phoneNumberError = ValidatePhoneNumber($phoneNumber);            
            $emailAddressError = ValidateEmailAddress($emailAddress);
            if ($nameError !== "") {
                $error["name"] = $nameError;
            }
            if ($postalCodeError !== "") {
                $error["postalCode"] = $postalCodeError;
            }
            if ($phoneNumberError !== "") {
                $error["phoneNumber"] = $phoneNumberError;
            }
            if ($emailAddressError !== "") {
                $error["emailAddress"] = $emailAddressError;
            }
            if (!isset($contactMethod)) {
                $error["contactMethod"] = "*Contact method is required";
            }
            if ($contactMethod === "Phone" && !isset($_POST["contactTime"])) {
                $error["contactTime"] = "*If phone is contact method, time must be selected";
            }
            if (empty($error)) {
                header("Location:DepositCalculator.php");
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
        function ValidateName($name) {
            if ($name === "") {
                return "*Name is required";
            }
            return "";
        }
        function ValidatePostalCode($postalCode) {
            if ($postalCode === "") {
                return "*Postal code is required";
            }
            if (preg_match("/[a-z]\d[a-z] ?\d[a-z]\d/i", $postalCode) === 1) {
                return "";
            }
            return "*Postal code is invalid";
        }
        function ValidatePhoneNumber($phoneNumber) {
            if ($phoneNumber === "") {
                return "*Phone number is required";
            }
            if (preg_match("/^[2-9]\d{2}-[1-9][1-9][1-9]-\d{4}$/", $phoneNumber) === 1) {
                return "";
            }
            return "*Phone number is invalid";
        }
        function ValidateEmailAddress($emailAddress) {
            if ($emailAddress === "") {
                return "*Email address is required";
            }
            if (preg_match("/[a-z\d._%+-]+@(([a-z\d-]+)\.)+[a-z]{2,4}/i", $emailAddress) === 1) {
                return "";
            }
            return "*Email address is invalid";
        }
    ?>
       
<form class="container border border-primary mt-4 mb-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="CustomerInfo" method="post">
    <p class="h3" style="text-align: center;"><strong>Customer Information</strong></p>
    <div class="form-row">
        <div class="col-md mt-1">
            <label>Name</label>
            <input type="text" class="form-control" name = "name" placeholder="Name" >
            <small class="form-text alert-danger"><?php echo $error["name"]; ?></small>
        </div>
        <div class="col-md mt-1">
            <label>Postal Code</label>
            <input type="text" class="form-control" name = "postalCode" placeholder="Postal Code" >
            <small class="form-text alert-danger"><?php echo $error["postalCode"]; ?></small>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md mt-1">
            <label>Phone (nnn-nnn-nnnn)</label>
            <input type="text" class="form-control" name = "phoneNumber" placeholder="Phone Number" >
            <small class="form-text alert-danger"><?php echo $error["phoneNumber"]; ?></small>
        </div>
        <div class="col-md mt-1">
            <label>Email</label>
            <input type="text" class="form-control" name = "emailAddress" placeholder="Email Address" >
            <small class="form-text alert-danger"><?php echo $error["emailAddress"]; ?></small>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md mt-1">
            <label>Preferred Contact Method</label>
            <div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="contactMethod" value = "Phone" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Phone</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="contactMethod" value = "Email" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Email</label>
                </div>
            </div>
            <small class="form-text alert-danger"><?php echo $error["contactMethod"]; ?></small>
        </div>
        <div class="col-md mt-1">
            <label>If phone is selected, when can we contact you? (check all applicable)</label>
            <div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <?php $checked = isset($contactTime) && in_array("morning", $contactTime)? "checked" : "" ?> 
                    <input type="checkbox" class="custom-control-input" name = "contactTime[]" id="morning" value="morning" <?php print $checked?>>
                    <label class="custom-control-label" for="morning">Morning</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <?php $checked = isset($contactTime) && in_array("afternoon", $contactTime)? "checked" : "" ?>
                    <input type="checkbox" class="custom-control-input" name = "contactTime[]" id="afternoon" value="afternoon" <?php print $checked?>>
                    <label class="custom-control-label" for="afternoon">Afternoon</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <?php $checked = isset($contactTime) && in_array("evening", $contactTime)? "checked" : "" ?>
                    <input type="checkbox" class="custom-control-input" name = "contactTime[]" id="evening" value="evening" <?php print $checked?>>
                    <label class="custom-control-label" for="evening">Evening</label>
                </div>
            </div>
            <small class="form-text alert-danger"><?php echo $error["contactTime"]; ?></small>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-1 mb-2" name="bCalculate" value="Calculate">Calculate</button>
    <button type="reset" class="btn btn-primary mt-1 mb-2" name="bClear" value="Clear">Clear</button>
</form>   
        
    <?php if (!empty($_POST)) : ?>
    <script>
    <?php foreach ($_POST as $key => $value) : ?>
        <?php if ($value != "") : ?>
        document.CustomerInfo.<?php echo $key; ?>.value = <?php echo '"' . $value . '"'; ?>;
        <?php endif; ?>
    <?php endforeach; ?>
    </script>
    <?php endif; ?>
    
    </body>
</html>
