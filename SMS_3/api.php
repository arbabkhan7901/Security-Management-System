<?php
     require('conn.php');
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  
		if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if($action == "getcities"){
				$countryid = $_REQUEST["countryid"];
				$sql = "Select id, name from city where countryid = '$countryid'";
				
				$result = mysqli_query($conn, $sql);
				$recordFound = mysqli_num_rows($result);
				$results = array();
				if($recordFound > 0){
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
				}
				$output["data"] = $results;
				echo json_encode($output);
			}
			else if ($action == "insertuser"){
				$user = $_REQUEST['id'];
				$pwd = $_REQUEST['pwd'];
				$name = $_REQUEST['username'];
				$email = $_REQUEST['email'];
				$country = $_REQUEST['cntry'];
				$city = $_REQUEST['city'];
				$ad = $_REQUEST['admin'];
				$num = $_COOKIE['id'] ;
				$date = date('Y-m-d H:i:s');
				$flag = true;
				$s = "select login, email from users";
				$r = mysqli_query($conn, $s);
				while($res = mysqli_fetch_assoc($r)){
					if ($res['login'] == $user || $res['email'] == $email){
						$flag = false;
					}
				}
				$temp = false;
				if($flag){
					$sql = "insert into users (login, password, name, email, countryid, createdon, createdby, isadmin, cityid) values ('$user', '$pwd', '$name', '$email', '$country', '$date', '$num','$ad', '$city')";
					$result = mysqli_query($conn, $sql);
					if($result)
						$temp = true;
				}
				echo json_encode($temp);
			}
			else if ($action == "getallusers"){
				$sql = "Select * from users";
				$result = mysqli_query ($conn, $sql);
				$recordFound = mysqli_num_rows($result);
				$results = array();
				if($recordFound > 0){
					while ($row = mysqli_fetch_assoc($result)){
						$ctry = $row['countryid'];
						$city = $row['cityid'];
						$q="Select * from country where id = '".$ctry."'";
						$coun = mysqli_query($conn, $q);
						$d = mysqli_fetch_assoc($coun);
						$s = "Select * from city where id = '".$city."'";
						$coun1 = mysqli_query($conn, $s);
						$d1 = mysqli_fetch_assoc($coun1);
						$row['countryid'] = $d['name'];
						$row['cityid'] = $d1['name'];
						if($row['isadmin'] == 1)
							$row['isadmin'] = "Yes";
						else
							$row['isadmin'] = "No";
						$results[] = $row;
					}
				}
				$output["data"] = $results;
				echo json_encode($output);
			}
			else if ($action == "deleteuser"){
				$id = $_REQUEST['id'];
				$sql = "delete from users where userid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				if($result)
					$temp = true;
				else
					$temp = false;
				echo json_encode($temp);	
			}
			else if ($action == "edituser"){
				$id = $_REQUEST['id'];
				$sql = "Select * from users where userid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				echo json_encode($row);
			}
			else if ($action == "edit"){
				$user = $_REQUEST['id'];
				$pwd = $_REQUEST['pwd'];
				$name = $_REQUEST['username'];
				$email = $_REQUEST['email'];
				$country = $_REQUEST['cntry'];
				$city = $_REQUEST['city'];
				$ad = $_REQUEST['admin'];
				$id = $_REQUEST['usersid'];
				$sql1 = "update users set login = '$user', password = '$pwd', name = '$name', email = '$email', countryid = '$country' ,isadmin = '$ad' where userid = '".$id."' ";
				$result1 = mysqli_query($conn, $sql1);
				echo json_encode($result1);
			}
		}
	?>