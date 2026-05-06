<?php
// zmagovalci.php
session_start();

if (!isset($_SESSION['igralci'])) {
    header("Location: index.php");
    exit;
}

// 1. Zberemo vse točke
$vse_tocke = [];
foreach ($_SESSION['igralci'] as $igralec) {
    $vse_tocke[] = $igralec['vsota'];
}

// 2. Odstranimo dvojnike in razvrstimo padajoče (najvišja vrednost je prva)
$unikatne_tocke = array_unique($vse_tocke);
rsort($unikatne_tocke);

// Prva številka je zlato, druga srebro, tretja bron (če obstajajo)
$zlato_tocke = $unikatne_tocke[0];
$srebro_tocke = isset($unikatne_tocke[1]) ? $unikatne_tocke[1] : null;
$bron_tocke = isset($unikatne_tocke[2]) ? $unikatne_tocke[2] : null;

$zmagovalci_1_mesto = [];
$zmagovalci_2_mesto = [];
$zmagovalci_3_mesto = [];

// 3. Igralce razvrstimo v ustrezne sezname glede na njihove točke
foreach ($_SESSION['igralci'] as $igralec) {
    if ($igralec['vsota'] == $zlato_tocke) {
        $zmagovalci_1_mesto[] = $igralec['ime'] . " " . $igralec['priimek'];
    } elseif ($igralec['vsota'] == $srebro_tocke) {
        $zmagovalci_2_mesto[] = $igralec['ime'] . " " . $igralec['priimek'];
    } elseif ($igralec['vsota'] == $bron_tocke) {
        $zmagovalci_3_mesto[] = $igralec['ime'] . " " . $igralec['priimek'];
    }
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
        
        <?php if ($srebro_tocke !== null && count($zmagovalci_2_mesto) > 0): ?>
            <div class="mesto mesto-2">
                <div class="mesto-ime">
                    <?php echo implode("<br>in<br>", $zmagovalci_2_mesto); ?>
                </div>
                <div class="mesto-tocke">
                    <?php echo $srebro_tocke; ?> točk
                </div>
                <div>2. Mesto</div>
            </div>
        <?php endif; ?>

        <div class="mesto mesto-1">
            <div class="mesto-ime">
                <?php echo implode("<br>in<br>", $zmagovalci_1_mesto); ?>
            </div>
            <div class="mesto-tocke">
                <?php echo $zlato_tocke; ?> točk
            </div>
            <div>1. Mesto</div>
        </div>

        <?php if ($bron_tocke !== null && count($zmagovalci_3_mesto) > 0): ?>
            <div class="mesto mesto-3">
                <div class="mesto-ime">
                    <?php echo implode("<br>in<br>", $zmagovalci_3_mesto); ?>
                </div>
                <div class="mesto-tocke">
                    <?php echo $bron_tocke; ?> točk
                </div>
                <div>3. Mesto</div>
            </div>
        <?php endif; ?>

    </div>

    <a href="index.php" class="btn btn-nazaj">Nazaj na vnos igralcev (Nova igra)</a>
</div>

</body>
</html>