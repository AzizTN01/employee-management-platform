<?php

use function PHPSTORM_META\type;

if(!isset($conn)){ include 'db_connect.php'; }
if(isset($_POST['submit']))
{
    $mat = $_POST['N'];
    $nom = $_POST['nom'];
    $titre = $_POST['titre'];
    $contact = $_POST['contact'];
    $daten = $_POST['daten'];
    $CIN = $_POST['CIN'];
    $actif = $_POST['actif'];
    //This below line is a code to Send form entries to database
  
    $sql = "INSERT INTO stages_parent (N, nom , titre, contact, daten, CIN,  actif) VALUES ('".$mat."','".$nom."', '".$titre."' , '".$contact."', '".$daten."' , '".$CIN."' ,'".$actif."')  ";
     //fire query to save entries and check it with if statement
    $rs = mysqli_query($conn, $sql);
    if($rs)
        {
         
        }

}

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
                <input type="text" name="N" id="N" cols="30" rows="2" onBlur="checkUserAvailability()" class="form-control"  required></textarea>
                <span id="usercheck" class="help-block"></span>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Statue</label>
                <select name="actif" id="" class="form-control input-sm" required >
              <option value="1" >Actif</option>
              <option value="3" selected>En Attente</option>
                </select>
              </div>
             
          </div>
            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Nom et Prénom</label>
                <input name="nom" id="" cols="30" rows="2" class="form-control" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Titre</label>
                <select name="titre" id="" class="form-control input-sm" required>
                <?php 
                $titre = "select * from titre";
                $result = mysqli_query($conn,$titre);
               while($row = mysqli_fetch_array($result)){
                echo "<option value='".$row["nomk"]."'>".$row["nomk"]." ";}
                ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Date de Naissance</label>
                <input type="date" name="daten" id="" cols="30" rows="2" class="form-control" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Numéro CIN</label>
                
                <input  name="CIN" id="CIN" cols="30" rows="2" class="form-control form-control-sm" required></textarea>
                <div id="uname_response" ></div>
              </div>
            </div>

            <div class="row">
            <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Numéro telephone</label>
                <input name="contact" id="" cols="30" rows="2" class="form-control" required></textarea>
              </div>
           
             
            </div>
            

            
          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-branch" name="submit">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=stagiere_actif">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<?php
 
?>
<script>
 $(document).ready(function(){

$("#CIN").keyup(function(){

   var CIN = $(this).val().trim();

   if(CIN != ''){

      $.ajax({
         url: 'check_availability.php',
         type: 'post',
         data: {CIN: CIN},
         success: function(response){

             $('#uname_response').html(response);

          }
      });
   }else{
      $("#uname_response").html("");
   }

 });

});
$(' ').submit(function(e){
		$.ajax({
			
			success:function(){
				
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
					},2000)
				
			}
		})
	})
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