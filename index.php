<?php

include "config.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="container" style = "margin-top:30px;" >
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="file" class="form-control" name = "fileUpload" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit" name="btnImport" id="button-addon2">Button</button>
            </div>
        </div>
    </div>
    </form>
    <?php
        if(isset($_POST['btnImport'])){
            $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
            if(in_array($_FILES['fileUpload']['type'],$mimes)){
               if(is_uploaded_file($_FILES['fileUpload']['tmp_name'])){
                   $csvFile = fopen($_FILES['fileUpload']['tmp_name'],'r');
                    fgetcsv($csvFile);
                    fgetcsv($csvFile);
                    fgetcsv($csvFile);
                  while (($line = fgetcsv($csvFile)) != false ){
                        $orderID = $line[0];
                        $date = $line[28];
                        $firstname = $line[2];
                        $lastname = $line[3]
                        $telephone = $line[34];
                        $email = $line[33];
                        $ordertotal = $line[27];
                        $name = $line[25];
                        $sku = $line[24];
                        $quantity = $line[26];
                        $shippingaddresscompany = $line[4];
                        $shippingaddressline1 = $line[5].$line[6] ;
                        $shippingaddressline2 = $line[7];
                        $shippingaddressline3 = $line[8];
                        $shippingaddresscity = $line[10];
                        $shippingaddresspostcode = $line[9];
                        $shippingaddresscountry = $line[12] ;

                        $sql = "INSERT INTO netherlandtemporders(orderID,date,firstname,lastname,telephone,email,ordertotal,name,sku,quantity,shippingaddresscompany,shippingaddressline1,shippingaddressline2,shippingaddressline3,shippingaddresscity,shippingaddresspostcode,shippingaddresscountry) 
                        VALUES ('$orderID','$date','$firstname','$lastname','$telephone','$email','$ordertotal','$name','$sku','$quantity','$shippingaddresscompany','$shippingaddressline1','$shippingaddressline2','$shippingaddressline3','$shippingaddresscity','$shippingaddresspostcode','$shippingaddresscountry')";
                        mysqli_query($connect,$sql);

                  }
                  fclose($csvFile);
                  
               }else{
                echo "<script>
                        alert('something wrong')
                      </script>";
               } 
                
            } else {
                echo "<script>
                        alert('invilid file formet')
                      </script>";
            }
          

        }

        
    ?>
  </body>
</html>


CREATE TABLE `germantemporders` (
  `id` int(11) NOT NULL,
  `orderID` text NOT NULL,-bestelnummer - 0
  `status` text NOT NULL,
  `date` datetime NOT NULL,besteldatum -28
  `channel` text NOT NULL,
  `firstname` text NOT NULL,-voornaam_verzending - 2
  `lastname` text NOT NULL,-achternaam_verzending - 3
  `telephone` text NOT NULL,-telnummerbezorging -34
  `email` text NOT NULL,-emailadres -33
  `currency` text NOT NULL,
  `ordertotal` decimal(10,2) NOT NULL,prijs - 27
  `name` text NOT NULL, - producttitel -25
  `sku` text NOT NULL, - referentie -24
  `quantity` int(11) NOT NULL,- aantal
  `lineitemtotal` decimal(10,2) NOT NULL,
  `flags` text NOT NULL,
  `shippingservice` text NOT NULL,
  `shippingaddresscompany` text NOT NULL, -bedrijfsnaam_verzending 4
  `shippingaddressline1` text NOT NULL, -adres_verz_straat,adres_verz_huisnummer 5,6
  `shippingaddressline2` text NOT NULL, adres_verz_huisnummer_toevoeging
  `shippingaddressline3` text NOT NULL,adres_verz_toevoeging
  `shippingaddressregion` text NOT NULL,
  `shippingaddresscity` text NOT NULL,-woonplaats_verzending
  `shippingaddresspostcode` text NOT NULL,-postcode_verzending
  `shippingaddresscountry` text NOT NULL,-aanhef_facturatie
  `shippingaddresscountrycode` text NOT NULL,
  `booking` text NOT NULL,
  `csvdate` date NOT NULL,
  `unit` text NOT NULL,
  `addedby` text NOT NULL,
  `merge` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `zenstoresOrderTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;