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
    <script src="SecurityManager.js"></script>
    <script>
        function Main() {
            var tableRef = document.getElementById("div2");
            tableRef.style.width = '800px';
            tableRef.style.border = '0px solid black';
            var u_arr = SecurityManager.GetAllUserRoles();
            for (var i = 0; i < u_arr.length; i++) {
                var newRow = tableRef.insertRow(i);
                for (var j = 0; j < 5; j++) {
                    var newCell = newRow.insertCell(j);
                    var newText = "";
                    if (j == 0) {
                        newText = document.createTextNode(u_arr[i].ID);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 1) {
                        newText = document.createTextNode(u_arr[i].role);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 2) {
                        newText = document.createTextNode(u_arr[i].name);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 3) {
                        var newText = document.createElement('a');
                        newText.id = u_arr[i].ID;
                        newText.href = "#";
                        newText.innerHTML = "edit";
                        newText.onclick = function () {
                            var edit_user = SecurityManager.GetUserRoleById(this.id);
                            document.getElementById("role").value = edit_user.role;
                            document.getElementById("permission").value = edit_user.name;
                            var sBtn = document.getElementById("btn1");
                            sBtn.onclick = function () {
                                edit_user.role = document.getElementById("role").value;
                                edit_user.name = document.getElementById("permission").value;
                                SecurityManager.SaveUserRole(edit_user, function () { alert("user has been edited") }, function () { alert("user has not been edited") });
                                window.location.href = "UserRoleManagement.html";
                            };
                        };
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 4) {
                       var newText = document.createElement('a');
                        newText.id = u_arr[i].ID;
                        newText.innerHTML = "delete";
                        newCell.style.border = '1px solid black';
                        newText.onclick = function () {
                            var agree = confirm("Do you want to delete the selected record ?");
                            if (agree) {
                                SecurityManager.DeleteUserRole(this.id, function () { alert("Record Deleted"); }, function () { alert("Record can not deleted"); });
                                window.location.href = "RoleMangement.php";
                            }
                            location.reload(true);
                        }
                    }
                    newCell.appendChild(newText);
                }
            }
            var role = SecurityManager.GetAllRoles();
            var cmb = document.getElementById('role')
            for (var i = 0; i < role.length; i++) {
                var opt = document.createElement("option");
                opt.setAttribute("value", role[i].role);
                opt.innerText = role[i].role;

                cmb.appendChild(opt);
            }


            var per = SecurityManager.GetAllUsers();
            var cmb = document.getElementById('permission')
            for (var i = 0; i < per.length; i++) {
                var opt = document.createElement("option");
                opt.setAttribute("value", per[i].name);
                opt.innerText = per[i].name;
                cmb.appendChild(opt);
            }
            var save_btn = document.getElementById("btn1");
            save_btn.onclick = function () {
                var role = document.getElementById("role").value;
                var des =  document.getElementById("permission").value;
                var userObj = {};
                userObj.role = role;
                userObj.name = des;
                var flag = true;
                if (!userObj.role || !userObj.name) {
                    alert("fill all the fields");
                    flag = false;
                }

                if (flag == true) {
                    SecurityManager.SaveUserRole(userObj, function () { alert("user has been created") }, function () { alert("user has not been created") });
                    var table = document.getElementById("div2");
                    table.style.width = '800px';
                    table.style.border = '0px solid black';
                    var row = table.insertRow(table.rows.length);
                    var cell1 = row.insertCell(0);
                    var t1 = document.createTextNode(userObj.ID);
                    cell1.appendChild(t1);
                    cell1.style.border = '1px solid black';
                    var cell2 = row.insertCell(1);
                    var t2 = document.createTextNode(userObj.role);
                    cell2.appendChild(t2);
                    cell2.style.border = '1px solid black';
                    var cell3 = row.insertCell(2);
                    var t3 = document.createTextNode(userObj.name);
                    cell3.appendChild(t3);
                    cell3.style.border = '1px solid black';
                    var cell4 = row.insertCell(3);
                    var t4 = document.createTextNode('a');
                    cell4.appendChild(t4);
                    cell4.innerHTML = "edit";
                    cell4.href = "#";
                    cell4.style.border = '1px solid black';
                    var cell5 = row.insertCell(4);
                    var t5 = document.createTextNode('a');
                    cell5.appendChild(t5);
                    cell5.innerHTML = "delete";
                    cell5.href = "#";
                    cell5.style.border = '1px solid black';
                }
                return false;
            };
        }
    </script>
</head>
<body onload="Main();">

    <div id="bar">
        <a href="AdminHome.php">Home</a>
        <a href="UserManagement.php">User Management</a>
        <a href="RoleManagement.php">Role Management</a>
        <a href="PermissionManagement.php">Permission Management</a>
        <a href="RolePermission.php">Role-Permission Management</a>
        <a href="userRoleManagement.php">User-Role Management</a>
        <a href="login.php">log out</a>
    </div>


    <div class="div1">
        <h1 style="color:white;font-family:Verdana;background-color: black"> User Role Management </h1>
        <form>
            Role:<select name="" id="role"></select>
            <br><br>
            User:<select name="" id="permission"></select>
            <br><br>
            <input type="submit" id="btn1" value="Save">
        </form>

    </div>
    <div>
        <table id="div2"></table>

    </div>






</body>
</html>