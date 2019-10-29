<?php include './Lab4Common/Header.php'; ?>
<?php include './Lab4Common/Footer.php'; ?>

<?php
    session_start();
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    
    extract($_POST);
    $checkboxError = '';
    
    if(isset($bSubmit))
    {
        if(!isset($checkBox))
        {
            $checkboxError = " *you must agree the terms and conditions.";
        }
        else
        {
            $_SESSION["checkBox"] = $checkBox;
            header("Location: CustomerInfo.php");
            exit( );
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        <form class="container mt-4 mb-4" method="post">
            <h2>Terms and Condition</h2>
            <table>
                <tbody>
                    <tr>
                    <br>
                        I agree to abide by the Bank's Terms and condition and rules in force and the changes in Terms and Conditions from time to time relating to my account as communicated and made available  on the Bank's website.<br>                        
                    </tr>
                    <tr>
                    <br>
                        I agree that bank before opening any deposit account, will carry out a due diligence as required under know your customer guidelines of the bank. I would be required to submit necessary or proofs, such as identity, address, photograph and any such information, i agree to submit the above documents again at periodic intervals, as may be required by the Bank.
                    </tr>
                    <tr>
                    <br>
                    <br>
                        I agree that the Bank can at its sole discretion, amend any of the services/facilities given in my account either wholly or partially at any time by giving me at least 30 days notice and/or provide and option to me to switch to other services/facilities.
                    </tr>
                    <tr>
                        <br>
                        <br>
                        <input type="checkbox" name="checkBox" value="checked"/>I have read and agree with the terms and conditions.
                    </tr>
                    <tr>
                    <br>
                        <p style="color:red;"><?php echo $checkboxError; ?></p>
                    </tr>
                    <tr>
                        <br>
                        <input type="submit" name ="bSubmit"  value ="Submit" style="position: absolute;"/>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>

