<?php
$conn = new mysqli("localhost", "root", "", "Products");
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

// Видалення товару
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM ProductDetails WHERE id = $id");
}

// Отримання товарів з нульовою кількістю
$result = $conn->query("SELECT * FROM ProductDetails WHERE stock_quantity = 0 ORDER BY name");
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Немає в наявності</title>
</head>
<body>
    <h2>Товари, яких немає на складі</h2>
    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>Назва</th>
                <th>Категорія</th>
                <th>Ціна</th>
                <th>Дія</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= $row['price'] ?> ₴</td>
                    <td><a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Видалити цей товар?')">Видалити</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Немає товарів із нульовою кількістю.</p>
    <?php endif; ?>
    <p><a href="create_product.php">← Назад до створення товару</a></p>
</body>
</html>
