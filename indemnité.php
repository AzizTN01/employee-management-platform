<?php include 'db_connect.php' ?>
<?php $status = isset($_GET['status']) ? $_GET['status'] : 'all' ?>
<div class="col-lg-12">
<form method ='post'id="formall">

	<div class="card card-outline card-primary">
		<div class="card-body">
			<div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
				<label for="date" class="mx-1">Matricule</label>
				<select name="Matricule[]" id="Matricule"  class="form-control input-sm select2" multiple required>
					<option value="all">tout</option>
					<?php
					$qry = $conn->query("SELECT *,p.id as ID FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.actif='1' order by p.id DESC");
					while($row= $qry->fetch_assoc()):
						$selected="";
						if(isset($_POST["Matricule"]))  {
						foreach ($_POST['Matricule'] as $Matricule)  
						{
							if ($row["N"]==$Matricule) {
								$selected="selected";
							}
						}
					}
						echo "<option value='".$row["N"]."' ".$selected." >  ".$row["N"]." : ".$row["nom"]."  ";
					endwhile;
						 
					
					?>

						
				
				</select>
				<label for="date_from" class="mx-1">Mois</label>
                <input type="date" name="mois" id="mois" class="form-control form-control-sm col-sm-3" value="<?php echo isset($_POST['mois'])?$_POST['mois']:"" ; ?>" required>
                <button class="btn btn-sm btn-primary mx-1 bg-gradient-primary" type="submit" name ='submit' id='view_report'>Ajouter</button>	
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 ">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
        					<button type="button" class="btn btn-success float-right" style="display: none" id="print"><i class="fa fa-print"></i> Print</button>
						</div>
					</div>	
					
					<table class="table table-bordered" id="report-list">
						<thead>
							<tr>
								<th>Nom et Matricule</th>
								<th>Base</th>
								<th>indemnité</th>
								<th>J/A</th>
								<th>indemnité final</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
	 
	  if(isset($_POST["submit"]))  
	  { 
		  // Check if any option is selected 
		  if(isset($_POST["Matricule"]))  
		  { $j=0;
			  // Retrieving each selected option 
			  foreach ($_POST['Matricule'] as $Matricule)  
			  {
				$j++;
						$qry = $conn->query("SELECT *,p.id as ID FROM stages_parent as p,stages_details as d WHERE p.id=d.id_parent AND p.actif='1' and d.N='".$Matricule."' order by p.id DESC");
						 $row= $qry->fetch_assoc(); ?>
				<tr>
					<td >  <?php echo $row['N'] ?> : <?php  echo $row['nom'] ?>   </td>
				    <td class=""><input name="base" type="number" value="26" id=""  class="form-control" readonly tabindex="-1"> </td>
					<td><input name="indem[]" type="number" id="indem_<?php echo $j ?>" min="0" cols="30" rows="2" class="form-control" required></td>
					<td><input name="joursabsent[]" type="number" id="joursabsent_<?php echo $j ?>" min="0" max="26" cols="30" rows="2" value="0" class="form-control" ></td>
					<td><input name="indemf[]" type="number" id="indemf_<?php echo $j ?>" cols="30" rows="2" class="form-control" tabindex="-1" readonly></td>

				</tr><?php
		  } 
		}
		} 
		
		?>
						</tbody>
						
					</table>
					<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">TOTAL</span>
  </div>
  <input name="indemT" type="number" id="indemT"  class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"  tabindex="-1" readonly>
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">DT</span>
  </div>
</div>
				</div>
			</div>
			<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2 submit" id="save"  name="submit">sauvegarder</button>
  			
  		</div>
		</div>
	</div>
	</form> 
</div>
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
	<h3 class="text-center"><b>Report</b></h3>
</noscript>

