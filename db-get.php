<?php
// Подключение к базе данных
$db = new SQLite3('inventory.db');

// Подготовка SQL-запроса для выборки данных
$query = "SELECT * FROM inventory";
$result = $db->query($query);

// Преобразование результатов в формат JSON
$data = array();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $data[] = $row;
}

// Вывод данных в формате JSON
header('Content-Type: application/json');
echo json_encode($data);

// Закрытие соединения с базой данных
$db->close();
?>
