

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
            height: 460px;
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
    <script src="SecurityManager.js"></script>
    <script>
        function Main() {
            var tableRef = document.getElementById("div2");
            tableRef.style.width = '800px';
            tableRef.style.border = '0px solid black';

            var u_arr = SecurityManager.GetAllUsers();

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
                        newText = document.createTextNode(u_arr[i].name);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 2) {
                        newText = document.createTextNode(u_arr[i].email);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 3) {
                        var newText = document.createElement('a');
                        newText.id = u_arr[i].ID;
                        newText.href = "#";
                        newText.innerHTML = "edit";
                        newText.onclick = function () {
                            var edit_user = SecurityManager.GetUserById(this.id);
                            document.getElementById("userid").value = edit_user.login;
                            document.getElementById("password").value = edit_user.pswd;
                            document.getElementById("username").value = edit_user.name;
                            document.getElementById("email").value = edit_user.email;
                            document.getElementById('cmbCountries').value = edit_user.cntry;
                            var c = document.getElementById('cmbCities');
                            var city_arr = SecurityManager.GetCitiesByCountryId(edit_user.cntry);
                            c.innerHTML = '';
                            for (var i = 0; i < city_arr.length; i++) {
                                if (city_arr[i].CityID == edit_user.city) {
                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", city_arr[i].CityID);
                                    opt.innerText = city_arr[i].Name;
                                    c.appendChild(opt);
                                    break;
                                }
                            }
                            for (var i = 0; i < city_arr.length; i++) {
                                if (city_arr[i].CityID != edit_user.city) {
                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", city_arr[i].CityID);
                                    opt.innerText = city_arr[i].Name;
                                    c.appendChild(opt);
                                }
                            }
                            var sBtn = document.getElementById("btn1");
                            sBtn.onclick = function () {
                                edit_user.login = document.getElementById("userid").value;
                                edit_user.pswd = document.getElementById("password").value;
                                edit_user.name = document.getElementById("username").value;
                                edit_user.email = document.getElementById("email").value;
                                edit_user.cntry = document.getElementById('cmbCountries').value;
                                edit_user.city = document.getElementById('cmbCities').value;
                                SecurityManager.SaveUser(edit_user, function () { alert("user has been edited") }, function () { alert("user has not been edited") });
                                window.location.href = "UserMangement.php";
                            };
                        }
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
                                SecurityManager.DeleteUser(this.id, function () { alert("Record Deleted"); }, function () {alert("Record can not deleted");});
				window.location.href = "UserMangement.php";
                            }
                            location.reload(true);
                        }
                    }
                    newCell.appendChild(newText);
                }
            }
            var countries = SecurityManager.GetCountries();
            var cmb = document.getElementById('cmbCountries')
            for (var i = 0; i < countries.length; i++) {
                var opt = document.createElement("option");
                opt.setAttribute("value", countries[i].CountryID);
                opt.innerText = countries[i].Name;
                cmb.appendChild(opt);
            }
            cmb.onchange = function () {
                var citycmb = document.getElementById('cmbCities');
                //Remove all child elements (e.g. options)
                citycmb.innerHTML = '';
                var cities = SecurityManager.GetCitiesByCountryId(cmb.value);
                for (var i = 0; i < cities.length; i++) {
                    var opt = document.createElement("option");
                    opt.setAttribute("value", cities[i].CityID);
                    opt.innerText = cities[i].Name;
                    citycmb.appendChild(opt);
                }
            }//end of onchange
            var save_btn = document.getElementById("btn1");
            save_btn.onclick = function () {
                var log = document.getElementById("userid").value;
                var psw = document.getElementById("password").value;
                var name = document.getElementById("username").value;
                var mail = document.getElementById("email").value;
                var ctr = document.getElementById('cmbCountries').value;
                var cit = document.getElementById('cmbCities').value;

                var userObj = {};
                userObj.login = log;
                userObj.pswd = psw;
                userObj.email = mail;
                userObj.name = name;
                userObj.cntry = ctr;
                userObj.city = cit;
                var flag = true;
                if (!userObj.login || !userObj.pswd || !userObj.name || !userObj.email || !userObj.cntry || !userObj.city) {
                    alert("fill all the fields");
                    flag = false;
                } else {
                    var user_arr = SecurityManager.GetAllUsers();
                    for (var i in user_arr) {
                        if (user_arr[i].login == log) {
                            alert("User already exists");
                            flag = false;
                        }
                        else {
                            if (user_arr[i].email == mail) {
                                alert("User already exists");
                                flag = false;
                            }
                        }
                    }
                }
                if (flag == true) {
                    SecurityManager.SaveUser(userObj, function () { alert("user has been created") }, function () { alert("user has not been created") });
                    var table = document.getElementById("div2");
                    table.style.width = '800px';
                    table.style.border = '0px solid black';
                    var row = table.insertRow(table.rows.length);
                    var cell1 = row.insertCell(0);
                    var t1 = document.createTextNode(userObj.ID);
                    cell1.appendChild(t1);
                    cell1.style.border = '1px solid black';
                    var cell2 = row.insertCell(1);
                    var t2 = document.createTextNode(userObj.login);
                    cell2.appendChild(t2);
                    cell2.style.border = '1px solid black';
                    var cell3 = row.insertCell(2);
                    var t3 = document.createTextNode(userObj.email);
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
        }//end ofMain
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
        <h1 style="color:white;font-family:Verdana; background-color:black">User Management </h1>
        <form>
            <br> <br><input id="userid" class="box" type="text" placeholder="Enter User Name" required>
            <br><br>
            <input id="password" class="box" type="password" placeholder="Enter Password" required>
            <br><br>
            <input id="username" class="box" type="text" placeholder="Enter Name" required>
            <br><br>
            <input id="email" class="box" type="email" placeholder="Enter Email" required>
            <br><br>
            Country:<select name="" id="cmbCountries"></select>
            <br><br>
            City:<select name="" id="cmbCities"></select>
            <br><br>
            <input type="submit" id="btn1" value="Save">
            <input type="reset" id="btn2" value="Clear">
        </form>

    </div>
    <div>
        <table id="div2"></table>

    </div>



</body>
</html>