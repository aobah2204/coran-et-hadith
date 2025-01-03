<?php
// Nettoyer le tampon de sortie
ob_clean();
header('Content-Type: image/png');

// Définir la largeur et la hauteur de l'image
$largeur = 1600;
$hauteur = 700;

// Créer une nouvelle image
$image = imagecreatetruecolor($largeur, $hauteur);

// Définir les couleurs
$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 0, 0, 0);
$rouge = imagecolorallocate($image, 255, 0, 0);
$vert = imagecolorallocate($image, 0, 255, 0);
$bleu = imagecolorallocate($image, 0, 0, 255);

// Remplir le fond avec du blanc
imagefill($image, 0, 0, $blanc);


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

// Dessiner les barres de l'histogramme
$largeurBarre = 10;
$espace = 4;

$donnees = normalizeArray($donnees);

for ($i = 0; $i < count($donnees); $i++) {
    $x1 = $i * ($largeurBarre + $espace) + $espace;
    $y1 = $hauteur - $donnees[$i];
    $x2 = $x1 + $largeurBarre;
    $y2 = $hauteur;

    // Choisir une couleur différente pour chaque barre
    $couleur = [$rouge, $vert, $bleu, $noir][$i % 4];

    // Dessiner la barre
    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $couleur);

    // Ajouter l'étiquette sous la barre
    imagestring($image, 5, $x1 + 5, $y2 + 5, $etiquettes[$i], $rouge);
}

// Envoyer l'image au navigateur
imagepng($image);

// Libérer la mémoire
imagedestroy($image);

// Arrêter le script
exit();

/// normalisation des données
function normalizeArray($array) {
    $min = min($array);
    $max = max($array);
    $normalizedArray = [];

    foreach ($array as $value) {
        $normalizedValue = round((($value - $min) / ($max - $min)) * 1000);
        $normalizedArray[] = $normalizedValue;
    }

    return $normalizedArray;
}
?>