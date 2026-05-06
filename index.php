<?php
// index.php
session_start();
session_unset(); 
session_destroy();
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>1. Stran: Vnos igralcev</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Vnos Igralcev</h1>
    <form method="POST" action="play.php">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="igralec-form">
                <h3>Igralec <?php echo $i; ?></h3>
                <label>Ime:</label>
                <input type="text" name="ime<?php echo $i; ?>" required>
                
                <label>Priimek:</label>
                <input type="text" name="priimek<?php echo $i; ?>" required>
            </div>
        <?php endfor; ?>
        
        <button type="submit" name="igraj" class="btn">Vrzi kocke za vse!</button>
    </form>
</div>

</body>
</html>