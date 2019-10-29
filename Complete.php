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
?>
<html>
    <head>
        
    </head>
    <body>
        <form class="container border border-primary mt-4 mb-4">
            <table class="table">
            <tbody>
                <tr>
                    <?php
                    if(isset($_SESSION["name"])){
                        ?>                        
                        <p class="h3 mt-2">Thank You, <span style="color : blue;"><?php echo $_SESSION["name"]; ?></span>, for using our Deposit Calculator!</p>
                        <p>Our customer service department will <?php if($_SESSION["contactMethod"] == 'Phone'){echo 'call';} else {echo 'email';} ?> you tomorrow
                        <?php
                            if($_SESSION["contactMethod"] == 'Phone')
                                {
                                    $selected_array = implode(' or ', $_SESSION["contactTime"]); 
                                    echo $selected_array;        
                                } ?>        
                        at
                        <?php if($_SESSION["contactMethod"] == 'Phone'){echo $_SESSION["phoneNumber"];} else {echo $_SESSION["emailAddress"];} ?>.</p>
                        <?php session_destroy();?>
                            <?php
                    }
                    else{
                        ?>
                        <p class="h3 mt-2">Thank you for using our Deposit Calculator tool.</p>
                        <?php session_destroy();?>
                            <?php
                    }
                    ?>  
                </tr>
            </tbody>
            </table>
        </form>
    </body>
</html>
