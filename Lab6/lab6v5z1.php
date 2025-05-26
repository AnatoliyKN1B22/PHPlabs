<?php
// Параметри підключення
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Products";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

// 1. Створення бази даних
$sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "База даних '$dbname' створена успішно<br>";
} else {
    die("Помилка створення бази даних: " . $conn->error);
}

// Використання бази даних
$conn->select_db($dbname);

// 2. Видалення старої таблиці, якщо існує
$conn->query("DROP TABLE IF EXISTS ProductDetails");

// 3. Створення таблиці ProductDetails
$sql = "CREATE TABLE ProductDetails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    category VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($conn->query($sql) === TRUE) {
    echo "Таблиця 'ProductDetails' створена успішно<br>";
} else {
    die("Помилка створення таблиці: " . $conn->error);
}

// 4. Додавання товарів з підготовленим запитом
$products = [
    ["iPhone 13", "Смартфони", 999.99, 25],
    ["Samsung Galaxy S21", "Смартфони", 899.99, 30],
    ["Dell XPS 15", "Ноутбуки", 1499.99, 15],
    ["HP Pavilion", "Ноутбуки", 799.99, 20],
    ["Sony WH-1000XM4", "Навушники", 349.99, 40],
    ["Apple AirPods Pro", "Навушники", 249.99, 50],
    ["Logitech MX Master 3", "Комп'ютерні миші", 99.99, 60],
    ["Keychron K2", "Клавіатури", 89.99, 35]
];

$stmt = $conn->prepare("INSERT INTO ProductDetails (name, category, price, stock_quantity) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Помилка підготовки запиту: " . $conn->error);
}

foreach ($products as $product) {
    $stmt->bind_param("ssdi", $product[0], $product[1], $product[2], $product[3]);

    if ($stmt->execute()) {
        echo "Товар '{$product[0]}' успішно додано<br>";
    } else {
        echo "Помилка при додаванні товару '{$product[0]}': " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
