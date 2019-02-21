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
            height: 300px;
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
        <a href="userRoleList.php">User-Role Management</a>
		<a href="loginhistory.php">Login History</a>
        <a href="login.php">log out</a>
    </div>


    <div class="div1">
        <h1 style="color:white;font-family:Verdana;background-color: black"> Permission Management </h1>
		<?php
			$temp = $_SESSION['unq2'];
				if ($temp == -1){
		?>
        <form>
            <br><input id="role" type="text" name = "txt1" class="box" placeholder="Permission Name" required>
            <br><br>
            <input id="des" type="text" class="box" name = "txt2" placeholder="Description" required>
            <br><br>

            <input type="submit" id="btn1" name = "btn1" value="Save">
        </form>
		<?php
			$num = $_SESSION['userid'];
			$btn = isset($_REQUEST['btn1']);
			if($btn){
				$per = $_REQUEST['txt1'];
				$des = $_REQUEST['txt2'];
				$date = date('Y-m-d H:i:s');
				$flag = true;
				$s = "select name from permissions";
				$r = mysqli_query($conn, $s);
				while($res = mysqli_fetch_assoc($r)){
					if ($res['name'] == $per ){
						echo "<script type='text/javascript'>alert('Permission already exits');</script>";
						$flag = false;
					}
				}
				if($flag){
					$sql = "insert into permissions (name, description, createdon, createdby)values ('$per','$des','$date','$num')";
					$result = mysqli_query($conn, $sql);
					if($result)
						echo "<script type='text/javascript'>alert('Data inserted successfully');</script>";
					else
						echo "<script type='text/javascript'>alert('Data doesn't inserted successfully');</script>";
					echo '<script type="text/javascript">window.location = "permissionList.php" </script>';
				}
			}
				}
				else{
					$sql = "SELECT * FROM Permissions where permissionid = '".$temp."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
			?>
			<form>
            <br>Permission:<input id="role" name = "txt1" type="text" class="box" value="<?php echo( htmlspecialchars( $row['name'] ) ); ?>" required>
            <br><br>
            Description:<input id="des" name = "txt2" type="text" class="box" value="<?php echo( htmlspecialchars( $row['description'] ) ); ?>" required>
            <br><br>
            <input type="submit" id="btn1" name = "btn1" value="Save">
			<?php
				$temp1 = isset($_REQUEST['btn1']);
				if($temp1){
					$user = $_REQUEST['txt1'];
					$des = $_REQUEST['txt2'];
					$sql1 = "update permissions set name = '$user', description = '$des' where permissionid = '".$temp."'";
					$result1 = mysqli_query($conn, $sql1);
					
					if($result1)
						
						echo "<script type='text/javascript'>alert('Data updated successfully');</script>";
					else
						echo "<script type='text/javascript'>alert('Data doesn't updated successfully');</script>";
					echo '<script type="text/javascript">window.location = "permissionList.php" </script>';
					
				}
				}
			?>
        </form>		

    </div>
</body>
</html>