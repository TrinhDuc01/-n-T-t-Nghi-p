<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container">
        <img src="../img/pexels-jean-van-der-meulen-1457842.jpg" alt="">
        <div class="form-login">
            <form action="../../BackEnd/login.php" method="post">
                <input type="text" name="name" id="name" placeholder="Tên đăng nhập">
                <input type="password" name="password" id="password" placeholder="Mật khẩu">
                <button type="submit" name="login">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>
</html>