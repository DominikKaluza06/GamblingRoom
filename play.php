<?php
// play.php
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
    <title>Igra: Metanje kock</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/javascript.js"></script>
</head>
<body>

<div class="container">
    <h1>Rezultati igre</h1>
    
    <?php foreach ($_SESSION['igralci'] as $index => $igralec): ?>
        <div class='igralec-rezultat' id="player-<?php echo $index; ?>">
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
                <p class="skupna-vsota" style="display: none;">
                    <strong>Skupna vsota:</strong> <?php echo $igralec['vsota']; ?>
                </p>
            </div>

            <button class="roll-btn" onclick="vrziKocke(<?php echo $index; ?>)">Vrzi kocke!</button>
        </div>
    <?php endforeach; ?>

    <hr>

    <div id="timer-obvestilo" style="display: none;">
        <p style="text-align: center; font-weight: bold; color: #dc3545; font-size: 1.2rem;">
            Vsi so vrgli! Razglasitev zmagovalcev čez <span id="sekunde">10</span> sekund...
        </p>
        <a href="zmagovalci.php" class="btn">Preskoči in pokaži stopničke!</a>
    </div>
</div>

</body>
</html>