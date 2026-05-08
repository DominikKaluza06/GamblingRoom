<?php
session_start();
if (!isset($_POST['igraj']) && !isset($_SESSION['igralci'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['igraj'])) {
    $_SESSION['igralci'] = [];
    for ($i = 1; $i <= 3; $i++) {
        $meti = [];
        $vsota = 0;
        for ($j = 0; $j < 3; $j++) {
            $kocka = rand(1, 6);
            $meti[] = $kocka;
            $vsota += $kocka;
        }
        $_SESSION['igralci'][] = [
            'id' => $i,
            'ime' => htmlspecialchars($_POST["ime$i"]),
            'priimek' => htmlspecialchars($_POST["priimek$i"]),
            'meti' => $meti,
            'vsota' => $vsota
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Las Vegas Dice - Igraj!</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="js/javascript.js" defer></script>
</head>
<body class="casino-body">

<div class="container casino-table">
    <h1 class="vegas-title">Mize so pripravljene!</h1>
    
    <?php foreach ($_SESSION['igralci'] as $index => $igralec): ?>
        <div class='igralec-rezultat player-card' id="player-<?php echo $index; ?>">
            <h2><?php echo $igralec['ime'] . " " . $igralec['priimek']; ?></h2>
            
            <div class="dice-area" id="dice-area-<?php echo $index; ?>">
                <p>
                    <?php foreach ($igralec['meti'] as $kocka): ?>
                        <img class='kocka-img' 
                             src='images/dice-anim.gif' 
                             data-rezultat='images/dice<?php echo $kocka; ?>.gif' 
                             alt='Kocka'>
                    <?php endforeach; ?>
                </p>
                <p class="skupna-vsota score-badge" style="display: none;">
                    Vsota: <?php echo $igralec['vsota']; ?>
                </p>
            </div>

            <button class="roll-btn chip-btn" onclick="vrziKocke(<?php echo $index; ?>)">Vrzi kocke!</button>
        </div>
    <?php endforeach; ?>

    <div id="timer-obvestilo" class="alert-vegas">
        <p>Vsi so vrgli! Rezultati čez <span id="sekunde">10</span> sekund...</p>
        <a href="zmagovalci.php" class="btn">Takoj na stopničke!</a>
    </div>
</div>

</body>
</html>