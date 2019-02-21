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
					var role = $("#role").val();
					var des = $("#des").val();
					var data = {"action": "insertrole", "role": role, "des": des};
					var sett = {
						type: "POST",
						dataType: "json",
						url: "roleapi.php",
						data:data,
						success: function(res){
							if(res == true){
								alert("Data insert successfully");
								$(loadTable);
							}
							else if (res == false)
								alert("Role already exits");
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
		$table.append("<tr><td> Role id </td><td> Role</td> <td> Description </td> <td> Created on </td><td> Created by </td><td> Edit </td><td> Delete </td></tr>");
		 var data = {"action": "getallroles"};
		 var setti = {
				type: "POST",
				dataType: "json",
				url: "roleapi.php",
				data:data,
				success:function(res){
					for (var i = 0; i < res.data.length; i++){
						var obj = res.data[i];
						var $tr = $("<tr>");
						
						$td = $("<td>");
						$td.text(obj.roleid);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.name);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.description);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.createdon);
						$tr.append($td);
						
						$td = $("<td>");
						$td.text(obj.createdby);
						$tr.append($td);
						
						$td = $("<td>");
						var $button = $("<button>");
						$button.text("Edit");
						$button.attr("id", obj.roleid);
						$td.append($button);
						$tr.append($td);
						
						$td = $("<td>");
						var $button1 = $("<button>");
						$button1.text("Delete");
						$button1.attr("id", obj.roleid);
						$td.append($button1);
						$tr.append($td);
						
						$table.append($tr);
						
						$button1.bind("click", function (obj, e) {
                        var $isConfirm = confirm("Record will be deleted. Click Ok to continue and Cancel to Ignore");
                        if ($isConfirm == true) {
							$(this).closest("tr").remove();
							var id = $(this).attr("id");
							var data = {"action": "deleterole", "id": id};
							var set = {
								type: "POST",
								dataType: "json",
								url: "roleapi.php",
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
						var data = {"action": "editrole", "id": id};
						var settin = {
							type: "POST",
							dataType: "json",
							url: "roleapi.php",
							data:data,
							success: function(res){
								$("#role").val(res.name);
								$("#des").val(res.description);
								flag = true;
				
								$("#btn1").click(function(){
									if(flag == true){
									var ad = 0;
									var role = $("#role").val();
									var des = $("#des").val();
									var data = {"action": "edit", "roleid": id, "role": role, "des": des};
									var settingss = {
										type: "POST",
										dataType: "json",
										url: "roleapi.php",
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
        <h1 style="color:white;font-family:Verdana; background-color:black">Role Management </h1>
        <form>
             <br><input id="role" name = "txt1" type="text" class="box" placeholder="Role Name" required>
            <br><br>
            <input id="des" name = "txt2" type="text" class="box" placeholder="Description" required>
            <br><br>
            <input type="submit" id="btn1" name = "btn1" value="Save">
        </form>
    </div>
    <div>
         <table id="div2" border="2" style= "background-color: white; color: black; margin: 0 auto;" ></table>

    </div>



</body>
</html>