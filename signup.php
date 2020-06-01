<?php
$dbc = mySQli_connect('localhost', 'root','','test');
if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($dbc,trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc,trim($_POST['password']));
    $email = mysqli_real_escape_string($dbc,trim($_POST['email']));
    $login = mysqli_real_escape_string($dbc,trim($_POST['login']));
    $password_confirm = mysqli_real_escape_string($dbc,trim($_POST['password_confirm']));
    if(!empty($username) && !empty($password) && !empty($password_confirm) && $password == $password_confirm){
        $query = "SELECT * FROM `users` WHERE user_login = '$login'";
        $data = mysqli_query($dbc,$query);
        if(mysqli_num_rows($data) == 0){
            $query = "INSERT INTO `users` (user_name,user_login,user_password,user_mail ) VALUES ('$username','$login',SHA('$password'),'$email')";
            mysqli_query($dbc, $query);
            echo" Всё готово можете авторизоваться";
            echo '<p><a href="index.php">вход</a></p>';
            mysqli_close($dbc);
            exit();

        }else{
            echo 'Логин уже существует';
        }
    }
}else{
    
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/csss.css">
</head>
<body>
<div class="container">
    <form method="POST" action="<?php echo $_SERVER[PHP_SELF];?>">
         <h1>Регистрация</h1>
         <label for="username">Введите ваше имя</label><br>
         <input type="text" name="username"><br>
         <label for="login">Введите ваш логин</label><br>
         <input type="text" name="login"><br>
         <label for="email">Введите ваш @mail</label><br>
         <input type="email" name="email"><br>
         <label for="password">Введите ваш пароль</label><br>
         <input type="password" name="password"><br>
         <label for="password">Введите ваш пароль ещё раз</label><br>
         <input type="password" name="password_confirm"><br><br>
         <button name="submit">Зарегистрироваться</button>
    </form>
    <p><a href="index.php">вход</a></p>
</div>


</body>
</html>