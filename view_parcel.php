<?php
include 'db_connect.php';
$id=$_GET['id'];

$row = $conn->query("SELECT * FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.id='$id' ")->fetch_array();

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="callout callout-info">
					<dl>
						<dt>Matricule:</dt>
						<dd> <h4><b><?php echo $row['N'] ?></b></h4></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Information personelle</b><br>
					<dl>
						<dt>Nom:</dt>
						<dd><?php echo $row['nom'] ?></dd>
						<dt>Titre:</dt>
						<dd><?php echo $row['titre']?></dd>
						<dt>Date De Naissance:</dt>
						<dd><?php echo $row['daten'] ?></dd>
						<dt>CIN:</dt>
						<dd><?php echo $row['CIN']?></dd>
						<dt>Contact:</dt>
						<dd><?php echo $row['contact']?></dd>
						<dt>specialite:</dt>
						<dd><?php echo $row['specialite']?></dd>
						
					</dl>
				</div>
			</div>
			
		
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
