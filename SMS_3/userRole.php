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
	 <script src="jquery-1.9.1.min.js" type="text/javascript"></script>
	<script>
	
     window.flag = false;
	 $(document).ready(loadTable);
	 $(Main);
	 function Main(){
			$("#btn1").click(function(){
				if(flag == false){
					var user = $("#user").val();
					var role = $("#role").val();
					var data = {"action": "insertur", "user": user, "role": role};
					var sett = {
						type: "POST",
						dataType: "json",
						url: "urapi.php",
						data:data,
						success: function(res){
							if(res){
								alert("Data insert successfully");
								$(loadTable);
							}
							else
								alert("Data don't insert successfully");
						},
						error: function(err, type, httpStatus){
							alert("Some Error Has Occured");
						}
					};
					$.ajax(sett);
					return false;
				}
			});
	 }
	
	function loadTable(){
		var $table = $("#div2");
		$table.empty();
		$table.append("<tr><td> ID </td><td> User </td> <td> Role </td><td> Edit </td><td> Delete </td></tr>");
		 var data = {"action": "getallur"};
		 var setti = {
				type: "POST",
				dataType: "json",
				url: "urapi.php",
				data:data,
				success:function(res){
					for (var i = 0; i < res.data.length; i++){
						var obj = res.data[i];
						var $tr = $("<tr>");
						
						$td = $("<td>");
						$td.text(obj.id);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.userid);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.roleid);
						$tr.append($td);
						
						$td = $("<td>");
						var $button = $("<button>");
						$button.text("Edit");
						$button.attr("id", obj.id);
						$td.append($button);
						$tr.append($td);
						
						$td = $("<td>");
						var $button1 = $("<button>");
						$button1.text("Delete");
						$button1.attr("id", obj.id);
						$td.append($button1);
						$tr.append($td);
						
						$table.append($tr);
						
						$button1.bind("click", function (obj, e) {
                        var $isConfirm = confirm("Record will be deleted. Click Ok to continue and Cancel to Ignore");
                        if ($isConfirm == true) {
							$(this).closest("tr").remove();
							var id = $(this).attr("id");
							var data = {"action": "deleteur", "id": id};
							var set = {
								type: "POST",
								dataType: "json",
								url: "urapi.php",
								data:data,
								success: function(res){
									if (res)
										alert("Data deleted successfully");
									else
										alert("Data don't deleted successfully");
								},
								error: function(err, type, httpStatus){
									alert("Some Error Has Occured");
								}
							};
							$.ajax(set);
							//return false;
                        }
						else
							return false;
						
                    });
					$button.bind("click", function(){
						flag = true;
						var id = $(this).attr("id");
						var data = {"action": "editur", "id": id};
						var settin = {
							type: "POST",
							dataType: "json",
							url: "urapi.php",
							data:data,
							success: function(res){
								$("#user").val(res.userid);
								$("#role").val(res.roleid);
								flag = true;
				
								$("#btn1").click(function(){
									if(flag == true){
									var ad = 0;
									var user = $("#user").val();
									var role = $("#role").val();
									var data = {"action": "edit", "id": id, "user": user, "role": role};
									var settingss = {
										type: "POST",
										dataType: "json",
										url: "urapi.php",
										data:data,
										success: function(res1){
										if (res1)
											alert("Data Updated successfully");
										else
											alert("Data don't Updated successfully");
										},
										error: function(err, type, httpStatus){
											alert("Data Updated successfully");
										}
									};
									$.ajax(settingss);
									}
								});
							},
							error: function(err, type, httpStatus){
								alert("Some Error Has Occured");
							}
						};
						$.ajax(settin);		
					});
					}
				},
				error: function(err, type, httpStatus){
					alert("Some Error Has Occured");
				}
		 };
		 $.ajax(setti);
		return false;
	}
	</script>
   </head>
<body>
    <div id="bar">
        <a href="home.php">Home</a>
        <a href="Users.php">User Management</a>
        <a href="Roles.php">Role Management</a>
        <a href="Permissions.php">Permission Management</a>
        <a href="RolePermission.php">Role-Permission Management</a>
        <a href="userRole.php">User-Role Management</a>
		 <a href="loginHistory.php">Login History</a>
        <a href="login.php">log out</a>
    </div>

    <div class="div1">
        <h1 style="color:white;font-family:Verdana; background-color:black">Role Permission Management </h1>
        <form>
             User:<select name="txt1" id="user" required>
			<option value="" selected>--Select--</option>
			<?php
			
				$sql = "SELECT * FROM Users";
				$result = mysqli_query($conn, $sql);
				$recordsFound = mysqli_num_rows($result);					
				if ($recordsFound > 0){
			
					while($row = mysqli_fetch_assoc($result)) {	
						$id=$row["userid"];
						$name=$row["name"];
						echo "<option value='$id'>$name</option>";
				}	
			}
			?></select>
            <br><br>
            Role:<select name="txt2" id="role" required>
			<option value="" selected>--Select--</option>
			<?php
			
				$sql1 = "SELECT * FROM roles";
				$result1 = mysqli_query($conn, $sql1);
				$recordsFound1 = mysqli_num_rows($result1);					
				if ($recordsFound1 > 0){
			
					while($row1 = mysqli_fetch_assoc($result1)) {	
						$id=$row1["roleid"];
						$name=$row1["name"];
						echo "<option value='$id'>$name</option>";
				}	
			}
			?></select>
            <br><br>
            <input type="submit" name = "btn1" id="btn1" value="Save">
        </form>
    </div>
    <div>
         <table id="div2" border="2" style= "background-color: white; color: black; margin: 0 auto;" ></table>

    </div>



</body>
</html>