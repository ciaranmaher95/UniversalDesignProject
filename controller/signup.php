<?php 

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");


if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['usertype'];

if($type == "amatuer") {
	
	$userType = 0;
}
else {
	
	$userType = 1;
}

$getUsers =  pg_query($db_connection, "select email,username,password from member;");

$result = pg_fetch_all($getUsers); 

$users = array();

for($i = 0; $i < sizeof($result); $i++)
{
	if($username == $result[$i]['username'])
	{
		array_push($users,$email);
	}
	if($email == $result[$i]['email'])
	{
		
		array_push($users,$username);
	}
	if($password == $result[$i]['password'])
	{
		array_push($users,$password);
	}
}

if(sizeof($users) > 0)
{
	header("location:../view/signup_login.php?$users[0]_$users[1]_$users[2]");
}
else
{
	pg_query($db_connection, "insert into member(full_name,email,username,password,usertype) values('$name','$email','$username','$password','$userType')");
	$getid = pg_fetch_all(pg_query($db_connection, "select member_id from member where username='$username'"));
	$id = $getid[0]['member_id'];
	
	header("location:../view/home.php?loggedin=$id");
}




?>