<?php
session_start();

if (!isset($_SESSION['igralci'])) {
    header("Location: index.php");
    exit;
}

$igralci = $_SESSION['igralci'];

// 1. Pridobivanje točk in razvrščanje
$vse_tocke = array_column($igralci, 'vsota');
$unikatne_tocke = array_unique($vse_tocke);
rsort($unikatne_tocke);

$zlato_tocke = $unikatne_tocke[0] ?? null;
$srebro_tocke = $unikatne_tocke[1] ?? null;
$bron_tocke = $unikatne_tocke[2] ?? null;

$zmagovalci_1 = [];
$zmagovalci_2 = [];
$zmagovalci_3 = [];

foreach ($igralci as $i) {
    $polno_ime = $i['ime'] . " " . $i['priimek'];
    if ($i['vsota'] === $zlato_tocke) $zmagovalci_1[] = $polno_ime;
    elseif ($i['vsota'] === $srebro_tocke) $zmagovalci_2[] = $polno_ime;
    elseif ($i['vsota'] === $bron_tocke) $zmagovalci_3[] = $polno_ime;
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>3. Stran: Zmagovalci</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>🏆 Zmagovalne stopničke 🏆</h1>
    
    <div class="stopnicke-container">

    <?php if ($srebro_tocke !== null): ?>
        <div class="mesto mesto-2">
            <div class="mesto-ime"><?php echo implode("<br>", $zmagovalci_2); ?></div>
            <div class="mesto-tocke"><?php echo $srebro_tocke; ?></div>
            <div>2. Mesto</div>
        </div>
        <?php endif; ?>

        <div class="mesto mesto-1">
            <div class="mesto-ime"><?php echo implode("<br>", $zmagovalci_1); ?></div>
            <div class="mesto-tocke"><?php echo $zlato_tocke; ?></div>
            <div>1. Mesto</div>
        </div>

    
        <?php if ($bron_tocke !== null): ?>
        <div class="mesto mesto-3">
            <div class="mesto-ime"><?php echo implode("<br>", $zmagovalci_3); ?></div>
            <div class="mesto-tocke"><?php echo $bron_tocke; ?></div>
            <div>3. Mesto</div>
        </div>
        <?php endif; ?>
    </div>

    <div style="text-align:center; margin-top: 50px;">
        <a href="index.php" class="btn">Nova igra</a>
    </div>
</div>
</body>
</html>