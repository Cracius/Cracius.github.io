<?php

$id = 0;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} elseif (!empty($_COOKIE['user_id'])) {
    $id = (int)$_COOKIE['user_id'];
}

// Если всё ещё некорректно — выходим
if ($id < 1) {
    die('Неверный ID пользователя');
}

//Подключение (как в back.php)
$pdo = new PDO('mysql:host=localhost;dbname=u68786', 'u68786', '3696042', [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

//Получаем данные
$stmt=$pdo->prepare("SELECT u.*, p.login FROM users u JOIN passwords p ON u.id=p.id WHERE u.id=?");
$stmt->execute([$id]);
$user=$stmt->fetch(); if(!$user) die('Пользователь не найден');

//Языки
$langsStmt = $pdo->prepare("SELECT l.lang FROM langs l JOIN users_langs ul ON l.lang_id=ul.lang_id WHERE ul.form_id=?");
$langsStmt->execute([$id]);
$langs = $langsStmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Профиль <?=htmlspecialchars($user['fio'])?></title></head>
<body>
  <h1>Профиль пользователя</h1>
  <p><b>ФИО:</b> <?=htmlspecialchars($user['fio'])?></p>
  <p><b>Номер:</b> <?=htmlspecialchars($user['number'])?></p>
  <p><b>Email:</b> <?=htmlspecialchars($user['email'])?></p>
  <p><b>Дата рождения:</b> <?=htmlspecialchars($user['date_r'])?></p>
  <p><b>Пол:</b> <?=htmlspecialchars($user['male'])?></p>
  <p><b>Биография:</b> <?=nl2br(htmlspecialchars($user['biography']))?></p>
  <p><b>Языки:</b> <?=implode(', ', $langs)?></p>
  <p><b>Login:</b> <?=htmlspecialchars($user['login'])?></p>
</body>
</html>