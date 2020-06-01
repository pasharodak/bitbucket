<?php
$dbc = mySQli_connect('localhost', 'root','','test');
if(!isset($_COOKIE['user_id'])){
    if(isset($_POST['submit'])){
        $user_login = mysqli_real_escape_string($dbc, trim($_POST['login']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        if(!empty($user_login)  && !empty($user_password)){
            $query = "SELECT `user_id`, `user_login` FROM `users` WHERE user_login = '$user_login' AND user_password = SHA('$user_password')";
            $data = mysqli_query($dbc, $query);
            if(mysqli_num_rows($data) == 1){
                $row = mysqli_fetch_assoc($data);
                setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
                setcookie('user_login', $row['user_login'], time() + (60*60*24*30));
                $home_url = 'http://'.$_SERVER['HTTP_HOST'];
                header('Location:'.$home_url);

            }else{
                echo 'Извините вы  ввели неверное имя пользователя или пароль';
            }
        }else{
            echo 'заполните поля';
        }
    }

}

    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/csss.css">
</head>
<body>

<div class="container">
    <?php 
    if(empty($_COOKIE['user_login'])){
    ?>
    <form method="POST" action="<?php echo $_SERVER[PHP_SELF];?>">
         <label for="login">Введите ваш логин</label>
         <input type="text" name="login">
         <label for="password">Введите ваш пароль</label>
         <input type="password" name="password"><br>
         <button type="submit" name="submit">Вход</button>
    </form>
    <p><a href="signup.php">Регистрация</a></p>
    <?php
    }
    else { 
        ?>
        <p><a href="exit.php">exit</a></p>
       

        <?php

    };
    ?>
</div>


</body>
</html>