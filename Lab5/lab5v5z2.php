<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Перевірка довжини тексту</title>
</head>
<body>
    <h2>Введіть текст</h2>
    <form method="post">
        <textarea name="user_text" rows="5" cols="50" placeholder="Введіть текст тут..." required></textarea><br><br>
        <button type="submit">Перевірити</button>
    </form>

    <hr>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $text = trim($_POST['user_text'] ?? '');

        if (strlen($text) <= 100) {
            echo "<span style='color:green;'>✅ Довжина тексту: " . strlen($text) . " символів. Все гаразд!</span>";
        } else {
            echo "<span style='color:red;'>❌ Текст перевищує 100 символів! (".strlen($text)." символів)</span>";
        }
    }
    ?>
</body>
</html>
