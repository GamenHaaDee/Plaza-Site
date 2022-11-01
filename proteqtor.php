<!-- Start Login pagina ref -->
<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	session_unset();
    header("location: logout.php");
	session_destroy();
	}
	$_SESSION['LAST_ACTIVITY'] = time();
?>
<!-- Einde Login pagina Ref -->

<!-- Start Refresh na 30 min -->
<?php
    header("refresh: 1810;");
?>
<!-- Einde Refresh na 30 min -->

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="stylesheet" href="css/register.css" />
</head>
<body scroll="no" style="overflow: hidden">
<link rel='stylesheet' href='vendor/bootstrap/css/bootstrap.min.css'>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "
            <link rel='stylesheet' href='css/error.css' />
              <div>
                <div>
                  <center><div class='goed'>
                    <h3>$username is aangemaakt.</h3></center>
                   </div>
                  </div>
                </div>
              <div class='form'>
            <h1>Registratie</h1>
          <form name='Registratie' action='' method='post'>
         <input type='text' name='username' placeholder='Username' required />
        <input type='email' name='email' placeholder='Email' required />
       <input type='password' name='password' placeholder='Password' required />
      <input type='submit' name='submit' value='Registreer' />
     </form>
     <a href='home.php'>
     <button type='submit' name='submit' formaction='home.php'>Home</button> 
     <a> 
    </div>";
        }
    }else{
         
?>
<div class='form'>
<h1>Nieuwe Collega</h1>
<form name='Registratie' action='' method='post'>
<input type='text' name='username' placeholder='Username' required />
<input type='email' name='email' placeholder='Email' required />
<input type='text' name='nummer' placeholder='Telefoon Nummer' required />
<input type='password' name='password' placeholder='Password' required />
<input type='submit' name='submit' value='Registreren' />
</form>
<a href='index.php'>
<button type='submit' name='submit' formaction='index.php'>Home</button> 
<a>
</div>
<?php } ?>
</body>
</html>
