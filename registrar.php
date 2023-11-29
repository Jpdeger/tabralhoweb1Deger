<?php
session_start();
     include("connectdb.php");
     include("funcoes.php");
      
     if($_SERVER['REQUEST_METHOD'] == "POST")
     {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric ($user_name))
        {   
            $user_id = numeroRandom(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
            mysqli_query($con,$query);
            header("Location: login.php");
            die;
        } else 
        {
            echo "Porfavor entre com infomação valida";
        }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <div id="caixa">
        <h1>Pokedigitação</h1>
        <h2>Registrar</h2>
        <form method="post">
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Registrar"><br><br>

            <a href="login.php">Clique para Entrar</a><br><br>

        </form>
    </div>
    
</body>
</html>