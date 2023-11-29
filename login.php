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
            $query = "select * from users where user_name = '$user_name' limit 1";
            $result = mysqli_query($con,$query);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc ($result);
                    
                    if($user_data['password'] === $password)
                    {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;  
                    }

        
                }
            }
            echo "nome/senha errados!";
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
    <title>Login</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <div id="caixa">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Login"><br><br>

            <a href="registrar.php">Clique para Registrar</a><br><br>

        </form>
    </div>
    
</body>
</html>



