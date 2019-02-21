<?php
     require('conn.php');
	 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
<style>
html, body {
text-align: center;
}
p {text-align: left;}

body {
	margin: 0;
	padding: 0;
	background:black;
	text-align: left;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 17px;
	color:black;
	background-color:#C0C0C0;
}
*
{
  margin: 0 auto 0 auto;
 text-align:left;}

#page
{
  margin: 0 auto 0 auto; 
  margin-top:25px;
  display: block; 
  height:auto;
  position: relative; 
  overflow: hidden; 
  background: 	#C0C0C0;
  width: 738px;
}

#header
{
background-repeat:no-repeat;
height:111px;
width:738px;
}

#headerTitle
{
position:relative;
left:30px;
top:30px;
color: 	#C0C0C0;
text-align:left;
font-size:34px;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
}

#headerSubText
{
position:relative;
left:33px;
top:30px;
color:#679159;
text-align:left;
font-size:16px;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
}


#bar
{
background-color:black;
background-repeat:no-repeat;
height:55px;
width:1320px;
line-height:55px;
padding-left:20px;
padding-right:20px;
}

#bar a
{
font-size:13px;
font-weight:bold;
color:#FBFDFB;
margin-left:28px;
margin-right:28px;
}

#bar a:hover
{
color:#C7E0C2;
}



.contentTitle
{
width:676px;
height:37px;
margin-top:20px;
margin-left:25px;
margin-right:25px;
background-repeat:no-repeat;

}

.contentTitle h1
{
margin-left:21px;
padding-top:8px;
font-size:17px;
font-weight:bold;
color:#071027;
}

.comments
{
font-size:11px;
font-style:italic;
}

.contentText
{
width:680px;
padding-left:30px;
padding-right:30px;
font-size:13px;
color:#030712;
line-height:30px;
}

a
{
text-decoration:none;
color:#152413;
}

a:hover
{
color:#597A41;
}

</style>
</head>
<body>
  <div id="bar">
		<?php
				$var =$_COOKIE['admin'];
				if($var == 1){
		?>
        	<a href="home.php">Home</a>
            <a href="Users.php">User Management</a>
            <a href="Roles.php">Role Management</a>
            <a href="Permissions.php">Permission Management</a>
            <a href="RolePermission.php">Role-Permission Management</a>
            <a href="userRole.php">User-Role Management</a>
			<a href="loginhistory.php">Login History</a>
            <a href="login.php">log out</a>
			<h1 style = "text-align: center;">
				<b>Welcome Admin!</b>
			</h1>
				<?php }
				else{
					?>
				<a href="home.php">Home</a>	
				<a href="login.php">log out</a>
				<br><br>
				<div style="background-color:white; height: 500px; width: 40%;">
				<h1 style = "text-align: center; background-color:black; color:white">
					<b>Welcome User!</b>
				</h1>
				<ol>
				<?php  
					$id = $_SESSION['userid'];
					$sql = "Select * from user_role where userid = '".$id."'";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_assoc($result)){
				?>
				<?php
					$role = $row['roleid'];
					$sql2 = "select * from roles where roleid = '".$role."'";
					$result2 = mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					?>
					<li><?php echo "Role: " .$row2['name'];
					}
				?></li>
				</ol>
				<h1 style = "background-color:black; color:white;"> <b> Permissions: </b> </h1>
						<?php
						$sql = "Select * from user_role where userid = '".$id."'";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)){
							$role = $row['roleid'];
							$sql1 = "Select * from role_permission where roleid = '".$role."'";
							$result1 = mysqli_query($conn, $sql1);
							while($row1 = mysqli_fetch_assoc($result1)){
								$per = $row1['permissionid'];
								$sql3 = "select * from permissions where permissionid = '".$per."'";
								$result3 = mysqli_query($conn, $sql3);
								$row3 = mysqli_fetch_assoc($result3);
								echo $row3['name'];
								echo "   ,  ";
							}
						}
				}
				?>
				</div>
      </div>


</body>
</html>
