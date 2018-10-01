<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">login_page.php

<form action="verify.php" method="post"> 
    User Name:<br> 
    <input type="text" name="username"><br><br> 
    Password:<br> 
    <input type="password" name="password"><br><br> 
    <input type="submit" name="submit" value="Login"> 
</form> 
verify.php

<?php 
if(isset($_POST['submit'])){ 
    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "xxxx";            //Database User Name 
    $dbPass = "xxxxxx";            //Database Password 
    $dbDatabase = "db_name";    //Database Name 
     
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
    //Connect to the databasse 
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
    //Selects the database 
     
    /* 
    The Above code can be in a different file, then you can place include'filename.php'; instead. 
    */ 
     
    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    $usr = mysql_real_escape_string($_POST['username']); 
    $pas = hash('sha256', mysql_real_escape_string($_POST['password'])); 
    $sql = mysql_query("SELECT * FROM users_table  
        WHERE username='$usr' AND 
        password='$pas' 
        LIMIT 1"); 
    if(mysql_num_rows($sql) == 1){ 
        $row = mysql_fetch_array($sql); 
        session_start(); 
        $_SESSION['username'] = $row['username']; 
        $_SESSION['fname'] = $row['first_name']; 
        $_SESSION['lname'] = $row['last_name']; 
        $_SESSION['logged'] = TRUE; 
        header("Location: users_page.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: login_page.php"); 
        exit; 
    } 
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header("Location: index.php");     
    exit; 
} 
?> 
users_page.php

<?php 
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: login_page.php"); 
    exit; 
} 
echo 'Welcome, '.$_SESSION['username']; 
?> 
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>

</body>
</html>