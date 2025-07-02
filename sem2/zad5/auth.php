<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();

    if (!empty($_SESSION['login']))
    {
        header('Location: ./');
        exit();
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user = 'u68786'; 
        $pass = '3696042'; 
        $db = new PDO('mysql:host=localhost;dbname=u68786', $user, $pass,
        [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

        $login = $_POST['login'];
        $password = md5($_POST['password']);
        try
        {
            $tb = $db->prepare("SELECT id FROM passwords WHERE login = ? and password = ?");
            $tb->execute([$login, $password]);
            $its = $tb->rowCount();
            if($its)
            {
                $uid = $tb->fetch(PDO::FETCH_ASSOC)[0]['id'];
                $_SESSION['login'] = $_POST['login'];
		$_SESSION['form_id'] = $uid;
                header('Location: ./');
            }
            else $error = 'Неверный логин или пароль';
        }
        catch(PDOException $e)
        {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="bootstrap.min.css"/>
    <title>zadanie 5 auth</title>
</head>
<body class="body">
    <form action="" method="post" class="form">
        <h2>Форма входа</h2>
	<?php if (!empty($error)): ?>
            <div class="error" style="color: red; margin-bottom: 10px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <div> <input class="input" style="width: 100%;" type="text" name="login" placeholder="Логин"> </div>
        <div> <input class="input" style="width: 100%;" type="text" name="password" placeholder="Пароль"> </div>
        <button class="button" type="submit">Войти</button>
	<a href="index.php">На главную</a>
    </form>
</body>
</html>