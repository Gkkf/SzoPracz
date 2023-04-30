<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Login</title>
    <link rel="stylesheet" href="styles/login_style.css" media="all"/>
</head>
<body>
    <div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Hasło" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Zaloguj</button>
    </form>
</div>
</body>
</html>

<?php
session_start();
include("includes/db_connect.php");

//jeśli przycisk zalogowania kliknięty
if(isset($_POST['login']))
{
    //zmienna z danymi wpisanymi
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sel_user = "SELECT * FROM admins WHERE user_email='$email' AND user_pass='$pass'";
    $run_user = mysqli_query($con, $sel_user);

    //zmienna używana do sprawdzania użytkowników z bazy
    $check_user = mysqli_num_rows($run_user);
    if($check_user==0)
    {
        echo "<script>alert('Hasło lub Email jest niepoprawny. Spróbuj ponownie!')</script>";
    }
    else
    {
        $_SESSION['user_email'] = $email;
        
        echo "<script>window.open('index.php', '_self')</script>";
    }
}

?>

