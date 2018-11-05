<html>
	<head>
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
        <div class="w3-left"><i class="fa fa-map-marker w3-xxxlarge"></i></div>
        <div class="w3-right">

        </div>
        <div class="w3-clear"></div>
  <h2> Gestion des radios </h2>
      </div>
	</div>


<?php include('../bilanradio.php'); ?>


			<br />
			<div class="table-responsive">
				<br />
				<div align="center">
					<button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn"><i class="fa fa-plus"></i> Ajouter</button>
    		<a onclick="javascript:window.print()"><button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn"><i class="fa fa-print"></i> Imprimer</button></a>
			<a href="radioExport.php" target="_parent"><button type="button" href="radioExport.php" class="btn btn-success btn"><i class="fa fa-file-excel"></i> Export</button></a>
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

   }

</style>

				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Document</th>
							<th width="10%">numero_appel</th>
							<th width="10%">codification</th>
							<th width="10%">numero de serie</th>
						    <th width="10%">Type</th>
							<th width="10%">Statut</th>
							<th width="10%">Modele</th>
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

					<h4 class="modal-title">Ajouter une radio</h4>
				</div>
				<div class="modal-body">
					<label>Numéro d'appel</label>
					<input type="text" name="numero_appel" id="numero_appel" class="form-control" />
					<br />
					<label>Codification</label>
					<input type="text" name="codification" id="codification" class="form-control" />
					<br />
					<label>numero de série</label>
					<input type="text" name="numero_serie" id="numero_serie" class="form-control" />
					<br />
					<label>Type</label>
					<input type="text" name="type" id="type" class="form-control" />
					<br />
					<label>Statut</label>
					<select type="text" name="statut" id="statut" class="form-control">

							<option>EN SERVICE</option>
						 <option>REFORME</option>
							 <option>SAV</option>
								 <option>EN STOCK</option>
					</select>
					<label>Modele</label>
					<input type="text" name="modele" id="modele" class="form-control" />
					<br />


					<label>Selection du document</label>
					<input type="file" name="user_image" id="user_image" />
			<input type="image" src="test.jpg" height="30" width="30"/>
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
		$('.modal-title').text("Ajouter radio");
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
		var numero_appel = $('#numero_appel').val();
		var codification = $('#codification').val();
		var numero_serie = $('#numero_serie').val();
		var type = $('#type').val();
		var statut = $('#statut').val();
		var modele = $('#modele').val();
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
		if(numero_appel != '' && codification != '')
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
				$('#numero_appel').val(data.numero_appel);
				$('#codification').val(data.codification)  ;
				$('#numero_serie').val(data.numero_serie);
				$('#type').val(data.type);
				$('#statut').val(data.statut);
				$('#modele').val(data.modele);

				$('.modal-title').text("Modifier Carte sims");
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
