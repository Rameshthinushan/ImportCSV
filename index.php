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
                    // fgetcsv($csvFile);
                  while (($line = fgetcsv($csvFile)) != false ){
                        $name = $line[0];
                        $address = $line[1];
                        $age = $line[2];
                        $sql = "INSERT INTO impotrcsv(name,address,age) VALUES ('$name','$address','$age')";
                        mysqli_query($connect,$sql);

                  }
                  fclose($csvFile);
                  $q = "?status=success";

               }else{
                $q = "?status=some thing wrong";
               } 
                
            } else {
                $q = "?status=invalid File";
            }
            
            echo "<script> window.open('index.php{$q}','_self')</script>";

            $status = $_GET['status'];
            echo "<script>
                    alert($status)
                    </script>";

        }

        
    ?>
  </body>
</html>