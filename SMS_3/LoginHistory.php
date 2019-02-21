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
<body >

    <div id="bar">
        <a href="Home.php">Home</a>
        <a href="Users.php">User Management</a>
        <a href="Roles.php">Role Management</a>
        <a href="Permissions.php">Permission Management</a>
        <a href="RolePermission.php">Role-Permission Management</a>
        <a href="userRole.php">User-Role Management</a>
		<a href="loginhistory.php">Login History</a>
        <a href="login.php">log out</a>
    </div>
	
	 <br><br>
      <?php
			require('conn.php');
			$result = mysqli_query($conn, "SELECT * FROM loginhistory");
      ?>
	  
	   <form>
      <table border="2" style= "background-color: white; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>User ID</th>
		   <th>Login</th>
          <th>Login Time</th>
		   <td><b>Machine IP</b></td>
        </tr>
      </thead>
	   <tbody>
	   <?php
	    while( $row = mysqli_fetch_assoc( $result ) ){
			 echo
            "<tr>
              <td>{$row['userid']}</td>
              <td>{$row['login']}</td>
              <td>{$row['logintime']}</td>
			  <td>{$row['machineip']}</td>
              </tr>\n";
		}
		?>
		  <?php mysqli_close($conn); ?>
		  </form>
	</body>
</html>