<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="margin: 0px;">
        <footer style="position: absolute; bottom: 0;
            width: 100%; height: 60px; background-color: darkgreen;">
            <div class="container" style="margin: 0px;">                    
            <p style="text-align: center; padding: 10px; color: white;">            
            &copy; Algonquin College 2010 –             
                <?php date_default_timezone_set("America/Toronto");
                print Date("Y"); ?>.
            All Rights Reserved
        </p>
        </div>
        </footer>
        <script src="Lab4Scripts/Site.js" type="text/javascript"></script>
        <script src="Lab4Common/Scripts/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="Lab4Common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
