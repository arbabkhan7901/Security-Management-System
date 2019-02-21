<?php
     require('conn.php'); 
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } ?>
	
	<?php
		if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if ($action == "insertper"){
				$per = $_REQUEST['per'];
				$des = $_REQUEST['des'];
				$date = date('Y-m-d H:i:s');
				$num = $_COOKIE['id'] ;
				$flag = true;
				$s = "select name from permissions";
				$r = mysqli_query($conn, $s);
				while($res = mysqli_fetch_assoc($r)){
					if ($res['name'] == $per ){
						//echo "Username already exits";
						$flag = false;
					}	
				}
				$temp = false;
				if($flag){
					$sql = "insert into permissions (name, description, createdon, createdby)values ('$per','$des','$date','$num')";
					$result = mysqli_query($conn, $sql);
					if($result)
						$temp = true;
				}
				echo json_encode($temp);
			}
			else if ($action == "getallpers"){
				$sql = "Select * from permissions";
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
			else if ($action == "deleteper"){
				$id = $_REQUEST['id'];
				$sql = "delete from permissions where permissionid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				if($result)
					$temp = true;
				else
					$temp = false;
				echo json_encode($temp);	
			}
			else if ($action == "editper"){
				$id = $_REQUEST['id'];
				$sql = "Select * from permissions where permissionid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				echo json_encode($row);
			}
			else if ($action == "edit"){
				$role = $_REQUEST['role'];
				$des = $_REQUEST['des'];
				$id = $_REQUEST['roleid'];
				$sql = "update permissions set name = '$role', description = '$des' where permissionid = '".$id."'";
				$result = mysqli_query($conn, $sql);
				$temp = false;
				if($result)
					$temp = true;
				echo json_encode($result1);
			}
		}
	?>