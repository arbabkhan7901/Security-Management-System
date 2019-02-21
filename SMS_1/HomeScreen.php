<!DOCTYPE html>
<html>
<head>
    <title> Admin Home</title>
    <style>
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
            var roles = SecurityManager.GetAllUserRoles();
            var per = SecurityManager.GetAllRolePermissions();
            var v = localStorage["userID"];
            var temp = new Array();
            var ctr = 0;
            for (var i = 0; i < roles.length; i++) {
                if (roles[i].name == v) {
                    temp[ctr] = roles[i];
                    ctr++;
                }
            }
            var temp1 = new Array();
            var ctr1 = 0;
            for (var j = 0; j < temp.length; j++) {
                for (var k = 0; k < per.length; k++) {
                    if (per[k].role == temp[j].role) {
                        temp1[ctr1] = per[k];
                        ctr1++;
                    }
                }
            }
            var tableRef = document.getElementById("div2");
            tableRef.style.width = '400px';
            tableRef.style.border = '0px solid black';
            for (var i = 0; i < temp.length; i++) {
                var newRow = tableRef.insertRow(i);
		var newCell = newRow.insertCell(i);
                var newText = "";
		newText = document.createTextNode(temp[i].role);
                newCell.appendChild(newText);
                newCell.style.border = '1px solid black';
		var k = 1;
                for (var j = 0; j < temp1.length; j++) {
                    var newCell = newRow.insertCell(k);
		    k++;
                    var newText = "";
                    if (temp[i].role == temp1[j].role) {
                        newText = document.createTextNode(temp1[j].per);
                        newCell.style.border = '1px solid black';
                        newCell.appendChild(newText);
                    }
                }
            }
        }
    </script>
</head>
<body onload="Main();">
    <div id="bar">
        <a href="HomeScreen.php">Home</a>
        <a href="login.php">log out</a>
    </div>
    <br> <br>
    <h1 style="text-align: center;">
        <b>Welcome User!</b>
    </h1>
    <div>
        <table id="div2"></table>

    </div>
</body>
</html>
