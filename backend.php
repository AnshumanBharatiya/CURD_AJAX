<?php

$conn = mysqli_connect('localhost','root','','ajax');

extract($_POST);

//display record
if(isset($_POST['readrecord']))
{
	$data='<table class="table table-striped table-hover">
			<tr>
			 	<th>sl no.</th>
			 	<th>Firstname</th>
			 	<th>Lastname</th>
			 	<th>Email Address</th>
			 	<th>Mobile Number</th>
			 	<th>Edit Data</th>
			 	<th>Delete Data</th>
			</tr>';
			$sql1="select * from curd ";

			$result=mysqli_query($conn,$sql1);

			if(mysqli_num_rows($result)>0)
			{
				$number=1;
				while($row = mysqli_fetch_array($result))
				{
					$data .='<tr>
				 				<td>'.$number.'</td>
				 				<td>'.$row['firstname'].'</td>
				 				<td>'.$row['lastname'].'</td>
				 				<td>'.$row['email'].'</td>
				 				<td>'.$row['mobile'].'</td>
				 				<td>
				 					<button class="btn btn-sm btn-warning" onclick="updateRecord('.$row['id'].')">Edit</button>
				 				</td>
				 				<td>
				 					<button class="btn btn-sm btn-danger" onclick="deleteRecord('.$row['id'].')">Delete</button>
				 				</td>
							</tr>';		
					$number++;
				}
			}
	$data .= '</table>';
		echo $data;
}
//insert record
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']) )
{
	$sql="INSERT INTO `curd`(`firstname`, `lastname`, `email`, `mobile`) VALUES('$firstname','$lastname','$email','$mobile')";
	mysqli_query($conn,$sql);
}

//delete record

if(isset($_POST['deleteid']))
{
	$userid=$_POST['deleteid'];
	$deletequery="delete from curd where id='$userid'";
	mysqli_query($conn,$deletequery);
}

// get user id for update
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
	$user_id = $_POST['id'];
	$query = "select * from curd where id='$user_id'";
	if(!$result = mysqli_query($conn,$query))
	{
		exit(mysqli_error());
	}
	$response=array();
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result)) 
		{
			$response=$row;
		}
	}
	else
	{
		$response['status']=200;
		$response['message']="Record not found ! ";
	}
	echo json_encode($response);
}
else
{
	$response['status']=200;
	$response['message']="Invalid Request !";	
}
//update record
if(isset($_POST['hidden_id']))
{
	$hidden_id=$_POST['hidden_id'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$e_mail=$_POST['e_mail'];
	$mob=$_POST['mob'];
	$updatequery="update curd set firstname='$fname',lastname='$lname',email='$e_mail',mobile='$mob' where id='$hidden_id' ";
	mysqli_query($conn,$updatequery);
}
?>