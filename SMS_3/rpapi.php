<?php
     require('conn.php'); ?>
	
	<?php
		if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if ($action == "insertper"){
				$per = $_REQUEST['per'];
				$des = $_REQUEST['des'];
				$date = date('Y-m-d H:i:s');
				$num = 0;
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
					$sql = "insert into role_permission (roleid, permissionid)values ('$per','$des')";
					$result = mysqli_query($conn, $sql);
					if($result)
						$temp = true;
				}
				echo json_encode($temp);
			}
			else if ($action == "getallpers"){
				$sql = "Select * from role_permission";
				$result = mysqli_query ($conn, $sql);
				$recordFound = mysqli_num_rows($result);
				$results = array();
				if($recordFound > 0){
					while ($row = mysqli_fetch_assoc($result)){
						$per = $row['roleid'];
						$des = $row['permissionid'];
						$s = "Select * from roles where roleid = '$per.'";
						$q = "Select * from permissions where permissionid = '$des'";
						$r = mysqli_query($conn, $s);
						$re = mysqli_query($conn, $q);
						$row1 = mysqli_fetch_assoc($r);
						$row2 = mysqli_fetch_assoc($re);
						$row['roleid'] = $row1['name'];
						$row['permissionid'] = $row2['name'];
						$results[] = $row;
					}
				}
				$output["data"] = $results;
				echo json_encode($output);
			}
			else if ($action == "deleteper"){
				$id = $_REQUEST['id'];
				$sql = "delete from role_permission where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				if($result)
					$temp = true;
				else
					$temp = false;
				echo json_encode($temp);	
			}
			else if ($action == "editper"){
				$id = $_REQUEST['id'];
				$sql = "Select * from role_permission where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				echo json_encode($row);
			}
			else if ($action == "edit"){
				$role = $_REQUEST['role'];
				$des = $_REQUEST['des'];
				$id = $_REQUEST['roleid'];
				/*$s = "Select * from roles where name = '$role.'";
				$q = "Select * from permissions where name = '$des'";
				$r = mysqli_query($conn, $s);
				$re = mysqli_query($conn, $q);
				$row1 = mysqli_fetch_assoc($r);
				$row2 = mysqli_fetch_assoc($re);
				$role = $row1['roleid'];
				$des = $row2['permissionid'];*/
				$sql = "update role_permission set roleid = '$role', permissionid = '$des' where id = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$temp = false;
				if($result)
					$temp = true;
				echo json_encode($result1);
			}
		}
	?>