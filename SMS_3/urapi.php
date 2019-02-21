<?php
     require('conn.php'); ?>
	
	<?php
		if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if ($action == "insertur"){
				$user = $_REQUEST['user'];
				$role = $_REQUEST['role'];
				$flag = true;
				/*$s = "select login, email from users";
				$r = mysqli_query($conn, $s);
				while($res = mysqli_fetch_assoc($r)){
					if ($res['login'] == $user ){
						//echo "Username already exits";
						$flag = false;
					}
					else if ($res['email'] == $email){
						//echo "Email id already exits";
						$flag = false;
					}
				}*/
				if($flag){
					$temp = false;
					$sql = "insert into user_role (userid, roleid)values ('$user','$role')";
					$result = mysqli_query($conn, $sql);
					if($result)
						$temp = true;
				}
				echo json_encode($temp);
			}
			else if ($action == "getallur"){
				$sql = "Select * from user_role";
				$result = mysqli_query ($conn, $sql);
				$recordFound = mysqli_num_rows($result);
				$results = array();
				if($recordFound > 0){
					while ($row = mysqli_fetch_assoc($result)){
						$user = $row['userid'];
						$role = $row['roleid'];
						$s = "Select * from users where userid = '$user'";
						$q = "Select * from roles where roleid = '$role'";
						$r = mysqli_query($conn, $s);
						$re = mysqli_query($conn, $q);
						$row1 = mysqli_fetch_assoc($r);
						$row2 = mysqli_fetch_assoc($re);
						$row['userid'] = $row1['name'];
						$row['roleid'] = $row2['name'];
						$results[] = $row;
					}
				}
				$output["data"] = $results;
				echo json_encode($output);
			}
			else if ($action == "deleteur"){
				$id = $_REQUEST['id'];
				$sql = "delete from user_role where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				if($result)
					$temp = true;
				else
					$temp = false;
				echo json_encode($temp);	
			}
			else if ($action == "editur"){
				$id = $_REQUEST['id'];
				$sql = "Select * from user_role where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				echo json_encode($row);
			}
			else if ($action == "edit"){
				$role = $_REQUEST['role'];
				$user = $_REQUEST['user'];
				$id = $_REQUEST['id'];
				$sql = "update user_role set roleid = '$role', userid = '$user' where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$temp = false;
				if($result)
					$temp = true;
				echo json_encode($result1);
			}
		}
	?>