<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
<?php include'db_connect.php';
$id=$_GET['id'];
$i = 1;
$row = $conn->query("SELECT * FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.id='$id' ")->fetch_array();

       

?>
<div >
    <div class="container"  >
        <div class="row">
          <div class="col">
            <h1> ref nº:<b><?php echo$row['N']; ?></b></h1>
          </div>
          <div class="col-6">
    
          </div>
          <div class="col">
           <p id="h">M'Saken, le <?php $date=date("d/m/y");echo $date ?>  </p>
          </div>
        </div>
    </div>
        <div class="container" id="div2">
            <div class="row justify-content-md-center">
              <div class="col col-lg-2">
               
              </div>
              <div class="col-md-auto">
               <P > <center> <u id="p">ATTESTATION</u></center></P>
              </div>
              <div class="col col-lg-2">
               
              </div>
            </div>
        </div>
            <div class="container" id="attes">
            <p>Nous soussignes, Societe Tunisienne des industries de Pneumatiques, attestons</p>
            <p>que Monsieur <b><?php echo $row['nom'] ?></b></p>
            <p>Étudiant(e) à  <b><?php $etab=$row['etablissement'] ;
            $row1 = $conn->query("SELECT * FROM etablissementstage where etablissement= '$etab'")->fetch_array();
            echo $row1['desc établissement'] ?></b> </p>
            <p>spécialité  <b><?php $spe=$row['specialite'];
             $row2 = $conn->query("SELECT * FROM specialitestage where 	specialite= '$spe'")->fetch_array();
             echo $row2['desc specialite'] ;
             ?></b></p>
            <p>a effectue un <b><?php $type=$row['type'];
             
             $row3 = $conn->query("SELECT * FROM typestage where type= '$type'")->fetch_array();
             echo $row3['description'] ;
            ?></b> </p>
            <p>au sein de l'usine de Ia STIP-M'SAKEN durant Ia periode allant du au inclus.</p>
            <p>Cette attestation est delivree a l'interesse(e) pour servir et valoir ce que de droit</p>
              </div>
              <div class="row" id="m">
                <div class="col-md-6 offset-md-3"><b> <u >LE DIRECTEUR DE L'USINE <br> FETHI ELABED</u></b></div>
              </div>
</div>


</body>

<style>  
    
    
    h1 {
  font-size: 20px;
}
footer{
    margin-top: 175px;
    font-size: 8px;
}
#attes{
    font-size: 15px;
}

#p{
    font-size: 40px;
    
}
#div1{
    margin-bottom: 50px;
}
#div2{
    margin-bottom: 50px;
}
#m{
    margin-top: 50px;
    margin-left: 350px;
    
}
    </style>  
</html>