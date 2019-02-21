 <?php
     require('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #787878;
        }

        .div1 {
            background-color: white;
            padding: 10px;
            margin: 50px 40px;
            border: 50px black;
            border-radius: 5px;
            height: 500px;
            width: 300px;
            text-align: center;
        }

        .box {
            width: 280px;
            height: 30px;
            background-color: white;
        }

        html, body {
            text-align: center;
        }

        p {
            text-align: left;
        }

        body {
            margin: 0;
            padding: 0;
            background: black;
            text-align: left;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 17px;
            color: black;
            background-color: #C0C0C0;
        }

        * {
            margin: 0 auto 0 auto;
            text-align: left;
        }

        #page {
            margin: 0 auto 0 auto;
            margin-top: 25px;
            display: block;
            height: auto;
            position: relative;
            overflow: hidden;
            background: #C0C0C0;
            width: 738px;
        }

        #header {
            background-repeat: no-repeat;
            height: 111px;
            width: 738px;
        }

        #headerTitle {
            position: relative;
            left: 30px;
            top: 30px;
            color: #C0C0C0;
            text-align: left;
            font-size: 34px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        #headerSubText {
            position: relative;
            left: 33px;
            top: 30px;
            color: #679159;
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }


        #bar {
            background-color: black;
            background-repeat: no-repeat;
            height: 55px;
            width: 1320px;
            line-height: 55px;
            padding-left: 20px;
            padding-right: 20px;
        }

            #bar a {
                font-size: 13px;
                font-weight: bold;
                color: #FBFDFB;
                margin-left: 28px;
                margin-right: 28px;
            }

                #bar a:hover {
                    color: #C7E0C2;
                }



        .contentTitle {
            width: 676px;
            height: 37px;
            margin-top: 20px;
            margin-left: 25px;
            margin-right: 25px;
            background-repeat: no-repeat;
        }

            .contentTitle h1 {
                margin-left: 21px;
                padding-top: 8px;
                font-size: 17px;
                font-weight: bold;
                color: #071027;
            }

        .comments {
            font-size: 11px;
            font-style: italic;
        }

        .contentText {
            width: 680px;
            padding-left: 30px;
            padding-right: 30px;
            font-size: 13px;
            color: #030712;
            line-height: 30px;
        }

        a {
            text-decoration: none;
            color: #152413;
        }

            a:hover {
                color: #597A41;
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
        <a href="userRoleManagementList.php">User-Role Management</a>
        <a href="login.php">log out</a>
    </div>

    <div class="div1">
        <h1 style="color:white;font-family:Verdana; background-color:black">User Management </h1>
		<?php
			$temp = $_SESSION['unq'];
				if ($temp == -1){
		?>
        <form>
            <br> <br><input id="userid" name = 'txt1' class="box" type="text" placeholder="Enter User Name" required>
            <br><br>
            <input id="password" name = 'txt2' class="box" type="password" placeholder="Enter Password" required>
            <br><br>
            <input id="username" name = 'txt3' class="box" type="text" placeholder="Enter Name" required>
            <br><br>
            <input id="email" name = 'txt4' class="box" type="email" placeholder="Enter Email" required>
            <br><br>
            Country:<select name="txt5" id="cmbCountries" required>
			 <option value="" selected>--Select--</option>
			<?php
			
				$sql = "SELECT * FROM COUNTRY";
				$result = mysqli_query($conn, $sql);
				$recordsFound = mysqli_num_rows($result);					
				if ($recordsFound > 0){
			
					while($row = mysqli_fetch_assoc($result)) {	
						$id=$row["id"];
						$name=$row["name"];
						echo "<option value='$id'>$name</option>";
				}	
			}
			?></select>
            <br><br>
			<input type="checkbox" name="admin" value="isadmin">isAdmin<br>
			<br>
            <input type="submit" id="btn1" name = "btn1" value="Save">
            <input type="reset" id="btn2" name = "btn2"  value="Clear">
			<?php	
					$num = $_SESSION['userid'];
					$btn = isset($_REQUEST['btn1']);
					if($btn){
						$ad = 0;
						$user = $_REQUEST['txt1'];
						$pwd = $_REQUEST['txt2'];
						$name = $_REQUEST['txt3'];
						$email = $_REQUEST['txt4'];
						$country = $_REQUEST['txt5'];
						$var = isset($_REQUEST['admin']);
						if($var)
							$ad = 1;
						$date = date('Y-m-d H:i:s');
						$flag = true;
						$s = "select login, email from users";
						$r = mysqli_query($conn, $s);
						while($res = mysqli_fetch_assoc($r)){
							if ($res['login'] == $user ){
									echo "<script type='text/javascript'>alert('User name already exits');</script>";
									$flag = false;
							}
								else if ($res['email'] == $email){
									echo "<script type='text/javascript'>alert('Email id already exits');</script>";
									$flag = false;
								}
						}
						if($flag){
							$sql = "insert into users (login, password, name, email, countryid, createdon, createdby, isadmin) values ('$user', '$pwd', '$name', '$email', '$country', '$date', '$num','$ad')";
							$result = mysqli_query($conn, $sql);
							if($result)
								echo "<script type='text/javascript'>alert('Data inserted successfully');</script>";
							else
								echo "<script type='text/javascript'>alert('Data doesn't inserted successfully');</script>";
							echo '<script type="text/javascript">window.location = "userList.php" </script>';
						}
					}					
				}
				else{
					$sql = "SELECT * FROM USERS where userid = '".$temp."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$temp1 = $row['countryid'];
					$sql1 = "SELECT * FROM COUNTRY";
					$result1 = mysqli_query($conn, $sql1);
					$sql2 = "SELECT * FROM COUNTRY where id =  '".$temp1."'";
					$result2 = mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					$temp1 = $row2['id'];
					$temp2 = $row2['name'];
					?>
					<form>
						<br>Login:<input id="userid" name = 'txt1' class="box" type="text" value="<?php echo( htmlspecialchars( $row['login'] ) ); ?>" required>
						<br><br>
						Password:<input id="password" name = 'txt2' class="box" type="text" value="<?php echo( htmlspecialchars( $row['password'] ) ); ?>" required>
						<br><br>
						User Name:<input id="username" name = 'txt3' class="box" type="text" value="<?php echo( htmlspecialchars( $row['name'] ) ); ?>" required>
						<br><br>
						Email:<input id="email" name = 'txt4' class="box" type="email" value="<?php echo( htmlspecialchars( $row['email'] ) ); ?>" required>
						<br><br>			
						Country:<select name="txt5" id="cmbCountries">
						<?php 
							while($row1 = mysqli_fetch_assoc($result1)) {	
								$id=$row1["id"];
								$name=$row1["name"];
								if($id == $temp1 && $name == $temp2)
								{
										echo "<option value='$id' selected>$name</option>";
								}
								else
									echo "<option value='$id'>$name</option>";
							}
							
						?></select>
						<br>
						<?php 
							$temp3 =  $row['isadmin'];
							if($temp3 == 1){
						?>
						<input type="checkbox" name="admin" value="isadmin" checked>isAdmin<br>
							<?php } 
							else{
							?>
							<input type="checkbox" name="admin" value="isadmin">isAdmin<br>
							<?php } ?>
						<br>
						<input type="submit" id="btn1" name = "btn1" value="Save">
						<input type="reset" id="btn2" name = "btn2"  value="Clear">
						<?php
							$temp4 = isset($_REQUEST['btn1']);
							if ($temp4){
								$ad = 0;
								$user = $_REQUEST['txt1'];
								$pwd = $_REQUEST['txt2'];
								$name = $_REQUEST['txt3'];
								$email = $_REQUEST['txt4'];
								$country = $_REQUEST['txt5'];
								$var = isset($_REQUEST['admin']);
								if($var)
									$ad = 1;
								$sql3 = "update users set login = '$user', password = '$pwd', name = '$name', email = '$email', countryid = '$country', isadmin = '$ad' where userid = '".$temp."' ";
								$result3 = mysqli_query($conn, $sql3);
								if($result3)
									echo "<script type='text/javascript'>alert('Data updated successfully');</script>";
								else
									echo "<script type='text/javascript'>alert('Data doesn't updated successfully');</script>";
									echo '<script type="text/javascript">window.location = "userList.php" </script>';
							
							}
						
						?>
					</form>
			<?php			
				}
			?>
        </form>
    </div>
	<?php
		mysqli_close($conn);
	?>
</body>
</html>