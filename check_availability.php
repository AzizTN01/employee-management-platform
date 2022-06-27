<?php
include "db_connect.php";

if(isset($_POST['CIN'])){
  $CIN = mysqli_real_escape_string($conn,$_POST['CIN']);
   $query = "select count(*) as CIN from stages_parent  where CIN='".$CIN."'";
   

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Disponible.</span>";
   $rowc=mysqli_num_rows($result);
   if($rowc){
      $row = mysqli_fetch_array($result);

      $count = $row['CIN'];
    
      if($count > 0){
          $response = "<span style='color: red;'>déjà existant</span>";
      }
   }
   echo $response;
   die;
}
?>