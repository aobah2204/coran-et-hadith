
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
    <div class=header>        
        <!-- <h2 class=titre> اللَّهُ نَزَّلَ أَحسَنَ الحَديثِ كِتٰبًا مُتَشٰبِهًا مَثانِىَ تَقشَعِرُّ مِنهُ جُلودُ الَّذينَ يَخشَونَ رَبَّهُم ثُمَّ تَلينُ جُلودُهُم وَقُلوبُهُم إِلىٰ ذِكرِ اللَّهِ ذٰلِكَ هُدَى اللَّهِ يَهدى بِهِ مَن يَشاءُ وَمَن يُضلِلِ اللَّهُ فَما لَهُ مِن هادٍ </h2> -->
        <div class=marquee-rtl>
            <h3 class=titre>Coran parser - محلل القرآن</h3>
            <!--<div>Liser et Explorer facilement le coran</div>
            <img class=logo_grand src='coran_wall_large_paper.jpg' ></br>-->
        </div>
        
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="menu-box">

              <div class="menu-item">
                <!--<input type="number" placeholder="Page (1-604)" id="in_page">
                <button onclick="goPage()">Page</button>-->
                <input class=button type="submit" id="page_coran" name="page_coran" value="Go page">
                <input type="number" step="1" min="1" max="604" id="num_page" name="num_page" value="1" size="5" placeholder="Page (1-604)">
              </div>

              <div class="menu-item">
                <input class=button type="submit" id="read_sourate_arabe" name="read_sourate_arabe" value="Sourate en arabe">
                <input class=num_sourate_arabe type="text" id="num_sourate_arabe" name="num_sourate_arabe" value="1" size="5" placeholder="Sourate (1-114)"> 
                <!--<input type="number" placeholder="Sourate (1-114)" id="in_sourate">
                <button onclick="goSourate()">Sourate</button>-->
              </div>

              <div class="menu-item">
                <input class=button type="submit" id="find_words" name="find_words" value="Coran en arabe">
                <input class=word_to_find type="text" id="word" name="word" placeholder="اللَّه">
                <!--<input type="number" placeholder="Verset" id="in_ayah">
                <button onclick="goAyah()">Verset</button>-->
              </div>

              <div class="menu-item">
                <!--<input type="text" placeholder="Recherche mot" id="in_search">
                <button onclick="searchWord()">Chercher</button>-->
                <input class=button type="submit" id="find_words_french" name="find_words_french" value="Coran en français">
                <input class=word_to_find type="text" id="word_french" name="word_french" placeholder="Créateur">
              </div>

              <div class="menu-item">
                <!--<input type="number" placeholder="Juz (1-30)" id="in_juz">
                <button onclick="goJuz()">Juz</button>-->
                <input class=button type="submit" id="find_words_french_jv" name="find_words_french_jv" value="Hadith">
                <input class=word_to_find type="text" id="word_french_jv" name="word_french_jv" placeholder="Créateur">
              </div>

              <div class="menu-item">
                <!--<input type="number" placeholder="Hizb (1-60)" id="in_hizb">
                <button onclick="goHizb()">Hizb</button>-->
                <!-- Poids des mots  -->
                <input class=button type="submit" id="poids_sourates" name="poids_sourates" value="Poids des sourates">
              </div>

            </div>
        </form>    
    </div>
    

    <div class=parchemin >
        <div class=text_ar>
            <?php    

            // Variables Globales
            $asma_ar = ["اللَّه", "لِلَّهِ", "رَبِّ","رَبَّ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ","الرَّحمٰنِ","الرَّحيمِ","مٰلِكِ","القُدُّوس","السَّلَام","المُؤْمِن","المُهَيْمِن", "العَزِيز","الجَبَّار","المُتَكَبِّر","الخَالِق","البَارِىء","المُصَوِّر","الغَفَّار", "القَهَّار","الوَهَّاب","الرَّزَّاق","الفَتَّاح","العَلِيم","القَابِض","البָاسِط",
                     "الخَافِض","الرَّافِع","المُعِزّ","المُذِلّ","السَّمِيع","البَصِير","الحَكَم","العَدْل", "اللَّطِيف","الخَبِير","الحَلِيم","العَظِيم","الغَفُور","الشَّكُور","العَلِيّ","الكَبِير",
                     "الحَفِيظ","المُقِيت","الحَسِيب","الجَلِيل","الكَرِيم","الرَّقِيب","المُجِيب","الوَاسِع", "الحَكِيم","الوَدُود","المَجِيد","البَاعِث","الشَّهِيد","الحَقّ","الوَكِيل","القَوِيّ",
                     "المَتِين","الوَلِيّ","الحَمِيد","المُحْصِي","المُبْدِئ","المُعِيد","المُحْيِي","المُمِيت", "الحَيّ","القَيّوم","الوَاجِد","المَاجِد","الوَاحِد","الأَحَد","الصَّمَد","القَادِر",
                     "المُقْتَدِر","المُقَدِّم","المُؤَخِّر","الأَوَّل","الآخِر","الظَّاهِر","البَاطِن", "الوَالِي","المُتَعَالِي","البَرّ","التَّوَّاب","المُنْتَقِم","العَفُوّ","الرَّؤُوف",
                     "مَالِكُ المُلْك","ذُو الجَلَال وَالإِكْرَام","المُقْسِط","الجَامِع","الغَنِيّ","المُغْنِي", "المَانِع","الضَّار","النَّافِع","النُّور","الهَادِي","البَدِيع","البَاقِي","الوَارِث", "الرَّشِيد","الصَّبُور"];
                
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
                $fh = fopen('quran-uthmani-min.txt', 'r');
                $result = '';
                $style = '<div style="padding:15%;overflow:hidden;">';
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

                while(!feof($coran_french)){
                    $line =fgets($coran_french);
                    $line_splits = explode(".",$line);
                    #echo $num_sourate_french; echo "<------->"; echo $line_splits[2];  echo '<br/>';
                    if(count($line_splits) > 2  && strcmp($line_splits[0],$num_sourate_french)==0){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.55em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';
                    }
                }
                $result = $title.$result;
                $style = '<div style="padding:15%;overflow:hidden;">';

                foreach ($asma_fr as $mot) {
                    $result = str_replace($mot, "<span style='color:red;'>$mot</span>", $result);
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
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.55em;color:#0e3c68;font-weight:bold;">'.$verset.'</div></br>';
                    }
                }

                return $result;
            }

            # Lecture d'un verset en arabe
            function read_verset_arabe($num_sourate,$num_verset){
                $fh = fopen('quran-uthmani-min.txt', 'r');
                $result ='';

                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    if(count($line_splits) > 2  && strcmp($line_splits[0],$num_sourate)==0 && strcmp($line_splits[1],$num_verset)==0){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';                        
                    }
                }

                return $result;
            }

            ## Function search sourate 
            function read_sourate_arabe($num_sourate_arabe){
                $fh = fopen('quran-uthmani-min.txt', 'r');
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
                $result = "<div class='page_coran'><div style='padding-left:15%; padding-right:15%; overflow:hidden; font-size:2.85em;color:#0e3c68;font-weight:bold; font-family:Scheherazade New, serif;direction:rtl; text-align:justify; text-align-last: justify;'>";

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

                $result = $title.$result;

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

                $bismillah_list = ["بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ","بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ"];

                foreach ($bismillah_list as $bismillahi){
                    $result = str_replace($bismillahi, "<span style='color:red;>".$bismillahi."</span></br>", $result );
                } 

                $asma_ar = ["اللَّهِ","الرَّحمٰنِ ","الرَّحيمِ ","اللَّهَ ", "اللَّهُ"];
                foreach ($asma_ar as $mot) {
                    $result = str_replace($mot, "<span style='color:red;'>$mot</span>", $result);
                }

                
                
                echo $style.$result.'</div>';
            }

            ## Fonction de lecture d'une sourate en arabe et français 
            function my_read_sourate($num_sourate){
                # Ouverture des fichiers coran français et arabe
                $coran_french = fopen('CoranFrancais_clean.txt', 'r');
                $fh = fopen('quran-uthmani-min.txt', 'r');

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
                $style = '<div style="padding:15%;overflow:hidden;">';
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
                $fh = fopen('quran-uthmani-min.txt', 'r');

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

                // Variables Globales
                $asma_ar = ["اللَّه", "الرَّحمٰنِ", "الرَّحيمِ","لِلَّهِ", "رَبِّ","رَبَّ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ","الرَّحمٰنِ","الرَّحيمِ","مٰلِكِ","القُدُّوس","السَّلَام","المُؤْمِن","المُهَيْمِن", "العَزِيز","الجَبَّار","المُتَكَبِّر","الخَالِق","البَارِىء","المُصَوِّر","الغَفَّار", "القَهَّار","الوَهَّاب","الرَّزَّاق","الفَتَّاح","العَلِيم","القَابِض","البָاسِط",
                        "الخَافِض","الرَّافِع","المُعِزّ","المُذِلّ","السَّمِيع","البَصِير","الحَكَم","العَدْل", "اللَّطِيف","الخَبِير","الحَلِيم","العَظِيم","الغَفُور","الشَّكُور","العَلِيّ","الكَبِير",
                        "الحَفِيظ","المُقِيت","الحَسِيب","الجَلِيل","الكَرِيم","الرَّقِيب","المُجِيب","الوَاسِع", "الحَكِيم","الوَدُود","المَجِيد","البَاعِث","الشَّهِيد","الحَقّ","الوَكِيل","القَوِيّ",
                        "المَتِين","الوَلِيّ","الحَمِيد","المُحْصِي","المُبْدِئ","المُعِيد","المُحْيِي","المُمِيت", "الحَيّ","القَيّوم","الوَاجِد","المَاجِد","الوَاحِد","الأَحَد","الصَّمَد","القَادِر",
                        "المُقْتَدِر","المُقَدِّم","المُؤَخِّر","الأَوَّل","الآخِر","الظَّاهِر","البَاطِن", "الوَالِي","المُتَعَالِي","البَرّ","التَّوَّاب","المُنْتَقِم","العَفُوّ","الرَّؤُوف",
                        "مَالِكُ المُلْك","ذُو الجَلَال وَالإِكْرَام","المُقْسِط","الجَامِع","الغَنِيّ","المُغْنِي", "المَانِع","الضَّار","النَّافِع","النُّور","الهَادِي","البَدِيع","البَاقِي","الوَارِث", "الرَّشِيد","الصَّبُور", "هُوَ الَّذى", "رَبُّكَ", "إِنّى", "أَنّى"];
                    
                $asma_fr = ["Allah","Le Tout Miséricordieux","Le Très Miséricordieux","Le Souverain","Le Très-Saint", "La Paix","Le Garant","Le Protecteur","Le Tout-Puissant","Le Contraignant","Le Suprême",
                        "Le Créateur","Le Façonneur","Celui qui donne forme","Le Très-Pardonnant", "Le Dominateur absolu","Le Donateur","Le Pourvoyeur","Celui qui accorde la victoire",
                        "L'Omniscient","Celui qui restreint","Celui qui étend","Celui qui abaisse","Celui qui élève", "Celui qui honore","Celui qui avilit","L'Audient","Le Clairvoyant","Le Juge","Le Juste",
                        "Le Subtil","Le Parfaitement informé","Le Très-Doux","L'Immense","Le Très-Clément", "Le Très-Reconnaissant","Le Très-Haut","Le Très-Grand","Le Préservateur","Celui qui nourrit",
                        "Celui qui suffit","Le Majestueux","Le Très-Généreux","Le Vigilant","Celui qui répond","L'Incommensurable","Le Sage","Le Très-Aimant","Le Glorieux","Celui qui ressuscite",
                        "Le Témoin","La Vérité","Le Garant","Le Très-Fort","Le Robuste","Le Protecteur","Le Digne de louange","Celui qui dénombre","Celui qui fait apparaître","Celui qui redonne vie",
                        "Celui qui donne la vie","Celui qui donne la mort","Le Vivant","Celui qui subsiste par Lui-même", "Celui qui possède toute chose","Le Noble","L'Unique","L'Un","L'Absolu","Le Tout-Puissant",
                        "L'Omnipotent","Celui qui avance","Celui qui retarde","Le Premier","Le Dernier","L'Apparent", "Le Caché","Le Maître absolu","Le Très-Élevé","Le Bienfaiteur","Celui qui accepte le repentir",
                        "Le Vengeur","L'Indulgent","Très-Clément","Maître du Royaume","Détenteur de Majesté et de Générosité", "L'Équitable","Celui qui rassemble","Le Suffisant","Celui qui enrichit","Celui qui empêche",
                        "Celui qui afflige","Celui qui accorde le bien","La Lumière","Le Guide","L'Incomparable","Le Permanent","L'Héritier","Le Guide vers la droiture","Le Patient", "Seigneur", "C'est Lui", "Je"];
                    

                $fr = load_coran_french();
                $ar = load_coran_arabe();

                if (!isset($fr[$num_sourate]) && !isset($ar[$num_sourate])) {
                    return;
                }

                $title = '<div style="font-size:1.55em;color:blue;font-weight:bold;">
                            Sourate '.$num_sourate.'
                        </div><br><br>';

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
                        <div style="font-size:0.85em;color:green;">
                            Sourate '.$num_sourate.' — Ayat '.$ayat.'
                        </div>                        

                        <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">
                            '.$text_ar.'
                        </div>
                        
                        <div style="font-size:1.25em;color:#0e3c68;font-family:italic;">
                            '.$text_fr.'
                        </div>

                    </div>';
                }

                foreach ($asma_fr as $mot) {
                    $result = str_ireplace($mot, "<span style='color:red;'>$mot</span>", $result);
                }
                foreach ($asma_ar as $mot) {
                    $result = str_ireplace($mot, "<span style='color:red;'>$mot</span>", $result);
                }

                echo '<div style="padding:15%;">'.$title.$result.'</div>';
            }

            ## Finction search word in the coran
            function find_word($word){
                $fh = fopen('quran-uthmani-min.txt', 'r');
                $result ='';
                $number=0;

                # Première lecture
                $line =fgets($fh);
                $line_splits = explode("|",$line);

                while(!feof($fh)){                    

                    # Vérification de l'existance de l'index dans le line_splits
                    if(count($line_splits) > 2 && str_contains($line_splits[2],$word)){
                            $result = $result.'<div style="font-size:1.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';

                            $result_french = read_verset_french($line_splits[0],$line_splits[1]);
                            $result = $result.$result_french;

                            $number = $number + substr_count($line_splits[2],$word);
                    }

                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                }

                $title = '<div style="font-size:2.25em;color:red;font-weight:bold"> < '.$word.' > dans le coran : '.$number.' fois </div></br>';
                $style = '<div style="padding:15%;overflow:hidden;position:relative;">';

                $result = str_replace($word, "<span style='color:red;'>$word</span>", $result);
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
                    if(count($line_splits) > 2 && str_contains($line_splits[2],$word_french)){
                            $result = $result.'<div style="font-size:1.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';

                            $result_french = read_verset_arabe($line_splits[0],$line_splits[1]);
                            $result = $result.$result_french;

                            $number = $number + substr_count($line_splits[2],$word_french);
                    }

                    $line =fgets($fh);
                    $line_splits = explode(".",$line);
                }

                $title = '<div style="font-size:2.25em;color:red;font-weight:bold">< '.$word_french.' > dans le coran : '.$number.' fois</div></br>';
                $style = '<div style="padding:15%;overflow:hidden;position:relative;">';
                $result = str_replace($word_french, "<span style='color:red;'>$word_french</span>", $result);
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
                        if($Hadith !== '' && str_contains($Hadith,$word_french_jv)){

                            #echo 'Hadith ajouté :'.$Hadith;

                            # Ajout du Hadith précédent dans le résultat
                            $result = $result.'<div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$Hadith.'</div></br>';

                            #Incrementation du nombre
                            $number = $number + substr_count($Hadith,$word_french_jv);

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
                        if($Verset !== '' && str_contains($Verset,$word_french_jv)){

                            #echo "Verset AJOUTÉ :< ".$Verset." >";

                            # Ajout du verset précédent dans le résultat
                            $result = $result.'<div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$Verset.'</div></br>';

                            #Incrementation du nombre
                            $number = $number + substr_count($Verset,$word_french_jv);

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

                $title = '<div style="font-size:2.25em;color:red;font-weight:bold">< '.$word_french_jv.'> dans le jardin des vertueux : '.$number.' fois</div></br>';
                $style = '<div style="padding-left:15%; padding-right:15%;overflow:hidden;position:relative;">';
                $result = str_replace($word_french_jv, "<span style='color:red;'>$word_french_jv</span>", $result);
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
                $fh = fopen('quran-uthmani-min.txt', 'r');
                $result ='';
                $number=0;
                $style = '<div style="padding:15%;overflow:hidden;position:relative;">';
                
                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    $words_splits = explode(" ",$line_splits[2]);
                    $number = $number + sizeof($words_splits);
                    echo $style.$line_splits[2].sizeof($words_splits).'</div>';
                }
                
                $title = '<div style="font-size:2.25em;color:red;font-weight:bold">Total of words  in the coran is : '.$number.'</div></br>';
                echo $style.$title.'</div>';
            }
            
            ## Function poids des sourates 
            function poids_sourate($num_sourate_arabe){

                $fh = fopen('quran-uthmani-min.txt', 'r');
                
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
            if(!empty($_POST['read_sourate_arabe'])){
                read_sourate_arabe($_POST['num_sourate_arabe']);
            }

            ## Find sourate
            if(!empty($_POST['read_sourate'])){
                read_sourate($_POST['num_sourate']);
            }

            ## Find Word in the coran arabe
            if(!empty($_POST['find_words'])){
                find_word($_POST['word']);
            }

            ## Find Word in the coran arabe
            if(!empty($_POST['find_words_french'])){
                find_word_french($_POST['word_french']);
            }

            ## Find Word in the jardin des vertueux
            if(!empty($_POST['find_words_french_jv'])){
                find_word_french_jv($_POST['word_french_jv']);
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

    </div>
    <div class=footer>
        <img class=logo src='coran_transp.png'>
        <p>@Author: Bah Amadou Oury</p>
    </div>

</body>

</html>