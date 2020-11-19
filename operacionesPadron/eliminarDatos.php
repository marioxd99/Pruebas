<?php 
	$conex=mysqli_connect("localhost","root","mario","registro");
	$id=$_POST['id'];

	$sql="DELETE from padron where id='$id'";
	echo $result=mysqli_query($conex,$sql);
 ?>