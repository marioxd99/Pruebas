<?php 

	$conex=mysqli_connect("localhost","root","mario","registro");
	$id=$_POST['id'];
	$edades=$_POST['edades'];
	$castilla=$_POST['CastillaLaMancha'];
	$albacete=$_POST['Albacete'];
	$ciudadreal=$_POST['CiudadReal'];
	$cuenca=$_POST['Cuenca'];
	$guadalajara=$_POST['Guadalajara'];
	$toledo=$_POST['Toledo'];

    $sql="UPDATE padron SET edades='$edades',
								CastillaLaMancha='$castilla',Albacete='$albacete',CiudadReal='$ciudadreal',
								Cuenca='$cuenca',Guadalajara='$guadalajara',Toledo='$toledo'
				WHERE id='$id'";
	echo $result=mysqli_query($conex,$sql);

 ?>