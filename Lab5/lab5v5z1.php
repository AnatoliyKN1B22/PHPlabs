<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Конвертер Валюти</title>
</head>
<body>
    <h2>Конвертер гривні в долар</h2>
    <form method="get">
        <label>Сума в гривнях (₴):
            <input type="number" name="uah" step="0.01" required>
        </label><br><br>
        <label>Курс долара (необов'язково):
            <input type="number" name="rate" step="0.0001">
        </label><br><br>
        <button type="submit">Конвертувати</button>
    </form>

    <hr>

    <?php
    $default_rate = 41.28;

    if (isset($_GET['uah']) && is_numeric($_GET['uah'])) {
        $uah = (float)$_GET['uah'];
        $rate = isset($_GET['rate']) && is_numeric($_GET['rate']) ? (float)$_GET['rate'] : $default_rate;

        $usd = $uah / $rate;

        echo "<strong>Конвертація валюти:</strong><br>";
        echo number_format($uah, 2) . " ₴ = " . number_format($usd, 2) . " $<br>";
        echo "Курс: 1$ = " . number_format($rate, 4) . " ₴<br>";
    } elseif (isset($_GET['uah'])) {
        echo "<span style='color:red;'>Будь ласка, введіть коректну числову суму.</span>";
    }
    ?>
</body>
</html>
