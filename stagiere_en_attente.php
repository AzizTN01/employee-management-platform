<?php include'db_connect.php'


?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
		<div class="card-tools">
				
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=Ajouter_Stagiere"><i class="fa fa-plus"></i>Ajouter Stagiere</a>
				</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">Matricule</th>
						<th>Nom et prnom</th>
						<th>CIN</th>
						<th>Contact</th>
						<th>Date de Naissance</th>
						<th>durée restante</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					
					
					$qry = $conn->query("SELECT *,p.id as ID FROM stages_parent as p,stages_details as d WHERE  p.actif='3' order by p.id DESC");
					
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
					<!-- <td class="text-center"><a href="info-stagiere.php?
					<?php $id=$row['N']; ?>
					
					" class="badge badge-info"><?php echo  $row['N'] ?></a></td> -->
					<td > <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <?php echo  $row['N'] ?> </button>
			
				</td>
				
					   <td class=""><b><?php echo $row['nom'] ?></b></td>
						<td><b><?php echo $row['CIN'] ?></b></td>
						<td><b><?php echo $row['contact'] ?></b></td>
						<td><b><?php echo $row['daten'] ?></b></td>
						<td><b><?php 
							$date1 =  new datetime($row['dated']);
							$date2 =  new datetime(date("Y/m/d"));
							$diff = $date2->diff($date1)->format("%a");
							echo $diff;
							?></b></td>
						 <td><b> <div class="btn-group">
					
					
								<button type="button" class="btn btn-success btn-flat view_stage" data-id="<?php echo $row['ID'] ?>">
								<i class="fas fa-user-cog"></i>
		                        </button>
								<a href="./index.php?page=Ajouter_Stage&id=<?php echo $row['ID'] ?>&mLe=<?php echo $row['N'] ?>" class="btn btn-warning">
						 <i class="far fa-calendar-plus"></i>
		                        </a>
						 <button type="button" class="btn btn-info btn-flat view_parcel" data-id="<?php echo $row['ID'] ?>">
		                          <i class="fas fa-eye"></i>
		                        </button>
								<a href="./index.php?page=update_stagiere&id=<?php echo $row['ID'] ?>" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
								<button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
	                      </div></b></td>

					</tr>	
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Large modal -->


<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
		$(document).ready(function(){
		$('#list').dataTable()
		$('#list tbody').on('click', '.view_parcel', function () {
			uni_modal("information stagiere","view_parcel.php?id="+$(this).attr('data-id'),"large")
		})
		$('#list tbody').on('click', '.view_stage', function () {
			uni_modal("information de stage","liste_stage.php?id="+$(this).attr('data-id'),"large")
		})
		
		$('#list tbody').on('click', '.delete_parcel', function () {
	_conf("Voulez-vous vraiment supprimer ce stagierel?","delete_parcel",[$(this).attr('data-id')])
	})
	})
	
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
