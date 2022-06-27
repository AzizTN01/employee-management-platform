<?php
include 'db_connect.php';
$id=$_GET['id'];

$qry = $conn->query("SELECT * FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.id='$id' ");
$number=$qry->num_rows;
$qrymle = $conn->query("SELECT * FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.id='$id' ");
$Mle=$qrymle->fetch_array();

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="callout callout-info">
					<dl>
						<dt>Matricule:</dt>
						<dd> <h4><b><?php echo $Mle['N'] ?></b></h4></dd>
					</dl>
				</div>
			</div>
		</div>
		
		<div class="row">
		<?php 
		while($row=$qry->fetch_array()){
		?>
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Information professionelle</b><br>
					<dl>
					    <dt>Nombre des stages:</dt>
						<dd><?php echo $number ?></dd>
						<dt>Etablissement:</dt>
						<dd><?php echo $row['etablissement'] ?></dd>
						<dt>Specialite:</dt>
						<dd><?php echo $row['specialite']?></dd>
						<dt>Type stage :</dt>
						<dd><?php echo $row['type'] ?></dd>
						<dt>Affectation:</dt>
						<dd><?php echo $row['affectation']?></dd>
						<dt>Encadreur:</dt>
						<dd><?php echo $row['encadreur']?></dd>
						<dt>Date Debut:</dt>
						<dd><?php echo $row['dated']?></dd>
						<dt>Date Fin:</dt>
						<dd><?php echo $row['datef']?></dd>

						
					</dl>
				</div>
			</div>
			<?php }
		?>
		</div>
	
	</div>
</div>
<div class="modal-footer display p-0 m-0">


 
<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>

</div>

<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<noscript>
	<style>
		table.table{
			width:100%;
			border-collapse: collapse;
		}
		table.table tr,table.table th, table.table td{
			border:1px solid;
		}
		.text-cnter{
			text-align: center;
		}
	</style>
	<h3 class="text-center"><b>Student Result</b></h3>
</noscript>
<script>
	$(document).ready(function(){
		$('#list tbody').on('click', '.delete_parcel', function () {
	_conf("Voulez-vous vraiment supprimer ce stagierel?","delete_parcel",[$(this).attr('data-id')])
	})
	})
	
	$('#delete').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:$(this).serialize(),
			error:(err)=>{
				console.log(err)
				alert_toast('An error occured.',"error")
				end_load()
			},
			success:function(resp){
				if(resp==1){
					alert_toast("Parcel's Status successfully updated",'success');
					setTimeout(function(){
						location.reload()
					},750)
				}
			}
		})
	})
</script>
