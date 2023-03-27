
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
    <link id="theme-style" rel="stylesheet" href="assets/css/login.css">
	<title>Login Page</title>
</head>
<body>
  
    <div class="login-page">     
      
        <div class="form">
            <form action="verification.php" method="POST">
            <input type="text" placeholder="email" name="email" required/>
            <input type="password" placeholder="mdp" name="mdp" required/>
            <input type="submit" id="submit" value="LOGIN">
            
            
            <?php
             if(isset($_GET['erreur'])){
             $err = $_GET['erreur'];
             if($err==1 || $err==2)
             echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
              }
             ?>
          
  
                 
          </form>
        </div>
      </div>
      </form>
      </body>
      </html>


      
