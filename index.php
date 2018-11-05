<html>
	<head>
		<title>Webslesson Demo - PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			    <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome-free-5.4.1-web/css/all.min.css">
		<style>
			body
			{
				margin:0;
				pAjoutering:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				pAjoutering:20px;
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
    <h5><b><i class="fa fa-dashboard"></i> Tableau de bords</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">


      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Balise</h4>
      </div>
	</div>


<?php include('bilanbom.php'); ?>

		
			<br />
			<div class="table-responsive">
				<br />
				<div align="center">
					<button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-md "><i class="fa fa-plus"></i> Ajouter</button>
    		<a href="http://www.google.com" target="_parent"><button type="button" id="Ajouter_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-md "><i class="fa fa-print"></i> Imprimer</button></a>
			<a href="http://www.google.com" target="_parent"><button type="button" href="export.php" class="btn btn-success  btn-md "><i class="fa fa-file-excel"></i> Export</button></a>
    
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Document</th>
							<th width="10%">Codification</th>
							<th width="10%">Balise</th>	
							<th width="10%">Carte sims</th>
						    <th width="10%">N°Téléphone</th>
							<th width="10%">ID et Port</th>
							<th width="10%">Immatriculation</th>
							<th width="10%">Statut</th>
							<th width="10%">RFID</th>
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
		
					<h4 class="modal-title">Ajouter une balise</h4>
				</div>
				<div class="modal-body">
					<label>Codification</label>
					<input type="text" name="codification" id="codification" class="form-control" />
					<br />
					<label>Balise</label>
					<input type="text" name="balise" id="balise" class="form-control" />
					<br />
					<label>Carte Sim</label>
					<input type="text" name="sim" id="sim" class="form-control" />
					<br />
					<label>N°Téléphone</label>
					<input type="text" name="telephone" id="telephone" class="form-control" />
					<br />
					<label>ID et Port</label>
					<input type="text" name="idport" id="idport" class="form-control" />
					<br />
					<label>Immatriculation</label>
					<input type="text" name="immatriculation" id="immatriculation" class="form-control" />
					<br />
					<label>Statut</label>
					<input type="text" name="statut" id="statut" class="form-control" />
					<br />
					<label>Selection du document</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
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
		$('.modal-title').text("Ajouter Balise");
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
		var lastName = $('#balise').val();
		var sim = $('#sim').val();
		var telephone = $('#telephone').val();
		var idport = $('#idport').val();
		var immatriculation = $('#immatriculation').val();
		var statut = $('#statut').val();
		var rfid = $('#rfid').val();
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
				$('#codification').val(data.codification);
				$('#balise').val(data.balise);
				$('#sim').val(data.sim);
				$('#telephone').val(data.telephone);
				$('#idport').val(data.idport);
				$('#immatriculation').val(data.immatriculation);
				$('#statut').val(data.statut);
				$('#rfid').val(data.balise);
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
				url:"Supprimer.php",
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