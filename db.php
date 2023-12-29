<?php
// Подключение к базе данных
$db = new SQLite3('inventory.db');

// Получение данных из формы
$deviceNumber = $_POST['deviceNumber'];
$deviceType = $_POST['deviceType'];
$deviceLocation = $_POST['deviceLocation'];
$deviceStatus = $_POST['deviceStatus'];

// Подготовка SQL-запроса
$query = "INSERT INTO inventory (id, type, place, status) VALUES ('$deviceNumber', '$deviceType', '$deviceLocation', '$deviceStatus')";

// Выполнение запроса
$result = $db->exec($query);

// Проверка успешности выполнения запроса
if ($result) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка при добавлении данных в базу данных: " . $db->lastErrorMsg();
}

// Закрытие соединения с базой данных
$db->close();
?>
