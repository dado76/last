<html>
	<head>
		<title>Gestion des BOM</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="../dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			    <link rel="stylesheet" type="text/css" href="../assets/plugins/fontawesome-free-5.4.1-web/css/all.min.css">
		<style>
			body
			{
				margin:0;
				pAjoutering:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:90%;

				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
		  <header class="w3-container" style="padding-top:22px">

  </header>
 <center>

  <div class="w3-row-padding w3-margin-bottom">


      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
        <div class="w3-right">

        </div>
        <div class="w3-clear"></div>
  <h2> Gestion des BOM </h2>
      </div>
	</div>


<?php include('../bilanbom.php'); ?>


			<br />
			<div class="table-responsive">
				<br />
				<div align="center">
					<button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn"><i class="fa fa-plus"></i> Ajouter</button>
    		<a onclick="javascript:window.print()"><button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn"><i class="fa fa-print"></i> Imprimer</button></a>
			<a href="baliseExport.php" target="_parent"><button type="button" href="baliseExport.php" class="btn btn-success btn"><i class="fa fa-file-excel"></i> Export</button></a>
  <?php


	?>



	<style>
	   /*****TABLEAUUU****/
	   table {
	       font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	       border-collapse: collapse;

	   }

	   table tr:nth-child(even){background-color: #f2f2f2;}

	   table tr:hover {background-color: #F7F8E0;}

	   table th {
	background-color: #2196F3;
	color: white;
	   }

	</style>

				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Document</th>
							<th width="10%">Codification</th>
							<th width="10%">immatriculation</th>
							<th width="10%">secteur</th>
						   <th width="10%">Cubage</th>
							<th width="10%">ptac</th>
							<th width="10%">statut</th>
							<th width="10%">marque_LC</th>
							<th width="10%">Remplace</th>
							<th width="10%">Modifier</th>
							<th width="10%">Supprimer</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Ajouter une bom</h4>
				</div>
				<div class="modal-body">
					<label>Codification</label>
					<input type="text" name="codification" id="codification" class="form-control" />
					<br />
					<label>immatriculation</label>
					<input type="text" name="immatriculation" id="immatriculation" class="form-control" />
					<br />
					<label>secteur</label>
					<input type="text" name="secteur" id="secteur" class="form-control" />
					<br />
					<label>Cubage</label>
					<input type="text" name="cubage" id="cubage" class="form-control" />
					<br />
					<label>PTAC</label>
					<input type="text" name="ptac" id="ptac" class="form-control" />
					<br />
					<label>Statut</label>
					<select type="text" name="statut" id="statut" class="form-control">

							<option>EN SERVICE</option>
						 <option>REFORME</option>
							 <option>SAV</option>
								 <option>EN STOCK</option>
							 </select>
					<br />
					<label>marque_LC</label>
					<input type="text" name="marque_lc" id="marque_lc" class="form-control" />
					<br />
					<label>remplace</label>
						<input type="text" name="remplace" id="remplace" class="form-control" />


					<br />


					<label>Selection du document</label>
					<input type="file" name="user_image" id="user_image" />
			<input type="image" src="../test.jpg" height="30" width="30"/>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Ajouter" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#Add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Ajouter BOM");
		$('#action').val("Ajouter");
		$('#operation').val("Ajouter");
		$('#user_uploaded_image').html('');
	});

	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,],
				"orderable":false,
			},
		],

	});



	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#codification').val();
		var lastName = $('#immatriculation').val();
		var secteur = $('#secteur').val();
		var cubage = $('#cubage').val();
		var ptac = $('#ptac').val();
	var statut = $('#statut').val();
		var marque_lc = $('#marque_lc').val();
		var remplace = $('#remplace').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['pdf','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#user_image').val('');
				return false;
			}
		}
		if(firstName != '' && lastName != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Tous les champs sont requis");
		}
	});

	$(document).on('click', '.Modifier', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#codification').val(data.codification)  ;
				$('#immatriculation').val(data.immatriculation);
				$('#secteur').val(data.secteur);
				$('#cubage').val(data.cubage);
				$('#ptac').val(data.ptac);
				$('#statut').val(data.statut);
				$('#marque_lc').val(data.marque_lc);
				$('#remplace').val(data.remplace);
				$('.modal-title').text("Modifier bom");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Modifier");
				$('#operation').val("Modifier");
			}
		})
	});


	$(document).on('click', '.Supprimer', function(){
		var user_id = $(this).attr("id");
		if(confirm("Etes vous sur de vouloir supprimer?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;
		}
	});


});
</script>
