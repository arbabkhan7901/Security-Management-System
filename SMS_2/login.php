<html>
<head>
    <title> Login </title>
	<style>
	
	fieldset {
		width: 0px;
	}
	</style>
    <body>
	 <h2> Security Manager </h2>
        <form method = "post">
		
		  <fieldset>
           <h1 style="color:white;background-color:black; width: 250">Login</h1>
            Login: <input type='text' name='txt1' id = 'txt1'/><br/><br/>
            Password: <input type='password' name='txt2' size = 17 id = 'txt2' /><br/><br/>
			
           <input type='submit' name='btn1' id = 'btn1' value='Login'/>
		 <?php require('conn.php'); ?>
            <?php
				$btn = isset($_POST['btn1']);
				$flag = true;
				if ($btn){
					if($_POST["txt1"] == "" ||  $_POST["txt2"] == ""){
						echo "<script type='text/javascript'>alert('Fill all Fields!');</script>";
					}
					else{
						$var = $_POST["txt1"];
						$var1 = $_POST["txt2"];
						$sql = "SELECT * FROM USERS where login = '".$var."' and password = '".$var1."'";
						$result = mysqli_query($conn, $sql);
						$recordsFound = mysqli_num_rows($result);
						if ($recordsFound == 0){
							echo "<script type='text/javascript'>alert('Wrong Username or password!');</script>";
						}
						else{
							$row = mysqli_fetch_assoc( $result );
							$_SESSION['userid'] = $row['userid'];
							$_SESSION['admin'] = $row['isadmin'];
							
							$id = $row['userid'];
							$login = $row['login'];
							$date = date('Y-m-d H:i:s');
							$ip = $_SERVER['REMOTE_ADDR'];
							$sql = "insert into loginhistory (userid, login, logintime, machineip)values ('$id','$login','$date', '$ip')";
							$result = mysqli_query($conn, $sql);
							Header('Location:home.php');
						}
					}
				}
            ?>
					  </fieldset>
        </form>

    </body>

</head>
</html>