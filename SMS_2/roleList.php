<!doctype html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Role List</title>
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
        	<a href="home.php">Home</a>
            <a href="UserList.php">User Management</a>
            <a href="RoleList.php">Role Management</a>
            <a href="PermissionList.php">Permission Management</a>
            <a href="RolePermissionList.php">Role-Permission Management</a>
            <a href="userRoleList.php">User-Role Management</a>
			<a href="loginhistory.php">Login History</a>
            <a href="login.php">log out</a>
      </div>
	  <br><br>
      <?php
     require('conn.php');

      $result = mysqli_query($conn, "SELECT * FROM roles ");
      ?>
	  <form>
      <table border="2" style= "background-color: white; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Role ID</th>
		   <th>Name</th>
          <th>Description</th>
          <th>Created On</th>
          <th>Created By</th>
		   <td><b>Edit</b></td>
		  <td><b>Delete</b></td>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
			  $var = $row['roleid'];
            echo
            "<tr>
              <td>{$row['roleid']}</td>
              <td>{$row['name']}</td>
              <td>{$row['description']}</td>
              <td>{$row['createdon']}</td>
              <td>{$row['createdby']}</td>
			  <td><button type='submit' value='$var' name='edit'> Edit </button></td>
			   <td><button type='submit' value='$var' name='delete'> Delete </button> </td>
              </tr>\n";
          }
		 $btn = isset($_GET['edit']);
		 $btn1 = isset($_GET['delete']);
		 if ($btn == true){
			$id = $_REQUEST['edit'];
			$_SESSION['unq1'] = $id;
			echo '<script type="text/javascript">window.location = "RoleManagement.php" </script>';
		 }
		 if ($btn1){
			 $id = $_REQUEST['delete'];
			 $sql1 = "delete from roles where roleid = '".$id."'";
			 $result1 = mysqli_query($conn, $sql1);
			 if($result1)
				 echo "<script type='text/javascript'>alert('Data deleted successfully');</script>";
			 else
				 echo "<script type='text/javascript'>alert('Data doesn't deleted successfully');</script>";
			 echo '<script type="text/javascript">window.location = "roleList.php" </script>';
			 }
        ?>
      </tbody>
    </table>
	
	  <input type='submit' name='btn3' value='Create new Role' style= "position:absolute; left:420px;">
	  <?php
		$btn2 = isset($_GET['btn3']);
		 if ($btn2 == true){
			  $_SESSION['unq1'] = -1;
			echo '<script type="text/javascript">window.location = "RoleManagement.php" </script>';
			 
		 }
	  ?>
     <?php mysqli_close($conn); ?>
	 </form>
    </body>
    </html>