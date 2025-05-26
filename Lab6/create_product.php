<?php
// Підключення до БД
$conn = new mysqli("localhost", "root", "", "Products");
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

$name = $category = $price = $stock_quantity = "";
$errors = [];
$success = "";

// Обробка форми
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання та перевірка даних
    $name = trim($_POST["name"]);
    $category = trim($_POST["category"]);
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];

    // Валідація
    if (empty($name)) $errors[] = "Назва товару обов'язкова";
    if (empty($category)) $errors[] = "Категорія обов'язкова";
    if (!is_numeric($price) || $price <= 0) $errors[] = "Ціна має бути додатним числом";
    if (!filter_var($stock_quantity, FILTER_VALIDATE_INT) || $stock_quantity < 0) $errors[] = "Кількість має бути невід'ємним числом";

    // Додавання в базу
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO ProductDetails (name, category, price, stock_quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $name, $category, $price, $stock_quantity);
        if ($stmt->execute()) {
            $success = "Товар успішно додано!";
            $name = $category = $price = $stock_quantity = ""; // Очищення форми
        } else {
            $errors[] = "Помилка при додаванні: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати товар</title>
</head>
<body>
    <h2>Додати новий товар</h2>
    <?php if (!empty($errors)): ?>
        <ul style="color:red">
            <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
        </ul>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green"><?= $success ?></p>
    <?php endif; ?>

    <form method="post">
        Назва: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br><br>
        Категорія: <input type="text" name="category" value="<?= htmlspecialchars($category) ?>"><br><br>
        Ціна: <input type="text" name="price" value="<?= htmlspecialchars($price) ?>"><br><br>
        Кількість на складі: <input type="number" name="stock_quantity" value="<?= htmlspecialchars($stock_quantity) ?>"><br><br>
        <button type="submit">Додати</button>
    </form>
    <p><a href="out_of_stock.php">Переглянути товари без залишку</a></p>
</body>
</html>
