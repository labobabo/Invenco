const express = require('express');
const { Client } = require('pg');

const app = express();
const port = 3000;

// Подключение к PostgreSQL
const client = new Client({
  user: 'ваш_пользователь',
  host: 'localhost',
  database: 'ваша_база_данных',
  password: 'ваш_пароль',
  port: 5432,
});

client.connect();

// Middleware для обработки JSON в теле запроса
app.use(express.json());

// Маршрут для обработки данных из формы
app.post('/submit-form', async (req, res) => {
  try {
    const { deviceNumber, deviceType, deviceLocation, deviceStatus } = req.body;

    // Вставляем данные в таблицу вашей базы данных
    const result = await client.query(`
      INSERT INTO ваша_таблица(deviceNumber, deviceType, deviceLocation, deviceStatus)
      VALUES($1, $2, $3, $4)
      RETURNING *;
    `, [deviceNumber, deviceType, deviceLocation, deviceStatus]);

    res.json(result.rows[0]); // Отправляем ответ с вставленными данными
  } catch (error) {
    console.error('Error executing query', error);
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

// Запуск сервера
app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
