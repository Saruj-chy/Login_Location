<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

	if( isset($_POST['username']) && isset($_POST['password']) ){
	    isset($_POST['username']) ? $username = $_POST['username'] : $username = '' ;
	    isset($_POST['password']) ? $password = $_POST['password'] : $password = '' ;
	}else{
	    exit() ;
	}

// $username = $_POST['username'] ;
// $password= $_POST['password'] ;


}

require_once('dbConnect.php');
mysqli_query($conn,'SET CHARACTER SET utf8');
mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");


$r = getAllUser($conn,  $username, $password);


  while($row=$r->fetch_array(MYSQLI_ASSOC)){
   $specificUser = $row ;
 }


 $response = array();
 $response['user_exist'] = (count($specificUser)>0);
 $response['data'] = $specificUser ;

 echo json_encode($response) ;


 function getAllUser($conn, $username, $password){
  $sql = "SELECT * FROM `user_check` WHERE `username`= '$username' AND `password`= '$password' " ;
  $r = mysqli_query($conn,$sql) ;
  return $r ;
 }

 mysqli_close($conn) ;
 ?>
