<?php
// rezultati.php
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
    <title>2. Stran: Rezultati metov</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Rezultati igre</h1>
    
    <?php foreach ($_SESSION['igralci'] as $igralec): ?>
        <div class='igralec-rezultat'>
            <h2><?php echo $igralec['ime'] . " " . $igralec['priimek']; ?></h2>
            <p>
                <?php foreach ($igralec['meti'] as $kocka): ?>
                    <img class='kocka-img animirana-kocka' 
                         src='images/dice-anim.gif' alt='Kocka'>
                         data-rezultat='images/dice<?php echo $kocka; ?>.gif' 
                         alt='Kocka'>
                <?php endforeach; ?>
            </p>
            <p class="skupna-vsota" style="display: none;">
                <strong>Skupna vsota:</strong> <?php echo $igralec['vsota']; ?>
            </p>
        </div>
    <?php endforeach; ?>

    <p style="text-align: center; font-weight: bold; color: #dc3545; font-size: 1.2rem; margin-top: 20px;">
        Razglasitev zmagovalcev čez <span id="sekunde">10</span> sekund...
    </p>

    <a href="zmagovalci.php" class="btn">Preskoči in pokaži stopničke!</a>
</div>

<script>
    var preostaliCas = 10;
    var element = document.getElementById('sekunde');

    setTimeout(function() {
        var kocke = document.querySelectorAll('.animirana-kocka');
        kocke.forEach(function(kocka) {
            var pravaSlika = kocka.getAttribute('data-rezultat');
            kocka.src = pravaSlika;
        });

        var vsote = document.querySelectorAll('.skupna-vsota');
        vsote.forEach(function(vsota) {
            vsota.style.display = 'block';
        });
    }, 2000); 
    
    setInterval(function() {
        preostaliCas--;
        if(preostaliCas > 0) {
            element.innerText = preostaliCas;
        }
    }, 1000);

    setTimeout(function() {
        window.location.href = 'zmagovalci.php';
    }, 10000);
</script>

</body>
</html>