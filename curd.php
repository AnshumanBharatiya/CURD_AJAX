<!-- CURD OPERATION USING AJAX  
	urd.php , backend.php, -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CURD USING AJAX</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container p-5">

		<h1 class="text-info text-center text-uppercase">ajax curd opeartion</h1><hr>
		
		<div class="d-flex justify-content-end">
			<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal">Insert Record
			</button>
		</div>
		<div>
			<h2 class="text-info">ALL RECORDS</h2>
			<div id="record_contant">

			</div>	
		</div>
		<!-- insert modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog  modal-dialog-centered"><!--  modal-dialog-scrollable"> -->
			    <div class="modal-content">
				    <div class="modal-header">
				        <h4 class="modal-title text-uppercase text-info">Insert Record</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
				    <div class="modal-body">
				      	<div class="form-group">
				      		<label for="firstname">First Name:</label>
				      		<input type="text" name="firstname" id="firstname" autocomplete="off" class="form-control" placeholder="Enter First Name">
				      	</div>
				      	<div class="form-group">
				      		<label for="lastname">Last Name:</label>
				      		<input type="text" name="lastname" id="lastname"  autocomplete="off" class="form-control" placeholder="Enter Last Name">
				      	</div>
				      	<div class="form-group">
				      		<label for="email">Email Id:</label>
				      		<input type="email" name="email" id="email" autocomplete="off" class="form-control" placeholder="Enter Email Id">
				      	</div>
				      	<div class="form-group">
				      		<label for="mobile">Mobile Number:</label>
				      		<input type="text" name="mobile" id="mobile" autocomplete="off" class="form-control" placeholder="Enter Mobile Number">
				      	</div>
				        
				    </div>
				    <div class="modal-footer">
				      	<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="addRecord()">Save
				      	</button>
				        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			</div>
		</div>
		<!-- update modal  -->
		<div class="modal fade" id="update_user_modal">
				<div class="modal-dialog  modal-dialog-centered"><!--  modal-dialog-scrollable"> -->
				    <div class="modal-content">
					    <div class="modal-header">
					        <h4 class="modal-title text-uppercase text-info">Update Record</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					    </div>
					    <div class="modal-body">
					      	<div class="form-group">
					      		<label for="update_firstname">First Name:</label>
					      		<input type="text" name="" id="update_firstname" class="form-control">
					      	</div>
					      	<div class="form-group">
					      		<label for="update_lastname">Last Name:</label>
					      		<input type="text" name="" id="update_lastname"  class="form-control">
					      	</div>
					      	<div class="form-group">
					      		<label for="update_email">Email Id:</label>
					      		<input type="email" name="" id="update_email" class="form-control">
					      	</div>
					      	<div class="form-group">
					      		<label for="update_mobile">Mobile Number:</label>
					      		<input type="text" name="" id="update_mobile" class="form-control">
					      	</div>
					        
					    </div>
					    <div class="modal-footer">
					      	<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="updateDetails()">Update
					      	</button>
					        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
					        <input type="hidden" name="" id="hidden_user_id">
					    </div>
				    </div>
				</div>
			</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
			// display record
		$(document).ready(function(){
			readRecords();

		});
	
		function readRecords()
		{
			var  readrecord = "readrecord";
			$.ajax({
				url:'backend.php',
				type:'post',
				data:{readrecord:readrecord},
				success:function(data,status){
					$('#record_contant').html(data);
					
				}
			});
		}

// insert record
		function addRecord()
		{
			var firstnames = $('#firstname').val();
			var lastnames = $('#lastname').val();
			var emails = $('#email').val();
			var mobiles = $('#mobile').val();
			$.ajax({
				url:'backend.php',
				type:'post',
				data:{
					firstname:firstnames,
					lastname:lastnames,
					email:emails,
					mobile:mobiles
				},success:function(data,status){
					readRecords();
				}
			});
		}
		// delete record

		function deleteRecord(deleteid)
		{
			var conf = confirm("Are you want to delete record?");
			if(conf == true)
			{
				$.ajax({
					url:'backend.php',
					type:'post',
					data:{deleteid:deleteid},
					success:function(data,status){
						readRecords();
					}
				})
			}
		}
		//update record
		function updateRecord(id)
		{
			$('#hidden_user_id').val(id);
			$.post('backend.php',{id:id},function(data,status)
			{
				var obj = JSON.parse(data);
				$('#update_firstname').val(obj.firstname);
				$('#update_lastname').val(obj.lastname);
				$('#update_email').val(obj.email);
				$('#update_mobile').val(obj.mobile);

			});
		$('#update_user_modal').modal("show");

		}
		function updateDetails()
		{
			var fname=$('#update_firstname').val();
			var lname=$('#update_lastname').val();
			var e_mail=$('#update_email').val();
			var mob=$('#update_mobile').val();
			var hidden_id=$('#hidden_user_id').val();
			$.ajax({
				url:'backend.php',
				type:'post',
				data:{
					hidden_id:hidden_id,
					fname:fname,
					lname:lname,
					e_mail:e_mail,
					mob:mob
				},success:function(data,status){
					$('#update_user_modal').modal("hide");
					readRecords();
				}
			});
		}
	</script>
	
</body>
</html>
