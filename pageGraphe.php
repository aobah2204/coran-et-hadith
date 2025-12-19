
<html>

<head>
    <title>محلل القرآن - Coran parser</title>

    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    .graph-container {
        width: 100%;
        overflow-x: auto;
    }
    canvas {
        min-width: 3000px; /* scroll horizontal */
    }
    </style>
</head>
<body>
    <div class="header">
        <h1>Analyse des poids des sourates du Coran</h1>
    </div>

    <?php
    // Données pour l'histogramme (valeurs et étiquettes)
    $donnees = [10140,1818029,1052855,1113491,821878,930389,1050773,375107,735087,534261,535621,495245,238669,263095,179801,556066,471566,494144,280588,385536,350552,363694,342779,413062,291924,390837,333434,397723,273736,268114,155328,110745,376449,253797,244441,216958,259413,227609,364045,359685,236078,244062,253605,96220,153550,191798,180365,182014,101737,107336,116924,93950,106400,118781,128320,124594,189051,131534,129491,99289,62118,60193,53904,79130,89897,86042,102559,91340,84339,71001,75841,66977,67626,87063,49423,74040,72318,53733,60134,47492,40971,26959,57302,33607,33523,17323,26018,31683,48475,20989,19714,29298,13171,13176,10994,21138,7441,28751,17342,14104,10617,11140,5512,6632,6235,6424,9961,3535,4597,6895,6169,1786,9448,5660];
    $etiquettes = [ "Al-Fatiha (L'Ouverture)","Al-Baqara (La Vache)","Al-Imran (La Famille d'Imran)",
    "An-Nisa (Les Femmes)","Al-Ma'ida (La Table servie)","Al-An'am (Les Bestiaux)","Al-A'raf (Le Mur d'A'raf)",
    "Al-Anfal (Le Butin)","At-Tawba (Le Repentir)","Yunus (Jonas)","Hud (Hud)","Yusuf (Joseph)","Ar-Ra'd (Le Tonnerre)",
    "Ibrahim (Abraham)","Al-Hijr (Al-Hijr)","An-Nahl (Les Abeilles)","Al-Isra (Le Voyage nocturne)","Al-Kahf (La Caverne)",
    "Maryam (Marie)","Ta-Ha (Ta-Ha)","Al-Anbiya (Les Prophètes)","Al-Hajj (Le Pèlerinage)","Al-Mu’minun (Les Croyants)",
    "An-Nur (La Lumière)","Al-Furqan (Le Discernement)","Ash-Shu'ara (Les Poètes)","An-Naml (Les Fourmis)","Al-Qasas (Le Récit)",
    "Al-Ankabut (L'Araignée)","Ar-Rum (Les Romains)","Luqman (Luqman)","As-Sajda (La Prosternation)","Al-Ahzab (Les Coalisés)",
    "Saba (Saba)","Fatir (Le Créateur)","Ya-Sin (Ya-Sin)","As-Saffat (Les Rangés en Rangs)","Sad (Sad)","Az-Zumar (Les Groupes)",
    "Ghafir (Le Pardonneur)","Fussilat (Les Versets détaillés)","Ash-Shura (La Consultation)","Az-Zukhruf (Les Ornements)",
    "Ad-Dukhan (La Fumée)","Al-Jathiya (L'Agenouillée)","Al-Ahqaf (Les Dunes)","Muhammad (Muhammad)",
    "Al-Fath (La Victoire éclatante)","Al-Hujurat (Les Appartements)","Qaf (Qaf)","Adh-Dhariyat (Qui éparpillent)",
    "At-Tur (La Montagne)","An-Najm (L'Étoile)","Al-Qamar (La Lune)","Ar-Rahman (Le Tout Miséricordieux)",
    "Al-Waqi'a (L'Événement)","Al-Hadid (Le Fer)","Al-Mujadila (La Discussion)","Al-Hashr (L'Exode)","Al-Mumtahina (L'Éprouvée)",
    "As-Saff (Le Rang)","Al-Jumua (Le Vendredi)","Al-Munafiqun (Les Hypocrites)","At-Taghabun (La Grande Perte)",
    "At-Talaq (Le Divorce)","At-Tahrim (L'Interdiction)","Al-Mulk (La Royauté)","Al-Qalam (La Plume)","Al-Haqqa (La Réalité)",
    "Al-Ma'arij (Les Voies d'Ascension)","Nuh (Noé)","Al-Jinn (Les Djinns)","Al-Muzzammil (L'Enveloppé)",
    "Al-Muddathir (Le Revêtu d'un manteau)","Al-Qiyama (La Résurrection)","Al-Insan (L'Homme)","Al-Mursalat (Les Envoyés)",
    "An-Naba (La Nouvelle)","An-Naziat (Les Anges qui arrachent les âmes)","Abasa (Il s'est renfrogné)",
    "At-Takwir (L'Obscurcissement)","Al-Infitar (La Rupture)","Al-Mutaffifin (Les Fraudeurs)","Al-Inshiqaq (La Déchirure)",
    "Al-Buruj (Les Constellations)","At-Tariq (L'Astre Nocturne)","Al-Ala (Le Très Haut)","Al-Ghashiya (L'Écrasante)",
    "Al-Fajr (L'Aube)","Al-Balad (La Cité)","Ash-Shams (Le Soleil)","Al-Lail (La Nuit)","Ad-Duha (Le Jour Montant)","Ash-Sharh ",
    "(L'Ouverture)","At-Tin (Le Figuier)","Al-Alaq (L'Adhérence)","Al-Qadr (La Destinée)","Al-Bayyina (La Preuve)",
    "Az-Zalzalah (Le Tremblement de terre)","Al-Adiyat (Les Coursiers)","Al-Qaria (Le Fracas)",
    "At-Takathur (La Course aux richesses)","Al-Asr (Le Temps)","Al-Humaza (Les Calomniateurs)","Al-Fil (L'Éléphant)",
    "Quraysh (Les Quraysh)","Al-Ma'un (L'Ustensile)","Al-Kawthar (L'Abondance)","Al-Kafirun (Les Infidèles)","An-Nasr (Le Secours)",
    "Al-Masad (Les Fibres)","Al-Ikhlas (Le Monothéisme pur)","Al-Falaq (L'Aube naissante)","An-Nas (Les Hommes)"];

    $sourates_names = [
    "Al-Fatiha",
    "Al-Baqara",
    "Al-Imran",
    "An-Nisa",
    "Al-Ma'idah",
    "Al-An'am",
    "Al-A'raf",
    "Al-Anfal",
    "At-Tawbah",
    "Yunus",
    "Hud",
    "Yusuf",
    "Ar-Ra'd",
    "Ibrahim",
    "Al-Hijr",
    "An-Nahl",
    "Al-Isra",
    "Al-Kahf",
    "Maryam",
    "Taha",
    "Al-Anbiya",
    "Al-Hajj",
    "Al-Mu’minun",
    "An-Nur",
    "Al-Furqan",
    "Ash-Shu'ara",
    "An-Naml",
    "Al-Qasas",
    "Al-Ankabut",
    "Ar-Rum",
    "Luqman",
    "As-Sajda",
    "Al-Ahzab",
    "Saba",
    "Fatir",
    "Ya-Sin",
    "As-Saffat",
    "Sad",
    "Az-Zumar",
    "Ghafir",
    "Fussilat",
    "Ash-Shura",
    "Az-Zukhruf",
    "Ad-Dukhan",
    "Al-Jathiyah",
    "Al-Ahqaf",
    "Muhammad",
    "Al-Fath",
    "Al-Hujurat",
    "Qaf",
    "Adh-Dhariyat",
    "At-Tur",
    "An-Najm",
    "Al-Qamar",
    "Ar-Rahman",
    "Al-Waqi'ah",
    "Al-Hadid",
    "Al-Mujadila",
    "Al-Hashr",
    "Al-Mumtahanah",
    "As-Saff",
    "Al-Jumu'ah",
    "Al-Munafiqun",
    "At-Taghabun",
    "At-Talaq",
    "At-Tahrim",
    "Al-Mulk",
    "Al-Qalam",
    "Al-Haqqah",
    "Al-Ma'arij",
    "Nuh",
    "Al-Jinn",
    "Al-Muzzammil",
    "Al-Muddaththir",
    "Al-Qiyamah",
    "Al-Insan",
    "Al-Mursalat",
    "An-Naba",
    "An-Nazi'at",
    "Abasa",
    "At-Takwir",
    "Al-Infitar",
    "Al-Mutaffifin",
    "Al-Inshiqaq",
    "Al-Buruj",
    "At-Tariq",
    "Al-A'la",
    "Al-Ghashiyah",
    "Al-Fajr",
    "Al-Balad",
    "Ash-Shams",
    "Al-Layl",
    "Ad-Duha",
    "Ash-Sharh",
    "At-Tin",
    "Al-Alaq",
    "Al-Qadr",
    "Al-Bayyinah",
    "Az-Zalzalah",
    "Al-Adiyat",
    "Al-Qari'ah",
    "At-Takathur",
    "Al-Asr",
    "Al-Humazah",
    "Al-Fil",
    "Quraysh",
    "Al-Ma'un",
    "Al-Kawthar",
    "Al-Kafirun",
    "An-Nasr",
    "Al-Masad",
    "Al-Ikhlas",
    "Al-Falaq",
    "An-Nas"
    ];

    $versets = [
    7, 286, 200, 176, 120, 165, 206, 75, 129, 109, 
    123, 111, 43, 52, 99, 128, 111, 110, 98, 135, 
    112, 78, 118, 64, 77, 227, 93, 88, 69, 60, 
    34, 30, 73, 54, 45, 83, 182, 88, 75, 85, 
    54, 53, 89, 59, 37, 35, 38, 29, 18, 45, 
    60, 49, 62, 55, 78, 96, 29, 22, 24, 13, 
    14, 11, 11, 18, 12, 12, 30, 52, 52, 44, 
    28, 28, 20, 56, 40, 31, 50, 40, 46, 42, 
    29, 19, 36, 25, 22, 17, 19, 26, 30, 20, 
    15, 21, 11, 11, 8, 8, 19, 5, 8, 8, 
    11, 11, 8, 3, 9, 5, 4, 7, 3, 6, 
    3, 5, 4, 5, 6
    ];


    ?>
    <div style="width:100%; height:50%;">
        <canvas id="histogramme_poids" height="1500"></canvas>
    </div>

    <div><h2> Graphes nombres de versets par sourate </h2></div>

    <div style="width:100%; height:50%;">
        <canvas id="histogramme_versets" height="1500"></canvas>
    </div> 

    <script>
        const ctx = document.getElementById('histogramme_poids').getContext('2d');        
        const histogramme = new Chart(ctx, {
            type: 'bar',
            options: {
                indexAxis: 'y'
            },
            data: {
                labels: <?php echo json_encode(array_reverse($etiquettes)); ?>,
                datasets: [{
                    label: 'Poids des sourates du Coran',
                    data: <?php echo json_encode(array_reverse($donnees)); ?>,
                    backgroundColor: 'rgba(54, 163, 235, 0.9)',
                    borderColor: 'rgba(54, 235, 160, 1)',
                    //barThickness: 3,        // 🔥 épaisseur fine (trait)
                    //maxBarThickness: 2,
                    //categoryPercentage: 1.0,  // 🔥 utilise 100% de l’espace
                    //barPercentage: 1.0        // 🔥 supprime l’espace entre barres
                }]
            },
            options: {
                animation: false,
                plugins: {
                    legend: {
                        display: false // 🔴 enlever la légende
                    }
                },
                scales: {
                    x: {
                        display: false // 🔴 enlever labels X  
                        //offset: false // 🔥 enlève le padding aux extrémités                      
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: false,
                maintainAspectRatio: false
            }
        });
    </script>    

    <script>
        const ctx = document.getElementById('histogramme_versets').getContext('2d');
        const histogramme = new Chart(ctx, {
            type: 'bar',
            options: {
                indexAxis: 'y'
            },
            data: {
                labels: <?php echo json_encode(array_reverse($sourates_names)); ?>,
                datasets: [{
                    label: 'Poids des sourates du Coran',
                    data: <?php echo json_encode(array_reverse($versets)); ?>,
                    backgroundColor: 'rgba(54, 163, 235, 0.9)',
                    borderColor: 'rgba(54, 235, 160, 1)',
                    //barThickness: 3,        // 🔥 épaisseur fine (trait)
                    //maxBarThickness: 2,
                    //categoryPercentage: 1.0,  // 🔥 utilise 100% de l’espace
                    //barPercentage: 1.0        // 🔥 supprime l’espace entre barres
                }]
            },
            options: {
                animation: false,
                plugins: {
                    legend: {
                        display: false // 🔴 enlever la légende
                    }
                },
                scales: {
                    x: {
                        display: false // 🔴 enlever labels X  
                        //offset: false // 🔥 enlève le padding aux extrémités                      
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: false,
                maintainAspectRatio: false
            }
        });
    </script>    

    <div class=footer>
        <img class=logo src='coran_transp.png'>
        <p>@Author: Bah Amadou Oury</p>
    </div>
</body>
</html>


<!--<div style="width:100%; height:3000px; overflow:hidden; position:center">
            <canvas id="histogramme" height="500"></canvas>
        </div>-->
    
    

    