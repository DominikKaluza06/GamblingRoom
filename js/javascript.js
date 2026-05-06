var steviloIgralcev = 3;
var vrgliIgralci = 0;
var timerZagnan = false;


// Funkcija za met kock posameznega igralca

function vrziKocke(index) {
    // Poiščemo elemente za specifičnega igralca
    var playerDiv = document.getElementById('player-' + index);
    var diceArea = document.getElementById('dice-area-' + index);
    var button = playerDiv.querySelector('.roll-btn');
    var kocke = diceArea.querySelectorAll('.kocka-img');
    var vsotaPrikaz = diceArea.querySelector('.skupna-vsota');

    // 1. Prikaži kocke in onemogoči gumb
    diceArea.style.visibility = 'visible';
    button.disabled = true;
    button.innerText = "Kocke se vrtijo...";

    // 2. Simulacija vrtenja (2 sekundi animacije)
    setTimeout(function() {
        kocke.forEach(function(kocka) {
            // Preberemo pot do statične slike iz data-rezultat
            var rezultatPath = kocka.getAttribute('data-rezultat');
            if (rezultatPath) {
                kocka.src = rezultatPath;
            }
        });

        // Prikaži končno vsoto točk
        if (vsotaPrikaz) {
            vsotaPrikaz.style.display = 'block';
        }
        
        button.innerText = "Končano";
        
        // 3. Števec igralcev in proženje glavnega timerja
        vrgliIgralci++;
        if (vrgliIgralci === steviloIgralcev) {
            startajGlavniTimer();
        }
    }, 2000);
}

/**
 * Funkcija za končno odštevanje do zmagovalcev
 */
function startajGlavniTimer() {
    if (timerZagnan) return;
    timerZagnan = true;

    // Prikaži spodnje obvestilo
    var obvestilo = document.getElementById('timer-obvestilo');
    if (obvestilo) {
        obvestilo.style.display = 'block';
    }

    var preostaliCas = 10;
    var elementSekunde = document.getElementById('sekunde');

    var interval = setInterval(function() {
        preostaliCas--;
        
        if (elementSekunde) {
            elementSekunde.innerText = preostaliCas;
        }

        if (preostaliCas <= 0) {
            clearInterval(interval);
            window.location.href = 'zmagovalci.php';
        }
    }, 1000);
}