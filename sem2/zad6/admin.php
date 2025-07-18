<?php

require ('db.php');

$admin = 0;
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
  $q = $db->prepare("SELECT id from passwords WHERE role = 'admin' and login = ? and password = ?");
  $q->execute([$_SERVER['PHP_AUTH_USER'], md5($_SERVER['PHP_AUTH_PW'])]);
  $admin = $q->rowCount();
}

if (!$admin) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print ('<h1>401 Требуется авторизация</h1>');
  exit();
}

print ('Авторизация прошла успешно.');

session_start();

if (count($_POST)) {
  $keyPost = key($_POST);
  if (empty($_SESSION['rem_but']) || $_SESSION['rem_but'] != $keyPost) {
    $id = explode('-', $keyPost)[1];

    if (!preg_match('/^[0-9]+$/', $id))
      exit("Введите id");

    $dbf = $db->prepare("SELECT * FROM users WHERE id = ?");
    $dbf->execute([$id]);
    if ($dbf->rowCount() != 0) {
      $dels = $db->prepare("DELETE FROM users WHERE id = ?");
      $dels->execute([$id]);
      $dels = $db->prepare("DELETE FROM users_langs WHERE form_id = ?");
      if (!$dels->execute([$id]))
        exit("Ошибка удаления");
    } else
      exit("Форма не найдена");

    $_SESSION['rem_but'] = $keyPost;
  }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="admin.css">
  <title>zadanie 6 admin</title>
</head>

<body>
  <form method="post" action="">
    <table class="table1">
      <thead>
        <tr>
          <th>id</th>
          <th>fio</th>
          <th>number</th>
          <th>email</th>
          <th>birth date</th>
          <th>gender</th>
          <th>biography</th>
          <th>Programming Lang</th>
          <th>edit</th>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbFD = $db->query("SELECT * FROM users ORDER BY id DESC");
        while ($row = $dbFD->fetch(PDO::FETCH_ASSOC)) {
          echo '<tr data-id=' . $row['id'] . '>
                  <td>' . $row['id'] . '</td>
                  <td>' . $row['fio'] . '</td>
                  <td>' . $row['number'] . '</td>
                  <td>' . $row['email'] . '</td>
                  <td>' . $row['date_r'] . '</td>
                  <td>' . (($row['male'] == "M") ? "Мужской" : "Женский") . '</td>
                  <td>' . $row['biography'] . '</td>
                  <td>';
          $dbl = $db->prepare("SELECT * FROM users_langs fd
                                JOIN langs l ON l.lang_id = fd.lang_id
                                WHERE form_id = ?");
          $dbl->execute([$row['id']]);
          while ($row1 = $dbl->fetch(PDO::FETCH_ASSOC))
            echo $row1['lang'] . '<br>';
          echo '</td>
                <td><a href="index.php?uid=' . $row['id'] . '" target="_blank">Редактировать</a></td>
                <td><button name="butt-' . $row['id'] . '" class="remove">Удалить</button></td>
              </tr>';
        }
        ?>
      </tbody>
    </table>
  </form>


  <table class="table2">
    <tr>
      <td>Programming Lang</td>
      <td>Count Users</td>
    </tr>
    <tbody>
      <?php
      $q = $db->query("SELECT l.lang_id, l.lang, count(fd.form_id) as count FROM langs l 
                        LEFT JOIN users_langs fd ON fd.lang_id = l.lang_id
                        GROUP by l.lang_id");
      while ($row = $q->fetch(PDO::FETCH_ASSOC))
        echo '<tr>
          <td>' . $row['lang'] . '</td>
          //<td>' . $row['count'] . '</td>';
      ?>

    </tbody>
  </table>
</body>

</html>