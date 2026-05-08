<?php session_start(); ?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Las Vegas Dice - Vstop</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body class="casino-body">

<div class="container casino-table">
    <h1 class="vegas-title">🎰 Lucky Dice Casino 🎰</h1>
    <p style="text-align:center; color: #ffd700;">Vnesi igralce:</p>
    
    <form action="play.php" method="POST">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="igralec-form card-dark">
                <h3>Igralec <?php echo $i; ?></h3>
                <input type="text" name="ime<?php echo $i; ?>" placeholder="Ime" required>
                <input type="text" name="priimek<?php echo $i; ?>" placeholder="Priimek" required>
            </div>
        <?php endfor; ?>

        <button type="submit" name="igraj" class="btn btn-gold">Začni igro!</button>
    </form>
</div>

</body>
</html>