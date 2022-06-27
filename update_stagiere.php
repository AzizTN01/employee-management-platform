<?php

use function PHPSTORM_META\type;

if(!isset($conn)){ include 'db_connect.php'; } ?>
<?php
include 'db_connect.php';
$id=$_GET['id'];

    if(isset($_POST['submit']))
    {
        $mat = $_POST['N'];
        $nom = $_POST['nom'];
        $contact = $_POST['contact'];
        $daten = $_POST['daten'];
        $CIN = $_POST['CIN'];
        $actif = $_POST['actif'];
       
        //This below line is a code to Send form entries to database
        $sql = "UPDATE stages_parent set N = '$mat', nom = '$nom', contact ='$contact' , daten = '$daten' , CIN =' $CIN' , actif='$actif'  where id = $id";
         //fire query to save entries and check it with if statement
         echo $sql;
        

       $rs = mysqli_query($conn, $sql);
       
      
  }



$row = $conn->query("SELECT * FROM stages_parent where id =".$id)->fetch_array();


?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-branch" method="post">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
          <div class="row">
            <div class="col-sm-6 form-group ">
                <label for="" class="control-label">matricule</label>
                <input type="" name="N" id="" cols="30" rows="2" class="form-control" value="<?php echo $row['N'] ?>" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                
                <label for="" class="control-label">Statue</label>
                <select name="actif" id="" class="form-control input-sm select2" required>
                   <?php 
                $statue = "select * from statue";
                $result = mysqli_query($conn,$statue);
               while($row1 = mysqli_fetch_array($result)){
                $selected =( $row1["id"] == $row["actif"] ) ? "selected" : "";
                echo "<option value='".$row1["id"]."'".$selected.">".$row1["statue"]." ";}
                ?>
              
                </select>
              </div>
          </div>
            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Nom et Prénom</label>
                <input name="nom" id="" cols="30" rows="2" class="form-control" value="<?php echo $row['nom'] ?>" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Numéro telephone</label>
                <input name="contact" id="" cols="30" rows="2" class="form-control" value="<?php echo $row['contact'] ?>" required></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Date de Naissance</label>
                <input type="date" name="daten" id="" cols="30" rows="2" class="form-control" value="<?php echo $row['daten'] ?>" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Numéro CIN</label>
                <input  name="CIN" id="" cols="30" rows="2" class="form-control form-control-sm" value="<?php echo $row['CIN'] ?>" required></textarea>
              </div>
            </div>

            
            
     

            
          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-branch" onSubmit="window.location.reload()" name="submit">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=branch_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>

<script>
  

/*
	$('#manage-branch').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_branch',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
              location.href = 'index.php?page=branch_list'
					},2000)
				}
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
 */ 
</script>