<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
$errorOutput = '';
// Складываем признак ошибок в массив.
$errors = array();
$hasErrors = FALSE;

$defaultValues = [
    'name' => '',
    'email' => '',
    'date' => '',
    'gender' => 'O',
    'limbs' => '4',
    'contract' => ''
];
// Складываем предыдущие значения полей в массив, если есть.
$values = array();
foreach (['name', 'email', 'date', 'gender', 'limbs', 'contract'] as $key) {
    $values[$key] = !array_key_exists($key . '_value', $_COOKIE) ? $defaultValues[$key] : $_COOKIE[$key . '_value'];
}
foreach (['name', 'email', 'date'] as $key) {
    $errors[$key] = empty($_COOKIE[$key . '_error']) ? '' : $_COOKIE[$key . '_error'];
    if ($errors[$key] != '')
        $hasErrors = TRUE;
}
//массив суперспособностей
$values['power'] = array();
$values['power']['0'] = empty($_COOKIE['power_0_value']) ? '' : $_COOKIE['power_0_value'];
$values['power']['1'] = empty($_COOKIE['power_1_value']) ? '' : $_COOKIE['power_1_value'];
$values['power']['2'] = empty($_COOKIE['power_2_value']) ? '' : $_COOKIE['power_2_value'];


// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    // Выдаем сообщение об успешном сохранении.
    if (!empty($_GET['save'])) {
        // Если есть параметр save, то выводим сообщение пользователю.
        $errorOutput = 'Спасибо, результаты сохранены.<br/>';
    }

    //Проверка полей на пустоту
    if (!empty($errors['name'])) {
        $errorOutput .= 'Заполните имя.<br/>';
    }
    if (!empty($errors['email'])) {
        $errorOutput .= 'Заполните email.<br/>';
    }
    if (!empty($errors['date'])) {
        $errorOutput .= 'Заполните дату рождения.<br/>';
    }
    // Включаем содержимое файла form.php.
    // В нем будут доступны переменные $messages, $errors и $values для вывода
    // сообщений, полей с ранее заполненными данными и признаками ошибок.
    include('form.php');
    exit();
}

$trimmedPost = [];
foreach ($_POST as $key => $value)
    if (is_string($value))
        $trimmedPost[$key] = trim($value);
    else
        $trimmedPost[$key] = $value;

if (empty($trimmedPost['name'])) {
    $errorOutput .= 'Заполните имя.<br/>';
    $errors['name'] = TRUE;
    setcookie('name_error', 'true');
    $hasErrors = TRUE;
} else {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('name_error', '', 10000);
    $errors['name'] = '';
}
// Выдаем куку на день с флажком об ошибке в поле.
setcookie('name_value', $trimmedPost['name'], time() + 30 * 24 * 60 * 60);
$values['name'] = $trimmedPost['name'];

if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $trimmedPost['email'])) {
    $errorOutput .= 'Заполните email.<br/>';
    $errors['email'] = TRUE;
    setcookie('email_error', 'true');
    $hasErrors = TRUE;
} else {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('email_error', '', 10000);
    $errors['email'] = '';
}
// Выдаем куку на день с флажком об ошибке в поле.
setcookie('email_value', $trimmedPost['email'], time() + 30 * 24 * 60 * 60);
$values['email'] = $trimmedPost['email'];

if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $trimmedPost['date'])) {
    $errorOutput .= 'Заполните дату рождения.<br/>';
    $errors['date'] = TRUE;
    setcookie('date_error', 'true');
    $hasErrors = TRUE;
} else {
    setcookie('date_error', '', 10000);
    $errors['date'] = '';
}
setcookie('date_value', $trimmedPost['date'], time() + 30 * 24 * 60 * 60);
$values['date'] = $trimmedPost['date'];

if (!preg_match('/^[MFO]$/', $trimmedPost['gender'])) {
    $errorOutput .= 'Заполните пол.<br/>';
    $errors['gender'] = TRUE;
    $hasErrors = TRUE;
}
setcookie('gender_value', $trimmedPost['gender'], time() + 30 * 24 * 60 * 60);
$values['gender'] = $trimmedPost['gender'];

if (!preg_match('/^[0-5]$/', $trimmedPost['limbs'])) {
    $errorOutput .= 'Заполните количество конечностей.<br/>';
    $errors['limbs'] = TRUE;
    $hasErrors = TRUE;
}
setcookie('limbs_value', $trimmedPost['limbs'], time() + 30 * 24 * 60 * 60);
$values['limbs'] = $trimmedPost['limbs'];

foreach (['0', '1', '2'] as $value) {
    setcookie('power_' . $value . '_value', '', 10000);
    $values['power'][$value] = FALSE;
}
if (array_key_exists('power', $trimmedPost)) {
    foreach ($trimmedPost['power'] as $value) {
        if (!preg_match('/[0-2]/', $value)) {
            $errorOutput .= 'Неверные суперспособности.<br/>';
            $errors['power'] = TRUE;
            $hasErrors = TRUE;
        }
        setcookie('power_' . $value . '_value', 'true', time() + 30 * 24 * 60 * 60);
        $values['power'][$value] = TRUE;
    }
}
if (!isset($trimmedPost['contract'])) {
    $errorOutput .= 'Вы не ознакомились с контрактом.<br/>';
    $errors['contract'] = TRUE;
    $hasErrors = TRUE;
}
// При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
if ($hasErrors) {

    include('form.php');
    exit();
}
//Далее работа с бд
$user = 'u41731';
$pass = '7439940';
$db = new PDO('mysql:host=localhost;dbname=u41731', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
    $db->beginTransaction();
    $stmt1 = $db->prepare("INSERT INTO forms SET name = ?, email = ?, date = ?, 
    gender = ? , limb_number = ?");
    $stmt1 -> execute([$trimmedPost['name'], $trimmedPost['email'], $trimmedPost['date'],
        $trimmedPost['gender'], $trimmedPost['limbs']]);
    $stmt2 = $db->prepare("INSERT INTO form_ability SET form_id = ?, ability_id = ?");
    $id = $db->lastInsertId();
    foreach ($trimmedPost['power'] as $s)
        $stmt2 -> execute([$id, $s]);
    $db->commit();
}
catch(PDOException $e){
    $db->rollBack();
    $errorOutput = 'Error : ' . $e->getMessage();
    include('form.php');
    exit();
}
// Делаем перенаправление.
header('Location: ?save=1');
