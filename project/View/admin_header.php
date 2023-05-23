<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMm10ZFitz" crossorigin="anonymous">

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSGFpoO9FYwshpSFERe6TvaS7RTW1J8k1qV4t+6W8Jd4Xq8h4Lyn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-MHy7k1i3wO3OoFJzjGm+Ez5l/6en8XCp+HHAAK5GSLf2xlYtvJ8U2Q4U+9cuEnJoa3" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .menu {
            background-color: #343a40;
            padding: 10px;
            border-radius: 5px;
        }

        .menu li {
            padding: 5px;
        }

        .menu li a {
            color: #ffffff;
            transition: 0.3s;
        }

        .menu li a:hover {
            color: #17a2b8;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-right">
                <a class="text-info" href="../Controller/logout.php">Logout</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1 class="text-success">X <sub class="text-dark">Company</sub></h1>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <fieldset>
                    <legend><h2><u>Account</u></h2></legend>
                    <ul class="list-unstyled menu">
                        <li><a class="text-info" href="admin_panel.php">Dashboard</a></li>
                        <li><a class="text-info" href="admin_info.php">View Profile</a></li>
                        <li><a class="text-info" href="admin_editprofile.php">Edit Profile</a></li>
                        <li><a class="text-info" href="change_profilepic.php">Change Profile Pic</a></li>
                        <li><a class="text-info" href="admin_changepassword.php">Change Password</a></li>
                        <li><a class="text-info" href="admin_adduser.php">Add Users</a></li>
                        <li><a class="text-info" href="admin_editdeleteuser.php">Manage Users</a></li>
                    </ul>
                </fieldset>
            </div>
        </div>
    </div>

</body>
</html>
