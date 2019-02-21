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
            height: 250px;
            width: 400px;
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
        <a href="userRoleList.php">User-Role Management</a>
		<a href="loginhistory.php">Login History</a>
        <a href="login.php">log out</a>
    </div>


    <div class="div1">
        <h1 style="color:white;font-family:Verdana;background-color: black"> Role Permission Management </h1>
		<?php
			$temp = $_SESSION['unq3'];
				if ($temp == -1){
		?>
        <form>
            Role:<select name="txt1" id="role" required>
			<option value="" selected>--Select--</option>
			<?php
			
				$sql = "SELECT * FROM ROLES";
				$result = mysqli_query($conn, $sql);
				$recordsFound = mysqli_num_rows($result);					
				if ($recordsFound > 0){
			
					while($row = mysqli_fetch_assoc($result)) {	
						$id=$row["roleid"];
						$name=$row["name"];
						echo "<option value='$id'>$name</option>";
				}	
			}
			?></select>
            <br><br>
            Permission:<select name="txt2" id="permission" required>
			<option value="" selected>--Select--</option>
			<?php
			
				$sql1 = "SELECT * FROM permissions";
				$result1 = mysqli_query($conn, $sql1);
				$recordsFound1 = mysqli_num_rows($result1);					
				if ($recordsFound1 > 0){
			
					while($row1 = mysqli_fetch_assoc($result1)) {	
						$id=$row1["permissionid"];
						$name=$row1["name"];
						echo "<option value='$id'>$name</option>";
				}	
			}
			?></select>
            <br><br>
            <input type="submit" id="btn1" name = "btn1" value="Save">
        </form>
		<?php
			$btn = isset($_REQUEST['btn1']);
			if($btn){
				$per = $_REQUEST['txt1'];
				$des = $_REQUEST['txt2'];
				$sql = "insert into role_permission (roleid, permissionid)values ('$per','$des')";
				$result = mysqli_query($conn, $sql);
				if($result)
					echo "<script type='text/javascript'>alert('Data inserted successfully');</script>";
				else
					echo "<script type='text/javascript'>alert('Data doesn't inserted successfully');</script>";
				echo '<script type="text/javascript">window.location = "rolepermissionList.php" </script>';
			}
				}
				else{
					$sql = "SELECT * FROM role_permission where id = '".$temp."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$temp1 = $row['roleid'];
					$sql1 = "SELECT * FROM ROLES";
					$result1 = mysqli_query($conn, $sql1);
					$sql2 = "SELECT * FROM ROLES where roleid =  '".$temp1."'";
					$result2 = mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					$temp1 = $row2['roleid'];
					$temp2 = $row2['name'];
					$temp3 = $row['permissionid'];
					$sql2 = "SELECT * FROM Permissions";
					$result2 = mysqli_query($conn, $sql2);
					$sql3 = "SELECT * FROM Permissions where permissionid =  '".$temp3."'";
					$result3 = mysqli_query($conn, $sql3);
					$row3 = mysqli_fetch_assoc($result3);
					$temp4 = $row3['permissionid'];
					$temp5 = $row3['name'];
					
					
			?>
			<form>
            Role:<select name="txt1" id="role">
			<?php 
							while($row1 = mysqli_fetch_assoc($result1)) {	
								$id=$row1["roleid"];
								$name=$row1["name"];
								if($id == $temp1 && $name == $temp2)
								{
										echo "<option value='$id' selected>$name</option>";
								}
								else
									echo "<option value='$id'>$name</option>";
							}
							
						?></select>
            <br><br>
            Permission:<select name="txt2" id="permission">
			<?php 
							while($row4 = mysqli_fetch_assoc($result2)) {	
								$id=$row4["permissionid"];
								$name=$row4["name"];
								if($id == $temp4 && $name == $temp5)
								{
										echo "<option value='$id' selected>$name</option>";
								}
								else
									echo "<option value='$id'>$name</option>";
							}
							
						?></select>
            <br><br>
            <input type="submit" id="btn1" name = "btn1" value="Save">
			<?php
				$temp1 = isset($_REQUEST['btn1']);
				if($temp1){
					$user = $_REQUEST['txt1'];
					$des = $_REQUEST['txt2'];
					$sql1 = "update role_permission set roleid = '$user', permissionid = '$des' where id = '".$temp."'";
					$result1 = mysqli_query($conn, $sql1);
					
					if($result1)
						echo "<script type='text/javascript'>alert('Data updated successfully');</script>";
					else
						echo "<script type='text/javascript'>alert('Data doesn't updated successfully');</script>";
					echo '<script type="text/javascript">window.location = "rolepermissionList.php" </script>';
					
				}
				}
			?>
			</form>
			
    </div>
</body>
</html>