<?php
/*
    if(isset($_POST['submit']))
    {
       
        $mois = $_POST['mois'];
        $indemT = $_POST['indemT'];
        
        $sql = "INSERT INTO indemnité_parent (mois,indemT) VALUES ('".$mois."','".$indemT."')";
		echo("INSERT INTO indemnité_parent (mois,total) VALUES ('".$mois."','".$indemT."')");
        //fire query to save entries and check it with if statement
        $rs = mysqli_query($conn, $sql);
        if($rs)
            {
            echo"succ";
            }
 
    }
	*/
?>
<script>
	$(document).ready(function() {
		$('#save').on('click', function() {
			$('#formall').submit(function(e){
		e.preventDefault()
		})
		start_load()
		$.ajax({
			url:'ajax.php?action=save_branch',
			data:$('#formall').serialize(),
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
					},2000)
					end_load();
				}
			}
		})
	})
	}
	)



$(document).on('blur', "[id^=indem_]", function(){
	calculeTotal();
})

$(document).on('blur', "[id^=joursabsent_]", function(){
	calculeTotal();
})
function calculeTotal(){
	var totalindem=0;
	var indemT=0;

	var id=1;
	$("[id^=indem_]").each(function(){
		
var base=26;
var indem=$("#indem_"+id).val();
var joursabsent=$("#joursabsent_"+id).val();
console.log(base);
console.log(indem);
console.log(joursabsent);
totalindem=(indem/base)*(base-joursabsent);
$("#indemf_"+id).val(totalindem.toFixed(3));
indemT+=totalindem;

id++;
})
$("#indemT").val(indemT.toFixed(3));

}


/*	function load_report(){
		start_load()
		var date = $('#date').val()
		var Matricule = $('#Matricule').val()
			$.ajax({
				url:'ajax.php?action=get_report',
				method:'POST',
				data:{Matricule:Matricule,date:date},
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error')
					end_load()
				},
				success:function(resp){
					if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							$('#report-list tbody').html('')
							var i =1;
							Object.keys(resp).map(function(k){
								var tr = $('<tr></tr>')
								tr.append('<td>'+(i++)+'</td>')
								tr.append('<td> 26jours</td>')
								tr.append('<td><input name="indem" type="number" id="" cols="30" rows="2" class="form-control" required></textarea></td>')
								tr.append('<td><input name="indem" type="number" id="" cols="30" rows="2" class="form-control" required></textarea></td>')
								tr.append('<td<input name="indem" type="number" id="" cols="30" rows="2" class="form-control" required></textarea></td>')
								tr.append('<td>'+(resp[k].status)+'</td>')
								$('#report-list tbody').append(tr)
							})
							$('#print').show()
						}else{
							$('#report-list tbody').html('')
								var tr = $('<tr></tr>')
								tr.append('<th class="text-center" colspan="6">No result.</th>')
								$('#report-list tbody').append(tr)
							$('#print').hide()
						}
					}
				}
				,complete:function(){
					end_load()
				}
			})
	}
$('#view_report').click(function(){
	if($('#date_from').val() == '' || $('#date_to').val() == ''){
		alert_toast("Please select dates first.","error")
		return false;
	}
	load_report()
	var date_from = $('#date_from').val()
	var date_to = $('#date_to').val()
	var status = $('#status').val()
	var target = './index.php?page=reports&filtered&date_from='+date_from+'&date_to='+date_to+'&status='+status
	window.history.pushState({}, null, target);
})

$(document).ready(function(){
	if('<?php echo isset($_GET['filtered']) ?>' == 1)
	load_report()
})
$('#print').click(function(){
		start_load()
		var ns = $('noscript').clone()
		var details = $('.details').clone()
		var content = $('#report-list').clone()
		var date_from = $('#date_from').val()
		var date_to = $('#date_to').val()
		var status = $('#status').val()
		var stat_arr = '<?php echo json_encode($status_arr) ?>';
			stat_arr = JSON.parse(stat_arr);
		details.find('.drange').text(date_from+" to "+date_to )
		if(status>-1)
		details.find('.status-field').text(stat_arr[status])
		ns.append(details)

		ns.append(content)
		var nw = window.open('','','height=700,width=900')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)

	})*/
</script>