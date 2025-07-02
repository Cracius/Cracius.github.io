<?php
// login.php — страница входа
session_start();
// Если уже залогинен по куке — сразу на профиль
if (!empty($_COOKIE['user_id'])) {
    header('Location: profile.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    // Проверим учётки через API
    $payload = json_encode(['login'=>$login,'password'=>$password]);
    $ch = curl_init('api.php');
    curl_setopt($ch, CURLOPT_POST,         true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,   ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS,   $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $resp = json_decode($response, true);
    if (!empty($resp['success'])) {
        // Сохраняем ID пользователя в куку и редиректим
        setcookie('user_id', $resp['id'] ?? '', 0, '/');
        header('Location: profile.php');
        exit;
    } else {
        $error = implode('<br>', $resp['errors'] ?? ['Неверные данные']);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход в аккаунт</title>
  <style>
    body { background: #414344; font-family: 'Roboto',sans-serif; }
    form { max-width: 400px; margin: 50px auto; display: flex; flex-direction: column; gap: 15px; }
    label { color: #fff; display: flex; flex-direction: column; }
    input { padding: 8px; font-size: 1rem; border: 1px solid #ccc; border-radius: 4px; }
    button { padding: 10px; font-size: 1rem; color: #fff; background-color: #333; border: none; border-radius: 4px; cursor: pointer; }
    .error { color: #f44; font-weight: bold; }
  </style>
</head>
<body>
  <form method="post" action="login.php">
    <h2 style="color:#fff;text-align:center;">Вход в аккаунт</h2>
    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <label>Логин<input type="text" name="login" required /></label>
    <label>Пароль<input type="password" name="password" required /></label>
    <button type="submit">Войти</button>
  </form>
</body>
</html>