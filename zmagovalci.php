<?php
session_start();
if (!isset($_SESSION['igralci'])) {
    header("Location: index.php");
    exit;
}

$igralci = $_SESSION['igralci'];
$vse_tocke = array_column($igralci, 'vsota');
$unikatne_tocke = array_unique($vse_tocke);
rsort($unikatne_tocke);

$zmagovalci = [[], [], []]; // 1, 2, 3 mesto

foreach ($igralci as $i) {
    $ime = $i['ime'] . " " . $i['priimek'];
    for ($m = 0; $m < 3; $m++) {
        if (isset($unikatne_tocke[$m]) && $i['vsota'] == $unikatne_tocke[$m]) {
            $zmagovalci[$m][] = $ime;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Zmagovalci - Jackpot!</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body class="casino-body">

<div class="container casino-table">
    <h1 class="vegas-title">🏆 Hall of Fame 🏆</h1>
    
    <div class="stopnicke-container">
        <?php if (!empty($zmagovalci[1])): ?>
        <div class="mesto rank-2">
            <div class="mesto-ime"><?php echo implode("<br>", $zmagovalci[1]); ?></div>
            <div class="mesto-tocke"><?php echo $unikatne_tocke[1]; ?></div>
            <div class="label">2. Mesto</div>
        </div>
        <?php endif; ?>

        <div class="mesto rank-1">
            <div class="mesto-ime">👑<br><?php echo implode("<br>", $zmagovalci[0]); ?></div>
            <div class="mesto-tocke"><?php echo $unikatne_tocke[0]; ?></div>
            <div class="label">ZMAGOVALEC</div>
        </div>

        <?php if (!empty($zmagovalci[2])): ?>
        <div class="mesto rank-3">
            <div class="mesto-ime"><?php echo implode("<br>", $zmagovalci[2]); ?></div>
            <div class="mesto-tocke"><?php echo $unikatne_tocke[2]; ?></div>
            <div class="label">3. Mesto</div>
        </div>
        <?php endif; ?>
    </div>

    <a href="index.php" class="btn btn-gold" style="margin-top:50px;">Nova Igra</a>
</div>

</body>
</html>