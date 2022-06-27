<?php

use function PHPSTORM_META\type;

if(!isset($conn)){ include 'db_connect.php'; } 
$id=$_GET['id'];
$mLe=$_GET['mLe'];
echo($id);
echo($mLe);

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
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''?>">
        <div class="row">
          <div class="col-md-12">
          <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Statue</label>
                <select name="actif" id="" class="form-control input-sm" required >
              <option value="1">Actif</option>
              <option value="3">En Attente</option>
                </select>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Type</label>
                <select name="type" id="" class="form-control input-sm select2">
                <?php
                    $type = "select * from typestage";
                    $result = mysqli_query($conn,$type);
                   while($row = mysqli_fetch_array($result)){
                   echo "<option value='".$row["type"]."'>".$row["type"]." ";}
                                    ?>          
                </select>
              </div>
          </div>
         

            <div class="row">       
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Etablissement</label>
                <select name="etablissement" id="" class="form-control input-sm select2">
                <?php
                    $titre = "select * from etablissementstage";
                    $result = mysqli_query($conn,$titre);
                   while($row = mysqli_fetch_array($result)){
                   echo "<option value='".$row["etablissement"]."'>".$row["etablissement"]." ";}
                                    ?>          
                </select>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Specialite</label>
                <select name="specialite" id="" class="form-control input-sm select2">
                <?php
                    $titre = "select * from specialitestage";
                    $result = mysqli_query($conn,$titre);
                   while($row = mysqli_fetch_array($result)){
                   echo "<option value='".$row["specialite"]."'>".$row["specialite"]." ";}
                                    ?>     
                    </select>
              </div>
            </div>
           
            <div class="row">
            <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Affectation</label>
                <select name="affectation" id="" class="form-control input-sm select2">
                <?php
                    $titre = "select * from departement";
                    $result = mysqli_query($conn,$titre);
                   while($row = mysqli_fetch_array($result)){
                   echo "<option value='".$row["departement"]."'>".$row["departement"]." ";}
                                    ?>     
                    </select>
              </div>
              <div class="col-sm-6 form-group ">
            
                <label for="" class="control-label">Encadreur</label>
                <input name="encadreur" id="" cols="30" rows="2" class="form-control" required></textarea>
              </div>
            </div>
            <div class="row">
            <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Date Debut</label>
                <input type="date" name="dated" id="" cols="30" rows="2" class="form-control" required></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Date Fin</label>
                <input type="date" name="datef" id="" cols="30" rows="2" class="form-control" required></textarea>
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
    if(isset($_POST['submit']))
    {
        $mat = $mLe;
        $id_parent = $id;
        $etablissement = $_POST['etablissement'];
        $specialite = $_POST['specialite'];
        $dated = $_POST['dated'];
        $datef = $_POST['datef'];
        $affectation = $_POST['affectation'];
        $encadreur = $_POST['encadreur'];
        $type = $_POST['type'];
        $actif = $_POST['actif'];
        //This below line is a code to Send form entries to database
        $sql = "INSERT INTO stages_details (N,id_parent, etablissement , specialite, dated, datef, affectation , encadreur , type, actif) VALUES ('".$mat."','".$id_parent."','".$etablissement."','".$specialite."' ,'".$dated."','".$datef."','".$affectation."','".$encadreur."','".$type."','".$actif."')";
        //fire query to save entries and check it with if statement
        $rs = mysqli_query($conn, $sql);
        if($rs)
            {
            
            }
 
    }

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
$('#manage-branch').submit(function(e){
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