<?php
     require('conn.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 	 ?>
	
	<?php
		if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if ($action == "insertrole"){
				$role = $_REQUEST['role'];
				$des = $_REQUEST['des'];
				$date = date('Y-m-d H:i:s');
				
				$num = $_COOKIE['id'] ;
				$flag = true;
				$s = "select name from roles";
				$r = mysqli_query($conn, $s);
				while($res = mysqli_fetch_assoc($r)){
					if ($res['name'] == $role){
						$flag = false;
					}
				}
				$temp = false;
				if($flag){
					$sql = "insert into roles (name, description, createdon, createdby)values ('$role','$des','$date','$num')";
					$result = mysqli_query($conn, $sql);
					if($result)
						$temp = true;
				}
				echo json_encode($temp);
			}
			else if ($action == "getallroles"){
				$sql = "Select * from roles";
				$result = mysqli_query ($conn, $sql);
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
			else if ($action == "deleterole"){
				$id = $_REQUEST['id'];
				$sql = "delete from roles where roleid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				if($result)
					$temp = true;
				else
					$temp = false;
				echo json_encode($temp);	
			}
			else if ($action == "editrole"){
				$id = $_REQUEST['id'];
				$sql = "Select * from roles where roleid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				echo json_encode($row);
			}
			else if ($action == "edit"){
				$role = $_REQUEST['role'];
				$des = $_REQUEST['des'];
				$id = $_REQUEST['roleid'];
				$sql = "update roles set name = '$role', description = '$des' where roleid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$temp = false;
				if($result)
					$temp = true;
				echo json_encode($result1);
			}
		}
	?>