

<html>
<head>

    <title> login Page </title>
    <script src="SecurityManager.js"></script>
    <script>
        function Main() {
            var btn = document.getElementById('btn1');
            btn.onclick = function () {
                var login = document.getElementById('txt1').value;
                var pwd = document.getElementById('txt2').value;
                var result = SecurityManager.ValidateAdmin(login, pwd);
                if (result == true) {
                    window.location = "AdminHome.php";
                }
                else {
                    alert("Invalid user Name or password");
                }
                return false;
            }
            var btn1 = document.getElementById('btn2');
            btn1.onclick = function () {
                var login = document.getElementById('txt3').value;
                var pwd = document.getElementById('txt4').value;
                if (!login || !pwd) {
                    alert("fill all the fields");
                }
                else {
                    var res = SecurityManager.GetAllUsers();
                    var flag = true;
                    var i = 0;
                    for (var k in res) {
                        if (res[k].login == login && res[k].pswd == pwd) {
                            flag = false;
                            i = k;
                        }
                    }
                    if (!flag) {
                        var v = res[i].login;
                        localStorage["userID"] = v;
                        window.location = "HomeScreen.php";
                    }
                    if (flag) {
                        alert("Invalid user Name or password");
                    }
                }
                return false;
            }
        }
    </script>
</head>

<body onload="Main();">
    <h1> Secuirty Manager </h1>
    <table style="width:40%" , border="1">
        <tr>

            <th style="color:white;background-color:black">Login Admin</th>
            <th style="color:white;background-color:black">Login User</th>

        </tr>
        <tr>
            <form>
                <td>
                    Username:<br><input type="text" id="txt1" required /><br><br>
                    Password:<br><input type="password" id="txt2" required /><br><br>
                    <button style="height:30px;width:100px" id="btn1">Login</button>

                </td>
            </form>
            <form>
                <td>
                    Username:<br><input type="text" id="txt3" required /><br><br>
                    Password:<br><input type="password" id="txt4" required /><br><br>
                    <button style="height:30px;width:100px" id="btn2">Login</button>
                </td>
            </form>
        </tr>

    </table>

</body>
</html>