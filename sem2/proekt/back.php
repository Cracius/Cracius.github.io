<?php
// back.php — обработка POST из form.php
header("Content-Type: text/html; charset=UTF-8");
session_start();
include 'db.php';

// Флаги авторизации (если нужно)
$log      = isset($_SESSION['login']);
$adminLog = isset($_SERVER['PHP_AUTH_USER']);

// Служебные переменные
$error    = false;

// Функция валидации и установки cookies
function check_pole($name, $message, $condition) {
    global $error;
    if ($condition) {
        setcookie("{$name}_error", $message, time()+86400, '/');
        $error = true;
    }
    // сохраняем значение поля (для повторного вывода)
    $val = $_POST[$name] ?? '';
    if (is_array($val)) {
        setcookie("{$name}_value", implode(',', $val), time()+86400, '/');
    } else {
        setcookie("{$name}_value", $val, time()+86400, '/');
    }
    return !$condition;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем поля
    $fio      = trim($_POST['fio']      ?? '');
    $number   = trim($_POST['number']   ?? '');
    $email    = trim($_POST['email']    ?? '');
    $date     = trim($_POST['date']     ?? '');
    $radio    = trim($_POST['radio']    ?? '');
    $language = $_POST['language']      ?? [];
    $bio      = trim($_POST['bio']      ?? '');
    $check    = $_POST['check']         ?? '';

    // Проверки
    check_pole('fio',      'Это поле пустое или неверный формат',       empty($fio) || !preg_match('/^([А-Яа-яЁё]+)( [А-Яа-яЁё]+){1,2}$/u', $fio));
    check_pole('number',   'Номер должен быть из 11 цифр',             strlen(preg_replace('/\D/','',$number))!==11);
    check_pole('email',    'Неверный формат email',                    !filter_var($email, FILTER_VALIDATE_EMAIL));
    check_pole('date',     'Пустая или будущая дата',                  empty($date) || strtotime($date) > time());
    check_pole('radio',    'Не выбран пол',                             !in_array($radio,['male','female']));
    check_pole('language', 'Не выбран язык программирования',           empty($language));
    check_pole('bio',      'Пустая или слишком длинная биография',      empty($bio) || mb_strlen($bio)>65535);
    check_pole('check',    'Не подтверждён контракт',                  !$check);

    // Ещё проверяем, что выбранные ID языков есть в БД
    if (!$error) {
        $in  = implode(',', array_fill(0, count($language), '?'));
        $sql = "SELECT lang_id FROM langs WHERE lang_id IN ($in)";
        $stmt = $db->prepare($sql);
        foreach(array_values($language) as $i=>$val) {
            $stmt->bindValue($i+1, $val, PDO::PARAM_INT);
        }
        $stmt->execute();
        if ($stmt->rowCount() !== count($language)) {
            setcookie("language_error", 'Неверно выбран язык', time()+86400, '/');
            $error = true;
        }
    }

    // Если ошибок нет — пишем в БД
    if (!$error) {
        if ($log) {
            // Обновление существующего пользователя
            $stmt = $db->prepare("UPDATE users SET fio=?, number=?, email=?, date_r=?, male=?, biography=? WHERE id=?");
            $stmt->execute([$fio,$number,$email,$date,$radio,$bio,$_SESSION['user_id']]);
            // Перезапишем связи с языками
            $db->prepare("DELETE FROM users_langs WHERE form_id=?")
               ->execute([$_SESSION['form_id']]);
            $ins = $db->prepare("INSERT INTO users_langs(form_id,lang_id) VALUES(?,?)");
            foreach($language as $langId){
              $ins->execute([$_SESSION['form_id'],$langId]);
            }
        } else {
            // Новый пользователь — вставляем login/pass и данные
            $login = uniqid();
            $pass  = uniqid();
            setcookie('login', $login, time()+86400, '/');
            setcookie('pass',  $pass,  time()+86400, '/');
            $mpass = md5($pass);

            $db->prepare("INSERT INTO passwords(login,password) VALUES(?,?)")
               ->execute([$login,$mpass]);
            $userId = $db->lastInsertId();

            $db->prepare("INSERT INTO users(id,fio,number,email,date_r,male,biography) VALUES(?,?,?,?,?,?,?)")
               ->execute([$userId,$fio,$number,$email,$date,$radio,$bio]);
            $formId = $db->lastInsertId();

            $ins = $db->prepare("INSERT INTO users_langs(form_id,lang_id) VALUES(?,?)");
            foreach($language as $langId){
              $ins->execute([$formId,$langId]);
            }
        }
        // Отмечаем успешное сохранение
        setcookie('save','1', time()+86400, '/');
    }

    // После обработки возвращаем пользователя к форме
    header("Location: form.php");
    exit;
}

// Если кто-то зашел на back.php методом GET — просто перенаправляем на форму
header("Location: form.php");
exit;