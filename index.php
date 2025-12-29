
<html>

<head>
    <title>محلل القرآن - Coran parser</title>

    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">    
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@700&display=swap" rel="stylesheet">

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
    <div class=header>        
        <!-- <h2 class=titre> اللَّهُ نَزَّلَ أَحسَنَ الحَديثِ كِتٰبًا مُتَشٰبِهًا مَثانِىَ تَقشَعِرُّ مِنهُ جُلودُ الَّذينَ يَخشَونَ رَبَّهُم ثُمَّ تَلينُ جُلودُهُم وَقُلوبُهُم إِلىٰ ذِكرِ اللَّهِ ذٰلِكَ هُدَى اللَّهِ يَهدى بِهِ مَن يَشاءُ وَمَن يُضلِلِ اللَّهُ فَما لَهُ مِن هادٍ </h2> -->
        <div class=marquee-rtl>
            <h3 class=titre>Coran parser - محلل القرآن</h3>
            <!--<div>Liser et Explorer facilement le coran</div>
            <img class=logo_grand src='coran_wall_large_paper.jpg' ></br>-->
        </div>
        <?php 
            $List_sourates_french = [
                1 => "Al-Fātiḥa",
                2 => "Al-Baqara",
                3 => "Āl ʿImrān",
                4 => "An-Nisāʾ",
                5 => "Al-Māʾida",
                6 => "Al-Anʿām",
                7 => "Al-Aʿrāf",
                8 => "Al-Anfāl",
                9 => "At-Tawba",
                10 => "Yūnus",
                11 => "Hūd",
                12 => "Yūsuf",
                13 => "Ar-Raʿd",
                14 => "Ibrāhīm",
                15 => "Al-Ḥijr",
                16 => "An-Naḥl",
                17 => "Al-Isrāʾ",
                18 => "Al-Kahf",
                19 => "Maryam",
                20 => "Ṭā-Hā",
                21 => "Al-Anbiyāʾ",
                22 => "Al-Ḥajj",
                23 => "Al-Muʾminūn",
                24 => "An-Nūr",
                25 => "Al-Furqān",
                26 => "Ash-Shuʿarāʾ",
                27 => "An-Naml",
                28 => "Al-Qaṣaṣ",
                29 => "Al-ʿAnkabūt",
                30 => "Ar-Rūm",
                31 => "Luqmān",
                32 => "As-Sajda",
                33 => "Al-Aḥzāb",
                34 => "Sabaʾ",
                35 => "Fāṭir",
                36 => "Yā-Sīn",
                37 => "Aṣ-Ṣāffāt",
                38 => "Ṣād",
                39 => "Az-Zumar",
                40 => "Ghāfir",
                41 => "Fuṣṣilat",
                42 => "Ash-Shūrā",
                43 => "Az-Zukhruf",
                44 => "Ad-Dukhān",
                45 => "Al-Jāthiya",
                46 => "Al-Aḥqāf",
                47 => "Muḥammad",
                48 => "Al-Fatḥ",
                49 => "Al-Ḥujurāt",
                50 => "Qāf",
                51 => "Adh-Dhāriyāt",
                52 => "Aṭ-Ṭūr",
                53 => "An-Najm",
                54 => "Al-Qamar",
                55 => "Ar-Raḥmān",
                56 => "Al-Wāqiʿa",
                57 => "Al-Ḥadīd",
                58 => "Al-Mujādila",
                59 => "Al-Ḥashr",
                60 => "Al-Mumtaḥana",
                61 => "Aṣ-Ṣaff",
                62 => "Al-Jumuʿa",
                63 => "Al-Munāfiqūn",
                64 => "At-Taghābun",
                65 => "Aṭ-Ṭalāq",
                66 => "At-Taḥrīm",
                67 => "Al-Mulk",
                68 => "Al-Qalam",
                69 => "Al-Ḥāqqa",
                70 => "Al-Maʿārij",
                71 => "Nūḥ",
                72 => "Al-Jinn",
                73 => "Al-Muzzammil",
                74 => "Al-Muddaththir",
                75 => "Al-Qiyāma",
                76 => "Al-Insān",
                77 => "Al-Mursalāt",
                78 => "An-Nabaʾ",
                79 => "An-Nāziʿāt",
                80 => "ʿAbasa",
                81 => "At-Takwīr",
                82 => "Al-Infiṭār",
                83 => "Al-Muṭaffifīn",
                84 => "Al-Inshiqāq",
                85 => "Al-Burūj",
                86 => "Aṭ-Ṭāriq",
                87 => "Al-Aʿlā",
                88 => "Al-Ghāshiya",
                89 => "Al-Fajr",
                90 => "Al-Balad",
                91 => "Ash-Shams",
                92 => "Al-Layl",
                93 => "Aḍ-Ḍuḥā",
                94 => "Ash-Sharḥ",
                95 => "At-Tīn",
                96 => "Al-ʿAlaq",
                97 => "Al-Qadr",
                98 => "Al-Bayyina",
                99 => "Az-Zalzala",
                100 => "Al-ʿĀdiyāt",
                101 => "Al-Qāriʿa",
                102 => "At-Takāthur",
                103 => "Al-ʿAṣr",
                104 => "Al-Humaza",
                105 => "Al-Fīl",
                106 => "Quraysh",
                107 => "Al-Māʿūn",
                108 => "Al-Kawthar",
                109 => "Al-Kāfirūn",
                110 => "An-Naṣr",
                111 => "Al-Masad",
                112 => "Al-Ikhlāṣ",
                113 => "Al-Falaq",
                114 => "An-Nās"
            ];

            $List_sourates_arabe = [
                1 => "الفاتحة",
                2 => "البقرة",
                3 => "آل عمران",
                4 => "النساء",
                5 => "المائدة",
                6 => "الأنعام",
                7 => "الأعراف",
                8 => "الأنفال",
                9 => "التوبة",
                10 => "يونس",
                11 => "هود",
                12 => "يوسف",
                13 => "الرعد",
                14 => "إبراهيم",
                15 => "الحجر",
                16 => "النحل",
                17 => "الإسراء",
                18 => "الكهف",
                19 => "مريم",
                20 => "طه",
                21 => "الأنبياء",
                22 => "الحج",
                23 => "المؤمنون",
                24 => "النور",
                25 => "الفرقان",
                26 => "الشعراء",
                27 => "النمل",
                28 => "القصص",
                29 => "العنكبوت",
                30 => "الروم",
                31 => "لقمان",
                32 => "السجدة",
                33 => "الأحزاب",
                34 => "سبأ",
                35 => "فاطر",
                36 => "يس",
                37 => "الصافات",
                38 => "ص",
                39 => "الزمر",
                40 => "غافر",
                41 => "فصلت",
                42 => "الشورى",
                43 => "الزخرف",
                44 => "الدخان",
                45 => "الجاثية",
                46 => "الأحقاف",
                47 => "محمد",
                48 => "الفتح",
                49 => "الحجرات",
                50 => "ق",
                51 => "الذاريات",
                52 => "الطور",
                53 => "النجم",
                54 => "القمر",
                55 => "الرحمن",
                56 => "الواقعة",
                57 => "الحديد",
                58 => "المجادلة",
                59 => "الحشر",
                60 => "الممتحنة",
                61 => "الصف",
                62 => "الجمعة",
                63 => "المنافقون",
                64 => "التغابن",
                65 => "الطلاق",
                66 => "التحريم",
                67 => "الملك",
                68 => "القلم",
                69 => "الحاقة",
                70 => "المعارج",
                71 => "نوح",
                72 => "الجن",
                73 => "المزمل",
                74 => "المدثر",
                75 => "القيامة",
                76 => "الإنسان",
                77 => "المرسلات",
                78 => "النبأ",
                79 => "النازعات",
                80 => "عبس",
                81 => "التكوير",
                82 => "الإنفطار",
                83 => "المطففين",
                84 => "الإنشقاق",
                85 => "البروج",
                86 => "الطارق",
                87 => "الأعلى",
                88 => "الغاشية",
                89 => "الفجر",
                90 => "البلد",
                91 => "الشمس",
                92 => "الليل",
                93 => "الضحى",
                94 => "الشرح",
                95 => "التين",
                96 => "العلق",
                97 => "القدر",
                98 => "البينة",
                99 => "الزلزلة",
                100 => "العاديات",
                101 => "القارعة",
                102 => "التكاثر",
                103 => "العصر",
                104 => "الهمزة",
                105 => "الفيل",
                106 => "قريش",
                107 => "الماعون",
                108 => "الكوثر",
                109 => "الكافرون",
                110 => "النصر",
                111 => "المسد",
                112 => "الإخلاص",
                113 => "الفلق",
                114 => "الناس"
            ];

            // Valeur sélectionnée (par défaut vide)
            $sourateArabeSelectionnee = $_POST['sourate_arabe'] ?? '';
            $sourateFrenchSelectionnee = $_POST['sourate_french'] ?? '';  
            $page = 0;
        
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

            <!-- SECTION 1 : NAVIGATION & SOURATES -->
            <div class="menu-card">

                <h2 class="menu-card-title">📖 Navigation</h2>

                <div class="menu-group">
                    <label for="page">Page</label>
                    <select name="page" id="page" onchange="this.form.submit()">
                        <?php for ($i = 0; $i <= 604; $i++): ?>
                            <option value="<?= $i ?>">
                                <?= ($page === $i) ? 'selected' : '' ?>
                                Page <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="menu-group">
                    <label for="sourate_arabe">Sourate (Arabe)</label>
                    <select onchange="this.form.submit()" name="sourate_arabe" id="sourate_arabe">
                        <option value="">Choisir une sourate</option>
                        <?php foreach ($List_sourates_arabe as $numero => $nom): ?>
                            <option value="<?= $numero ?>">
                                <?= ($sourateArabeSelectionnee == $numero) ? 'selected' : '' ?>
                                <?= $numero ?> - <?= $nom ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="menu-group">
                    <label for="sourate_french">Sourate (Français)</label>
                    <select onchange="this.form.submit()" name="sourate_french" id="sourate_french">
                        <option value="">Choisir une sourate</option>
                        <?php foreach ($List_sourates_french as $numero => $nom): ?>
                            <option value="<?= $numero ?>">
                                <?= ($sourateFrenchSelectionnee == $numero) ? 'selected' : '' ?>
                                <?= $numero ?> - <?= $nom ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <!-- SECTION 2 : RECHERCHE -->
            <div class="menu-card">

                <h2 class="menu-card-title">🔍 Recherche</h2>

                <div class="menu-group">
                    <label>Coran</label>
                    <input onchange="this.form.submit()" type="text" name="word" placeholder="أدخل الكلمة">
                    <input onchange="this.form.submit()" type="text" name="word_french" placeholder="Saisir le mot">
                </div>

                <div class="menu-group">
                    <label>Hadiths</label>
                    <input onchange="this.form.submit()" type="text" name="word_french_jv" placeholder="Saisir le mot">
                </div>

            </div>

        </form>

    </div>
    

    <div class=parchemin >
        <div class=text_ar>
            <?php    

            // Variables Globales
            $asma_ar = ["ٱللَّهُ","ٱللَّهِ","ٱللَّهَ","هُوَ","هُوَ ٱلَّذِىٓ","ٱلْحَىُّ","ٱلْقَيُّومُ","رَبَّنَآ","لِلَّهِ","رَبِّ","الرَّحْمَنِ","الرَّحِيمِ","مَالِكِ","عَزِيزٌ","ٱلْعَزِيزُ","ٱلْحَكِيمُ","شَدِيدُ ٱلْعِقَابِ","بَصِيرٌۢ","سَرِيعُ ٱلْحِسَابِ","قَدِيرٌۭ","رَءُوفٌۢ","رَّحِيمٌ",
                        "ٱلسَّمِيعُ","ٱلْعَلِيمُ","سَمِيعُ ٱلدُّعَآءِ","وَلِىُّ","وَٰسِعٌ","عَلِيمٌۭ","ذُو ٱلْفَضْلِ ٱلْعَظِيمِ","غَفُورٌۭ"];
                
            $asma_fr = ["Allah","Le Tout-Miséricordieux","Le Très-Miséricordieux","Le Souverain","Le Très-Saint", "La Paix","Le Garant","Le Protecteur","Le Tout-Puissant","Le Contraignant","Le Suprême",
                    "Le Créateur","Le Façonneur","Celui qui donne forme","Le Très-Pardonnant", "Le Dominateur absolu","Le Donateur","Le Pourvoyeur","Celui qui accorde la victoire",
                    "L'Omniscient","Celui qui restreint","Celui qui étend","Celui qui abaisse","Celui qui élève", "Celui qui honore","Celui qui avilit","L'Audient","Le Clairvoyant","Le Juge","Le Juste",
                    "Le Subtil","Le Parfaitement informé","Le Très-Doux","L'Immense","Le Très-Clément", "Le Très-Reconnaissant","Le Très-Haut","Le Très-Grand","Le Préservateur","Celui qui nourrit",
                    "Celui qui suffit","Le Majestueux","Le Très-Généreux","Le Vigilant","Celui qui répond","L'Incommensurable","Le Sage","Le Très-Aimant","Le Glorieux","Celui qui ressuscite",
                    "Le Témoin","La Vérité","Le Garant","Le Très-Fort","Le Robuste","Le Protecteur","Le Digne de louange","Celui qui dénombre","Celui qui fait apparaître","Celui qui redonne vie",
                    "Celui qui donne la vie","Celui qui donne la mort","Le Vivant","Celui qui subsiste par Lui-même", "Celui qui possède toute chose","Le Noble","L'Unique","L'Un","L'Absolu","Le Tout-Puissant",
                    "L'Omnipotent","Celui qui avance","Celui qui retarde","Le Premier","Le Dernier","L'Apparent", "Le Caché","Le Maître absolu","Le Très-Élevé","Le Bienfaiteur","Celui qui accepte le repentir",
                    "Le Vengeur","L'Indulgent","Très-Clément","Maître du Royaume","Détenteur de Majesté et de Générosité", "L'Équitable","Celui qui rassemble","Le Suffisant","Celui qui enrichit","Celui qui empêche",
                    "Celui qui afflige","Celui qui accorde le bien","La Lumière","Le Guide","L'Incomparable","Le Permanent","L'Héritier","Le Guide vers la droiture","Le Patient"];
            
            
            
            ## including the file of coran
            #include 'quran-uthmani-min.txt';

            ## FunctionRead and print the coran text 
            function read_coran(){
                $fh = fopen('coran-full-haraka.txt', 'r');
                $result = '';
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden; font-family:Scheherazade New, serif; direction:rtl; text-align:justify;">';
                while(!feof($fh)){
                    $line = fgets($fh);
                    $line_splits = explode("|",$line);
                    
                    
                    $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';

                }
                echo $style.$result;
            }

            ## Lecture du coran en français
            function read_sourate_french($num_sourate_french){
                # Ouverture du fichier coran français
                $coran_french = fopen('CoranFrancais_clean.txt', 'r');

                $result ='';
                $title = '<div style="font-size:1.55em;color:blue;font-weight:bold;">Sourate '.$num_sourate_french.'</div></br></br>';
                $asma_fr = ["Allah","Le Tout-Miséricordieux","Le Très-Miséricordieux","Le Souverain","Le Très-Saint", "La Paix","Le Garant","Le Protecteur","Le Tout-Puissant","Le Contraignant","Le Suprême",
                    "Le Créateur","Le Façonneur","Celui qui donne forme","Le Très-Pardonnant", "Le Dominateur absolu","Le Donateur","Le Pourvoyeur","Celui qui accorde la victoire",
                    "L'Omniscient","Celui qui restreint","Celui qui étend","Celui qui abaisse","Celui qui élève", "Celui qui honore","Celui qui avilit","L'Audient","Le Clairvoyant","Le Juge","Le Juste",
                    "Le Subtil","Le Parfaitement informé","Le Très-Doux","L'Immense","Le Très-Clément", "Le Très-Reconnaissant","Le Très-Haut","Le Très-Grand","Le Préservateur","Celui qui nourrit",
                    "Celui qui suffit","Le Majestueux","Le Très-Généreux","Le Vigilant","Celui qui répond","L'Incommensurable","Le Sage","Le Très-Aimant","Le Glorieux","Celui qui ressuscite",
                    "Le Témoin","La Vérité","Le Garant","Le Très-Fort","Le Robuste","Le Protecteur","Le Digne de louange","Celui qui dénombre","Celui qui fait apparaître","Celui qui redonne vie",
                    "Celui qui donne la vie","Celui qui donne la mort","Le Vivant","Celui qui subsiste par Lui-même", "Celui qui possède toute chose","Le Noble","L'Unique","L'Un","L'Absolu","Le Tout-Puissant",
                    "L'Omnipotent","Celui qui avance","Celui qui retarde","Le Premier","Le Dernier","L'Apparent", "Le Caché","Le Maître absolu","Le Très-Élevé","Le Bienfaiteur","Celui qui accepte le repentir",
                    "Le Vengeur","L'Indulgent","Très-Clément","Maître du Royaume","Détenteur de Majesté et de Générosité", "L'Équitable","Celui qui rassemble","Le Suffisant","Celui qui enrichit","Celui qui empêche",
                    "Celui qui afflige","Celui qui accorde le bien","La Lumière","Le Guide","L'Incomparable","Le Permanent","L'Héritier","Le Guide vers la droiture","Le Patient"];
            
                while(!feof($coran_french)){
                    $line =fgets($coran_french);
                    $line_splits = explode(".",$line);
                    #echo $num_sourate_french; echo "<------->"; echo $line_splits[2];  echo '<br/>';
                    if(count($line_splits) > 2  && strcmp($line_splits[0],$num_sourate_french)==0){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.55em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                    }
                }
                $result = $title.$result;
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;">';

                foreach ($asma_fr as $mot) {
                    $result = str_replace($mot, "<span style='color:blue;'>$mot</span>", $result);
                }
                echo $style.$result.'</div>';
            }

            # Lecture d'un versert d'une sourate en français
            function read_verset_french($num_sourate, $num_ayat){
                # Ouverture du fichier coran français
                $coran_french = fopen('CoranFrancais_clean.txt', 'r');

                $result ='';

                while(!feof($coran_french)){
                    $line =fgets($coran_french);
                    $line_splits = explode(".",$line);
                    #echo $num_sourate_french; echo "<------->"; echo $line_splits[2];  echo '<br/>';
                    if(count($line_splits) > 2  && strcmp($line_splits[0],$num_sourate)==0 && strcmp($line_splits[1],$num_ayat)==0){
                        # Récupération du verset complet
                        $Nbr_phrases = count($line_splits);
                        $verset ='';

                        for($i=2; $i<$Nbr_phrases; $i++){
                            $verset = $verset.$line_splits[$i];
                        }
                        #Ajout du verset au resultat
                        $result = $result.'<div style="font-size:1.55em;color:#0e3c68;font-weight:bold;">'.$verset.'</div></br>';
                    }
                }

                return $result;
            }

            # Lecture d'un verset en arabe
            function read_verset_arabe($num_sourate,$num_verset){
                $fh = fopen('coran-full-haraka.txt', 'r');
                $result ='';

                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    if(count($line_splits) > 2  && strcmp($line_splits[0],$num_sourate)==0 && strcmp($line_splits[1],$num_verset)==0){
                        $result = $result.'<div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';                        
                    }
                }

                return $result;
            }

            ## Function search sourate 
            function read_sourate_arabe($num_sourate_arabe){
                $fh = fopen('coran-full-haraka.txt', 'r');
                $result ='';
                #$title = '<div style="font-size:1.55em;color:blue;font-weight:bold;">Sourate '.$num_sourate_arabe.'</div></br></br>';
                $style = "";
                $poids_sourate = 0;
                $sourates_ar = [
                  "سورة الفاتحة",
                  "سورة البقرة",
                  "سورة آل عمران",
                  "سورة النساء",
                  "سورة المائدة",
                  "سورة الأنعام",
                  "سورة الأعراف",
                  "سورة الأنفال",
                  "سورة التوبة",
                  "سورة يونس",
                  "سورة هود",
                  "سورة يوسف",
                  "سورة الرعد",
                  "سورة إبراهيم",
                  "سورة الحجر",
                  "سورة النحل",
                  "سورة الإسراء",
                  "سورة الكهف",
                  "سورة مريم",
                  "سورة طه",
                  "سورة الأنبياء",
                  "سورة الحج",
                  "سورة المؤمنون",
                  "سورة النور",
                  "سورة الفرقان",
                  "سورة الشعراء",
                  "سورة النمل",
                  "سورة القصص",
                  "سورة العنكبوت",
                  "سورة الروم",
                  "سورة لقمان",
                  "سورة السجدة",
                  "سورة الأحزاب",
                  "سورة سبإ",
                  "سورة فاطر",
                  "سورة يس",
                  "سورة الصافات",
                  "سورة ص",
                  "سورة الزمر",
                  "سورة غافر",
                  "سورة فصلت",
                  "سورة الشورى",
                  "سورة الزخرف",
                  "سورة الدخان",
                  "سورة الجاثية",
                  "سورة الأحقاف",
                  "سورة محمد",
                  "سورة الفتح",
                  "سورة الحجرات",
                  "سورة ق",
                  "سورة الذاريات",
                  "سورة الطور",
                  "سورة النجم",
                  "سورة القمر",
                  "سورة الرحمن",
                  "سورة الواقعة",
                  "سورة الحديد",
                  "سورة المجادلة",
                  "سورة الحشر",
                  "سورة الممتحنة",
                  "سورة الصف",
                  "سورة الجمعة",
                  "سورة المنافقون",
                  "سورة التغابن",
                  "سورة الطلاق",
                  "سورة التحريم",
                  "سورة الملك",
                  "سورة القلم",
                  "سورة الحاقة",
                  "سورة المعارج",
                  "سورة نوح",
                  "سورة الجن",
                  "سورة المزمل",
                  "سورة المدثر",
                  "سورة القيامة",
                  "سورة الإنسان",
                  "سورة المرسلات",
                  "سورة النبإ",
                  "سورة النازعات",
                  "سورة عبس",
                  "سورة التكوير",
                  "سورة الانفطار",
                  "سورة المطففين",
                  "سورة الانشقاق",
                  "سورة البروج",
                  "سورة الطارق",
                  "سورة الأعلى",
                  "سورة الغاشية",
                  "سورة الفجر",
                  "سورة البلد",
                  "سورة الشمس",
                  "سورة الليل",
                  "سورة الضحى",
                  "سورة الشرح",
                  "سورة التين",
                  "سورة العلق",
                  "سورة القدر",
                  "سورة البينة",
                  "سورة الزلزلة",
                  "سورة العاديات",
                  "سورة القارعة",
                  "سورة التكاثر",
                  "سورة العصر",
                  "سورة الهمزة",
                  "سورة الفيل",
                  "سورة قريش",
                  "سورة الماعون",
                  "سورة الكوثر",
                  "سورة الكافرون",
                  "سورة النصر",
                  "سورة المسد",
                  "سورة الإخلاص",
                  "سورة الفلق",
                  "سورة الناس"
                ];

                $title = '<div class="titre-sourate">'.$sourates_ar[$num_sourate_arabe-1].'</div>';
                $result = "<div class='page_coran'><div style='padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden; font-size:2.85em;color:#0e3c68;font-weight:bold; font-family:Scheherazade New, serif;direction:rtl; text-align:justify; text-align-last: justify;'>";

                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    
                    if(strcmp($line_splits[0],$num_sourate_arabe)==0){
                        #$result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                        $num_ayah = trim($line_splits[1]); // numéro du verset
                        $result .= $line_splits[2] ." ﴿".$num_ayah."﴾ ";
                        #calcul du poids de la sourate
                        $poids_sourate+=poids_phrase($line_splits[2]);
                    }
                }
                $result .="</div></div>";
                

                echo $style.'<Br/>Poids de la sourate : '.$poids_sourate.'<Br/>';

                # Divible par 19 ?
                if($poids_sourate % 19 === 0)
                    echo "Poids divible par 19 <Br/>";

                # Divible par 7 ?
                if($poids_sourate % 7 === 0)
                    echo "Poids divible par 7 <Br/>";

                # Divible par 12 ?
                if($poids_sourate % 12 === 0)
                    echo "Poids divible par 12 <Br/>";                
                
                
                $asma_ar = ["ٱللَّهُ","ٱللَّهِ","ٱللَّهَ","هُوَ ٱلَّذِىٓ","ٱلْحَىُّ","ٱلْقَيُّومُ","رَبَّنَآ","لِلَّهِ","رَبِّ","الرَّحْمَنِ","الرَّحِيمِ","مَالِكِ","عَزِيزٌ","ٱلْعَزِيزُ","ٱلْحَكِيمُ","شَدِيدُ ٱلْعِقَابِ","بَصِيرٌۢ","سَرِيعُ ٱلْحِسَابِ","قَدِيرٌۭ","رَءُوفٌۢ","رَّحِيمٌ",
                        "ٱلسَّمِيعُ","ٱلْعَلِيمُ","سَمِيعُ ٱلدُّعَآءِ","وَلِىُّ","وَٰسِعٌ","عَلِيمٌۭ","ذُو ٱلْفَضْلِ ٱلْعَظِيمِ","غَفُورٌۭ","رَبَّكَ","حَكِيمٌ "];
                
            
                foreach ($asma_ar as $mot) {
                    $result = str_replace($mot, "<span style='color:green;'>$mot</span>", $result);
                }

                if($num_sourate_arabe != 9){

                    $bismillah_i = "بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ";
                    $bismillah = "</br><span style='font-size:2.85em;color:#0e3c68;font-weight:bold; text-align:right; font-family:Scheherazade New, serif; direction:rtl; text-align:center;'>".$bismillah_i."</span></br>";
                    echo $style.$title.$bismillah_i.$result.'</div>';
                }else{
                    echo $style.$title.$result.'</div>';
                }
                
            }

            ## Fonction de lecture d'une sourate en arabe et français 
            function my_read_sourate($num_sourate){
                # Ouverture des fichiers coran français et arabe
                $coran_french = fopen('CoranFrancais_clean.txt', 'r');
                $fh = fopen('coran-full-haraka.txt', 'r');

                $result ='';
                $title = '<div style="font-size:1.55em;color:blue;font-weight:bold;">Sourate '.$num_sourate_french.'</div></br></br>';

                while(!feof($coran_french) && !feof($fh)){

                    $line_french =fgets($coran_french);
                    $line_splits_french = explode(".",$line_french);                    

                    $line_arabe =fgets($fh);
                    $line_splits_arabe = explode("|",$line_arabe);
                    
                    #echo $num_sourate_french; echo "<------->"; echo $line_splits[2];  echo '<br/>';
                    if( (count($line_splits_french) > 2  && strcmp($line_splits_french[0],$num_sourate)==0) ){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits_french[0].'   Ayyat: '.$line_splits_french[1].'</div> <div style="font-size:1.55em;color:#0e3c68;font-weight:bold;">'.$line_splits_french[2].'</div></br>';
                    }
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    if(strcmp($line_splits_arabe[0],$num_sourate)==0){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits_arabe[0].'   Ayyat: '.$line_splits_arabe[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits_arabe[2].'</div></br>';

                    }
                }
                $result = $title.$result;
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;">';
                echo $style.$result.'</div>';

            }

            ## Charge le coran français dans un tableau
            function load_coran_french() {

                $data = [];
                $fh = fopen('CoranFrancais_clean.txt', 'r');

                while (!feof($fh)) {
                    $line = trim(fgets($fh));
                    if (!$line) continue;

                    // Format : sourate.ayat.texte
                    $parts = explode('.', $line, 3);
                    if (count($parts) < 3) continue;

                    $sourate = (int)$parts[0];
                    $ayat    = (int)$parts[1];
                    $text    = $parts[2];

                    $data[$sourate][$ayat] = $text;
                }

                fclose($fh);
                return $data;
            }

            ## Charge le coran arabe dans un tableau 
            function load_coran_arabe() {

                $data = [];
                $fh = fopen('coran-full-haraka.txt', 'r');

                while (!feof($fh)) {
                    $line = trim(fgets($fh));
                    if (!$line) continue;

                    // Format : sourate|ayat|texte
                    $parts = explode('|', $line, 3);
                    if (count($parts) < 3) continue;

                    $sourate = (int)$parts[0];
                    $ayat    = (int)$parts[1];
                    $text    = $parts[2];

                    $data[$sourate][$ayat] = $text;
                }

                fclose($fh);
                return $data;
            }

            ## Lis la sourate en parallèle
            function read_sourate($num_sourate) {

                $asma_ar = ["ٱللَّهُ","ٱللَّهِ","ٱللَّهَ","هُوَ ٱلَّذِىٓ","ٱلْحَىُّ","ٱلْقَيُّومُ","رَبَّنَآ","لِلَّهِ","رَبِّ","الرَّحْمَنِ","الرَّحِيمِ","مَالِكِ","عَزِيزٌ","ٱلْعَزِيزُ","ٱلْحَكِيمُ","شَدِيدُ ٱلْعِقَابِ","بَصِيرٌۢ","سَرِيعُ ٱلْحِسَابِ","قَدِيرٌۭ","رَءُوفٌۢ","رَّحِيمٌ",
                        "ٱلسَّمِيعُ","ٱلْعَلِيمُ","سَمِيعُ ٱلدُّعَآءِ","وَلِىُّ","وَٰسِعٌ","عَلِيمٌۭ","ذُو ٱلْفَضْلِ ٱلْعَظِيمِ","غَفُورٌۭ"];
                
                $asma_fr = ["Allah","Le Tout-Miséricordieux","Le Très-Miséricordieux","Le Souverain","Le Très-Saint", "La Paix","Le Garant","Le Protecteur","Le Tout-Puissant","Le Contraignant","Le Suprême",
                        "Le Créateur","Le Façonneur","Celui qui donne forme","Le Très-Pardonnant", "Le Dominateur absolu","Le Donateur","Le Pourvoyeur","Celui qui accorde la victoire",
                        "L'Omniscient","Celui qui restreint","Celui qui étend","Celui qui abaisse","Celui qui élève", "Celui qui honore","Celui qui avilit","L'Audient","Le Clairvoyant","Le Juge","Le Juste",
                        "Le Subtil","Le Parfaitement informé","Le Très-Doux","L'Immense","Le Très-Clément", "Le Très-Reconnaissant","Le Très-Haut","Le Très-Grand","Le Préservateur","Celui qui nourrit",
                        "Celui qui suffit","Le Majestueux","Le Très-Généreux","Le Vigilant","Celui qui répond","L'Incommensurable","Le Sage","Le Très-Aimant","Le Glorieux","Celui qui ressuscite",
                        "Le Témoin","La Vérité","Le Garant","Le Très-Fort","Le Robuste","Le Protecteur","Le Digne de louange","Celui qui dénombre","Celui qui fait apparaître","Celui qui redonne vie",
                        "Celui qui donne la vie","Celui qui donne la mort","Le Vivant","Celui qui subsiste par Lui-même", "Celui qui possède toute chose","Le Noble","L'Unique","L'Un","L'Absolu","Le Tout-Puissant",
                        "L'Omnipotent","Celui qui avance","Celui qui retarde","Le Premier","Le Dernier","L'Apparent", "Le Caché","Le Maître absolu","Le Très-Élevé","Le Bienfaiteur","Celui qui accepte le repentir",
                        "Le Vengeur","L'Indulgent","Très-Clément","Maître du Royaume","Détenteur de Majesté et de Générosité", "L'Équitable","Celui qui rassemble","Le Suffisant","Celui qui enrichit","Celui qui empêche",
                        "Celui qui afflige","Celui qui accorde le bien","La Lumière","Le Guide","L'Incomparable","Le Permanent","L'Héritier","Le Guide vers la droiture","Le Patient"];
            

                $fr = load_coran_french();
                $ar = load_coran_arabe();

                if (!isset($fr[$num_sourate]) && !isset($ar[$num_sourate])) {
                    return;
                }

                $sourates_ar = [
                  "سورة الفاتحة",
                  "سورة البقرة",
                  "سورة آل عمران",
                  "سورة النساء",
                  "سورة المائدة",
                  "سورة الأنعام",
                  "سورة الأعراف",
                  "سورة الأنفال",
                  "سورة التوبة",
                  "سورة يونس",
                  "سورة هود",
                  "سورة يوسف",
                  "سورة الرعد",
                  "سورة إبراهيم",
                  "سورة الحجر",
                  "سورة النحل",
                  "سورة الإسراء",
                  "سورة الكهف",
                  "سورة مريم",
                  "سورة طه",
                  "سورة الأنبياء",
                  "سورة الحج",
                  "سورة المؤمنون",
                  "سورة النور",
                  "سورة الفرقان",
                  "سورة الشعراء",
                  "سورة النمل",
                  "سورة القصص",
                  "سورة العنكبوت",
                  "سورة الروم",
                  "سورة لقمان",
                  "سورة السجدة",
                  "سورة الأحزاب",
                  "سورة سبإ",
                  "سورة فاطر",
                  "سورة يس",
                  "سورة الصافات",
                  "سورة ص",
                  "سورة الزمر",
                  "سورة غافر",
                  "سورة فصلت",
                  "سورة الشورى",
                  "سورة الزخرف",
                  "سورة الدخان",
                  "سورة الجاثية",
                  "سورة الأحقاف",
                  "سورة محمد",
                  "سورة الفتح",
                  "سورة الحجرات",
                  "سورة ق",
                  "سورة الذاريات",
                  "سورة الطور",
                  "سورة النجم",
                  "سورة القمر",
                  "سورة الرحمن",
                  "سورة الواقعة",
                  "سورة الحديد",
                  "سورة المجادلة",
                  "سورة الحشر",
                  "سورة الممتحنة",
                  "سورة الصف",
                  "سورة الجمعة",
                  "سورة المنافقون",
                  "سورة التغابن",
                  "سورة الطلاق",
                  "سورة التحريم",
                  "سورة الملك",
                  "سورة القلم",
                  "سورة الحاقة",
                  "سورة المعارج",
                  "سورة نوح",
                  "سورة الجن",
                  "سورة المزمل",
                  "سورة المدثر",
                  "سورة القيامة",
                  "سورة الإنسان",
                  "سورة المرسلات",
                  "سورة النبإ",
                  "سورة النازعات",
                  "سورة عبس",
                  "سورة التكوير",
                  "سورة الانفطار",
                  "سورة المطففين",
                  "سورة الانشقاق",
                  "سورة البروج",
                  "سورة الطارق",
                  "سورة الأعلى",
                  "سورة الغاشية",
                  "سورة الفجر",
                  "سورة البلد",
                  "سورة الشمس",
                  "سورة الليل",
                  "سورة الضحى",
                  "سورة الشرح",
                  "سورة التين",
                  "سورة العلق",
                  "سورة القدر",
                  "سورة البينة",
                  "سورة الزلزلة",
                  "سورة العاديات",
                  "سورة القارعة",
                  "سورة التكاثر",
                  "سورة العصر",
                  "سورة الهمزة",
                  "سورة الفيل",
                  "سورة قريش",
                  "سورة الماعون",
                  "سورة الكوثر",
                  "سورة الكافرون",
                  "سورة النصر",
                  "سورة المسد",
                  "سورة الإخلاص",
                  "سورة الفلق",
                  "سورة الناس"
                ];

                $title = '<div class="titre-sourate">'.$sourates_ar[$num_sourate-1].'</div>';

                $result = '';

                // fusion des ayats existants
                $ayats = array_unique(array_merge(
                    array_keys($fr[$num_sourate] ?? []),
                    array_keys($ar[$num_sourate] ?? [])
                ));
                sort($ayats);

                foreach ($ayats as $ayat) {

                    $text_fr = $fr[$num_sourate][$ayat] ?? '';
                    $text_ar = $ar[$num_sourate][$ayat] ?? '';

                    $result .= '
                    <div style="margin-bottom:25px;">
                        <div style="font-size:1.25em;color:blue; text-align:left;">
                            Sourate:'.$num_sourate.':'.$ayat.'
                        </div>                        

                        <div style="font-size:2.85em;color:#0e3c68;font-weight:bold; text-align:right; font-family:Scheherazade New, serif; direction:rtl; text-align:justify;">
                            '.$text_ar.'
                        </div>
                        
                        <div style="font-size:1.25em;color:#0e3c68;font-family:italic; text-align:left;">
                            '.$text_fr.'
                        </div>

                    </div>';
                }

                $bismillah_i = "بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ";
                $bismillah = "</br><span style='font-size:2.85em;color:#0e3c68;font-weight:bold; text-align:right; font-family:Scheherazade New, serif; direction:rtl; text-align:center;'>".$bismillah_i."</span></br>";
                

                foreach ($asma_fr as $mot) {
                    $result = str_ireplace($mot, "<span style='color:blue;'>$mot</span>", $result);
                }
                foreach ($asma_ar as $mot) {
                    $result = str_ireplace($mot, "<span style='color:green;'>$mot</span>", $result);
                }

                if($num_sourate != 9)
                    echo '<div style="padding-left:15%; padding-right:15%; padding-top:5%;">'.$title.$bismillah_i.$result.'</div>';
                else {
	                echo '<div style="padding-left:15%; padding-right:15%; padding-top:5%;">'.$title.$result.'</div>';
                }

            }

            ## Finction search word in the coran
            function find_word($word){
                $fh = fopen('coran-full-haraka.txt', 'r');
                $result ='';
                $number=0;

                # Première lecture
                $line =fgets($fh);
                $line_splits = explode("|",$line);

                while(!feof($fh)){                    

                    # Vérification de l'existance de l'index dans le line_splits
                    if(count($line_splits) > 2 && stripos($line_splits[2],$word)){
                            #$result = $result.'<div style="font-size:1.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                            $result .= '<div style="font-size:1.25em;color:blue; text-align:left;">Sourate:'.$line_splits[0].':'.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                            $result_french = read_verset_french($line_splits[0],$line_splits[1]);
                            $result = $result.$result_french;

                            $texte = $line_splits[2];                            
                            $count = substr_count(
                                strtolower($texte),
                                strtolower($word)
                            );
                            $number = $number + $count;
                    }

                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                }

                $title = '<div style="font-size:2.25em;color:green;font-weight:bold; font-family:Scheherazade New, serif; direction:rtl;"> < '.$word.' > apparaît dans le coran : '.$number.' fois </div></br>';
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;position:relative; font-family:Scheherazade New, serif; direction:rtl; text-align:justify;">';

                $result = str_replace(strtolower($word), "<span style='color:blue;'>$word</span>", strtolower($result));
                echo $style.$title.$result.'</div>';

            }

            # Recherche d'un mot en français
            function find_word_french($word_french){
                $fh = fopen('CoranFrancais_clean.txt', 'r');
                $result ='';
                $number=0;

                # Première lecture
                $line =fgets($fh);
                $line_splits = explode(".",$line);

                while(!feof($fh)){                    

                    # Vérification de l'existance de l'index dans le line_splits
                    if(count($line_splits) > 2 && stripos($line_splits[2],$word_french)){
                            #$result = $result.'<div style="font-size:1.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                            $result .= '<div style="font-size:1.25em;color:blue; text-align:left;">Sourate:'.$line_splits[0].':'.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                            $result_french = read_verset_arabe($line_splits[0],$line_splits[1]);
                            $result = $result.$result_french;

                            $texte = $line_splits[2];                            
                            $count = substr_count(
                                strtolower($texte),
                                strtolower($word_french)
                            );
                            $number = $number + $count;
                    }

                    $line =fgets($fh);
                    $line_splits = explode(".",$line);
                }

                $title = '<div style="font-size:2.25em;color:green;font-weight:bold">" '.$word_french.'" : apparaît dans le coran : '.$number.' fois</div></br>';
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;position:relative;">';
                $result = str_replace(strtolower($word_french), "<span style='color:blue;'>$word_french</span>", strtolower($result));
                echo $style.$title.$result.'</div>';
            }

            # Recherche d'un mot en français dans le jardin des vertueux
            function find_word_french_jv($word_french_jv){
                $fh = fopen('JardinDesVertueux.txt', 'r');
                $result ='';
                $number=0;

                ## Parametres pour distingué les hadiths des versets
                $isHadith = false;
                $isVerset = false;
                $isSuite = false;
                ## Type en cours
                $isHadithP = false;
                $isVersetP = false;
                $isSuiteP = false;

                $Hadith = '';
                $Verset = '';

                # Première lecture
                $line =fgets($fh);

                while(!feof($fh)){               


                    # identification du type de ligne lue
                    $isHadith = isHadith($line);
                    $isVerset = isVerset($line);
                    $isSuite = isSuite($line);                    

                    if($isHadith){
                        # On verifie si le mot est contenu dans le hadith précédent
                        if($Hadith !== '' && stripos($Hadith,$word_french_jv)){

                            #echo 'Hadith ajouté :'.$Hadith;

                            # Ajout du Hadith précédent dans le résultat
                            $result = $result.'<div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$Hadith.'</div></br>';

                            #Incrementation du nombre
                            #$number = $number + substr_count($Hadith,$word_french_jv);
                            $count = substr_count(
                                strtolower($Hadith),
                                strtolower($word_french_jv)
                            );
                            $number = $number + $count;

                            # Réinitialisation du Hadith
                            $Hadith = '';

                            # Ajout de la nouvelle ligne au Hadith
                            $Hadith = $Hadith.$line;

                            ## Valeur en cours
                            $isHadithP = true;
                            $isVersetP = false;
                            $isSuiteP = false;


                        # Le mot n'est pas contenu dans le Hadith précédent on le vide ' 
                        }else if($Hadith !== '' && $isHadith){

                            #echo "\nHadith avant purge : < ".$Hadith." >\n";

                            $Hadith = '';

                            # Ajout de la ligne au Hadith en cours
                            $Hadith = $Hadith.$line;

                            #echo "\nHadith après purge : <".$Hadith." >\n";


                            ## Valeur en cours
                            $isHadithP = true;
                            $isVersetP = false;
                            $isSuiteP = false;
                        }else if($Hadith == '' && $isHadith){

                            # Ajout de la ligne au Hadith en cours
                            $Hadith = $Hadith.$line;
                        }

                    # Cas d'un verset'
                    }else if($isVerset){
                        # On verifie si le mot est contenu dans le verset précédent
                        if($Verset !== '' && stripos($Verset,$word_french_jv)){

                            #echo "Verset AJOUTÉ :< ".$Verset." >";

                            # Ajout du verset précédent dans le résultat
                            $result = $result.'<div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$Verset.'</div></br>';

                            #Incrementation du nombre
                            #$number = $number + substr_count($Verset,$word_french_jv);
                            $count = substr_count(
                                strtolower($Hadith),
                                strtolower($word_french_jv)
                            );
                            $number = $number + $count;

                            # Réinitialisation du Verset
                            $Verset = '';

                            # Ajout de la nouvelle ligne au Verset
                            $Verset = $Verset.$line;

                            ## Valeur en cours
                            $isHadithP = false;
                            $isVersetP = true;
                            $isSuiteP = false;


                        # Le mot n'est pas contenu dans le Verset précédent on le vide ' 
                        }else if($Verset !== '' && $isVerset){

                            #echo '\nVerset supprimé :< '.$Verset.' >\n';

                            $Verset = '';

                            # Ajout de la ligne au Hadith en cours
                            $Verset = $Verset.$line;

                            ## Valeur en cours
                            $isHadithP = false;
                            $isVersetP = true;
                            $isSuiteP = false;

                        }else if($Verset == '' && $isVerset ){

                            # Ajout de la ligne au Hadith en cours
                            $Verset = $Verset.$line;
                        }
                    }else if($isSuite){

                        ## Hadith en cours de lecture
                        if($isHadithP){
                            #Ajout de la ligne au hadith
                            $Hadith = $Hadith.$line;

                            #echo 'Hadith en cours ... :< '.$Hadith.' >';
                        }else if($isVersetP){
                            # Ajout de la ligne au Verset
                            $Verset = $Verset.$line;
                            #echo 'Verset en cours ... :< '.$Verset.' >';
                        }
                    }

                    # Lecture ligne
                    $line =fgets($fh);

                }

                $title = '<div style="font-size:2.25em;color:green;font-weight:bold">" '.$word_french_jv.'" apparaît dans le jardin des vertueux : '.$number.' fois</div></br>';
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;position:relative; text-align:justify;">';
                $result = str_replace(strtolower($word_french_jv), "<span style='color:blue;'>$word_french_jv</span>", strtolower($result));
                echo $style.$title.$result.'</div>';
            }

            #function est hadith
            function isHadith($line){
                $contenu = explode(".",$line);
                return (count($contenu)>0 && filter_var($contenu[0], FILTER_VALIDATE_INT) !== false);                   
            }

            #function est verset
            function isVerset($line){
                $contenu = explode(".",$line);
                return (count($contenu)>0 && filter_var($contenu[0], FILTER_VALIDATE_INT) !== false && filter_var($contenu[0], FILTER_VALIDATE_INT) !== false );                
            }

            # verifier si c'est suite
            function isSuite($line){
                $contenu = explode(".",$line);
                return (count($contenu)>0 && !filter_var($contenu[0], FILTER_VALIDATE_INT) !== false);
            }

            #Function qui calcul et renvoie le poids d'un mots en arabe
            function poids_mot($mot){

                // Création d'un dictionnaire 
                $alphabet = array(
                    "ا" => 1,
                    "ب" => 2,
                    "ج" => 3,
                    "د" => 4,
                    "ه" => 5,
                    "و" => 6,
                    "ز" => 7,
                    "ح" => 8,
                    "ط" => 9,
                    "ي" => 10,
                    "ك" => 20,
                    "ل" => 30,
                    "م" => 40,
                    "ن" => 50,
                    "س" => 60,
                    "ع" => 70,
                    "ف" => 80,
                    "ص" => 90,
                    "ق" => 100,
                    "ر" => 200,
                    "ش" => 300,
                    "ت" => 400,
                    "ث" => 500,
                    "خ" => 600,
                    "ذ" => 700,
                    "ض" => 800,
                    "ظ" => 900,
                    "غ" => 1000,
                           );
                // Longueur du mot
                $longueur = strlen($mot);

                $poids = 0;

                // Boucle pour parcourir le dictionnaire de l'alphabet arabe'
                    foreach ($alphabet as $cle => $valeur) {
                        $nbr = substr_count($mot, $cle);

                        if ($nbr > 0) {
                            $poids += $valeur * $nbr;
                        }

                    }

                #echo "Poids du mot .$mot. :.$poids.<Br\>";

                # Divible par 19 ?
                #if($poids % 19 === 0)
                #    echo "Poids divible par 19 <Br\>";

                # Divible par 7 ?
                #if($poids % 7 === 0)
                #    echo "Poids divible par 7 <Br\>";

                # Divible par 12 ?
                #if($poids % 12 === 0)
                #    echo "Poids divible par 12 <Br\>";
                
                return $poids;
            }

            # Calcul le poids d'une phrase'
            function poids_phrase($phrase){
                $style = '<div>';
                $fin = '</div>';
                # split la phrase en mots
                $mots_phrase = explode(" ",$phrase);
                $poids = 0;                
                #echo $style."Phrase : ".$phrase;
                foreach($mots_phrase as $mot){                    
                    $poids+=poids_mot($mot);                    
                }
                #echo "Poids phrase :".$poids.$fin;
                return $poids;
            }

            ## Function compte words of coran
            function count_words(){
                $fh = fopen('coran-full-haraka.txt', 'r');
                $result ='';
                $number=0;
                $style = '<div style="padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden;position:relative;">';
                
                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    $words_splits = explode(" ",$line_splits[2]);
                    $number = $number + sizeof($words_splits);
                    echo $style.$line_splits[2].sizeof($words_splits).'</div>';
                }
                
                $title = '<div style="font-size:2.25em;color:green;font-weight:bold">Total of words  in the coran is : '.$number.'</div></br>';
                echo $style.$title.'</div>';
            }
            
            ## Function poids des sourates 
            function poids_sourate($num_sourate_arabe){

                $fh = fopen('coran-full-haraka.txt', 'r');
                
                $poids_sourate = 0;

                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    if(strcmp($line_splits[0],$num_sourate_arabe)==0){                        
                        #calcul du poids de la sourate
                        $poids_sourate+=poids_phrase($line_splits[2]);
                    }
                }

                return $poids_sourate;
            }

            ## Calcul le poids des sourates du coran
            function tableau_poids_sourates_coran(){
                $tableau = array();

                for($i=1;$i<115;$i++){
                    array_push($tableau,poids_sourate($i));
                }

                #echo "Tableau poids des sourates :";
                #print_r($tableau);
                #graph($tableau);
                return $tableau;
            }

            
            function goPageGraph(){
                // Ouvrir la page pageGraph.php
                include 'pageGraphe.php';
                exit();
            }

            function goPageCoran(){
                // Ouvrir la page Coran_page.php
                include 'Coran_page.php';
                exit();
            }

            ## FunctionRead and print the coran text 
            function read_coran_page($num_page){
                $fh = fopen('quran-uthmani-min-page.txt', 'r');
                $result = '';
                $style = "<div style='padding-left:15%; padding-right:15%; padding-top:5%; overflow:hidden; font-size:0.85em;color:#0e3c68;font-weight:bold; font-family:Scheherazade New, serif;direction:rtl;'>";
                
                $asma_ar = ["اللَّه", "ِ الرَّحمٰنِ", "الرَّحيمِ","لِلَّهِ", "رَبِّ","رَبَّ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ","الرَّحمٰنِ","الرَّحيمِ","مٰلِكِ","القُدُّوس","السَّلَام",
                        "المُؤْمِن","المُهَيْمِن", "العَزِيز","الجَبَّار","المُتَكَبِّر","الخَالِق","البَارِىء","المُصَوِّر","الغَفَّار", "القَهَّار","الوَهَّاب","الرَّزَّاق","الفَتَّاح","العَلِيم","القَابِض","البָاسِط",
                        "الخَافِض","الرَّافِع","المُعِزّ","المُذِلّ","السَّمِيع","البَصِير","الحَكَم","العَدْل", "اللَّطِيف","الخَبِير","الحَلِيم","العَظِيم","الغَفُور","الشَّكُور","العَلِيّ","الكَبِير",
                        "الحَفِيظ","المُقِيت","الحَسِيب","الجَلِيل","الكَرِيم","الرَّقِيب","المُجِيب","الوَاسِع", "الحَكِيم","الوَدُود","المَجِيد","البَاعِث","الشَّهِيد","الحَقّ","الوَكِيل","القَوِيّ",
                        "المَتِين","الوَلِيّ","الحَمِيد","المُحْصِي","المُبْدِئ","المُعِيد","المُحْيِي","المُمِيت", "الحَيّ","القَيّوم","الوَاجِد","المَاجِد","الوَاحِد","الأَحَد","الصَّمَد","القَادِر",
                        "المُقْتَدِر","المُقَدِّم","المُؤَخِّر","الأَوَّل","الآخِر","الظَّاهِر","البَاطِن", "الوَالِي","المُتَعَالِي","البَرّ","التَّوَّاب","المُنْتَقِم","العَفُوّ","الرَّؤُوف",
                        "مَالِكُ المُلْك","ذُو الجَلَال وَالإِكْرَام","المُقْسِط","الجَامِع","الغَنِيّ","المُغْنِي", "المَانِع","الضَّار","النَّافِع","النُّور","الهَادِي","البَدِيع","البَاقِي","الوَارِث",
                        "الرَّشِيد","الصَّبُور", "هُوَ الَّذى", "رَبُّكَ", "إِنّى", "أَنّى", "مَلِكِ النّاسِ", "إِلٰهِ النّاسِ", "الرَّحيمِ "];
                
                while(!feof($fh)){
                    $line = fgets($fh);
                    $line_splits = explode("|",$line);
                    
                    // Structure attendue : page | sourate | verset | texte
                    if(isset($line_splits[0]) && trim($line_splits[0]) == $num_page){
                        $text_ar = trim($line_splits[3]);  // texte arabe
                        $num_ayah = trim($line_splits[2]); // numéro du verset

                        $result .= $text_ar ." ﴿".$num_ayah."﴾ ";
                    }                 
                }


                $bismillah_list = ["بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ","بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ"];

                foreach ($bismillah_list as $bismillahi){
                    $result = str_ireplace($bismillahi, "</br><span style='color:green;>".$bismillahi."</span></br>", $result );
                } 

                foreach ($asma_ar as $mot) {
                    $result = str_ireplace($mot, "<span style='color:green;'>$mot</span>", $result);
                }
                
                $numpage = '<div class="page-number" id="page-number">'.$num_page.'</div>';
                echo $style.$result.$numpage;
            }               

            ## Run python application
            if(!empty($_POST['coran_browser'])){
                ## Run the coran browser
                $command = escapeshellcmd('python /Users/amadouourybah/Desktop/My_coran_project/deep_learning_coran.py');
                $output = shell_exec($command);
                echo $output;
            }

            ## Call read_coran function 
            if(!empty($_POST['read_coran'])){
                read_coran();
            }

            ## Find sourate arabe
            /*if(!empty($_POST['read_sourate_arabe'])){
                read_sourate_arabe($_POST['num_sourate_arabe']);
            }*/
            if (isset($_POST['sourate_arabe']) && $_POST['sourate_arabe'] !== '') {
                $numeroSourate = (int) $_POST['sourate_arabe'];
                $sourateArabeSelectionnee == $numeroSourate;
                $nomSourate = $List_sourates_arabe[$numeroSourate];

                read_sourate_arabe($numeroSourate);
            }

            ## Find sourate french
            /*if(!empty($_POST['read_sourate_french'])){
                read_sourate($_POST['num_sourate_french']);
            }*/
            if (isset($_POST['sourate_french']) && $_POST['sourate_french'] !== '') {
                $numeroSourate = (int) $_POST['sourate_french'];
                $sourateFrenchSelectionnee == $numeroSourate;
                $nomSourate = $List_sourates_french[$numeroSourate];

                read_sourate($numeroSourate);
            }

            ## Find sourate
            if(!empty($_POST['read_sourate'])){
                read_sourate($_POST['num_sourate']);
            }

            ## Find Word in the coran arabe
            /*if(!empty($_POST['find_words'])){
                find_word($_POST['word']);
            }*/
            if (!empty($_POST['word'])) {
                $mot = trim($_POST['word']);
                find_word($mot);
            }

            ## Find Word in the coran french
            /*if(!empty($_POST['find_words_french'])){
                find_word_french($_POST['word_french']);
            }*/
            if (!empty($_POST['word_french'])) {
                $mot = trim($_POST['word_french']);
                find_word_french($mot);
            }

            ## Find Word in the jardin des vertueux
            if(!empty($_POST['find_words_french_jv'])){
                find_word_french_jv($_POST['word_french_jv']);
            }
            if (!empty($_POST['word_french_jv'])) {
                $mot = trim($_POST['word_french_jv']);
                find_word_french_jv($mot);
            }

            ## Count weight
            if(!empty($_POST['count_words'])){
                count_words();
            }   
            
            ## goPageGraph 
            if(!empty($_POST['poids_sourates'])){
                goPageGraph();
            }   
            
            ## goPageCoran
            if(!empty($_POST['page_coran'])){
                goPageCoran();
            } 
            ?>
        </div>

        <div class=text-ar>
            <?php                
                
                ## goPageCoran
                if(!empty($_POST['page'])){
                      $page = intval($_POST['page']);
                      if ($page < 1) $page = 1;
                      if ($page > 604) $page = 604;
                      read_coran_page($page);
                } 
                  
            ?>   
        </div>   
    </div>

    

    <div class=footer>
        <img class=logo src='coran_transp.png'>
        <p>@Author: Bah Amadou Oury</p>
    </div>
    <!--<footer class="footer">
      <div class="footer-content">

        <img class=logo src='coran_transp.png'>
        <p>@Author: Bah Amadou Oury</p>

        <!--<p>📩 Contact</p>-->

        <!--<a href="mailto:aobah34@gmail.com" class="footer-link">
          ✉️ aobah34@gmail.com
        </a>

        <a href="https://www.linkedin.com/in/amadou-oury-765419104/" 
           target="_blank" 
           rel="noopener noreferrer"
           class="footer-link">
          🔗 LinkedIn
        </a>
      </div>
    </footer>-->


</body>

</html>