
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
            <div>Liser et Explorer facilement le coran</div>
            <img class=logo_grand src='coran_wall_large_paper.jpg' ></br>
        </div>
        
    <!-- Group of buttons-->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <!-- Button app python -->
        <!-- <input class=button type="submit" id="coran_browser" name="coran_browser" value="Coran Browser">  -->
        <!-- Button read coran -->
        <!-- <input class=button type="submit" id="read_coran" name="read_coran" value="Show all coran"> -->
        <!-- Button count weight -->
        <!-- <input class=button type="submit" id="count_words" name="count_words" value="Count words"> -->

       
        <!-- Button find sourate arabe-->
        <input class=button type="submit" id="read_sourate_arabe" name="read_sourate_arabe" value="Sourate en arabe">
        <input class=num_sourate_arabe type="text" id="num_sourate_arabe" name="num_sourate_arabe" value="1" size="5"> 

        <!--
        <input type="text" placeholder="Rechercher..." id="num_sourate_arabe" name="num_sourate_arabe" value="1" size="5" class="search-input">
        <button type="submit" id="read_sourate_arabe" name="read_sourate_arabe" class="search-button">Rechercher</button>
        -->
        <!-- Button find sourate francais-->
        <input class=button type="submit" id="read_sourate" name="read_sourate" value="Sourate en francais">
        <input class=num_sourate type="text" id="num_sourate" name="num_sourate" value="1" size="5">

        <Br/>
        <!-- Button find word or sentence in the coran -->
        <input class=button type="submit" id="find_words" name="find_words" value="Coran en arabe">
        <input class=word_to_find type="text" id="word" name="word" placeholder="اللَّه">

        <!-- Button find word or sentence in the coran -->
        <input class=button type="submit" id="find_words_french" name="find_words_french" value="Coran en français">
        <input class=word_to_find type="text" id="word_french" name="word_french" placeholder="Créateur">

        <!-- Button pour rechercher dans le jardin des vertueux -->
        <input class=button type="submit" id="find_words_french_jv" name="find_words_french_jv" value="Hadith">
        <input class=word_to_find type="text" id="word_french_jv" name="word_french_jv" placeholder="Créateur">

        <!-- Poids des mots  -->
        <input class=button type="submit" id="poids_sourates" name="poids_sourates" value="Poids des sourates">

    </form>
    </div>
    

    <div class=parchemin >
        <div class=text_parchemin>
            <?php    

            // Variables Globales
            //$tableau_poids_sourate = [0];

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
                $title = '<div style="font-size:1.55em;color:blue;font-weight:bold;">Sourate '.$num_sourate_arabe.'</div></br></br>';
                $poids_sourate = 0;

                while(!feof($fh)){
                    $line =fgets($fh);
                    $line_splits = explode("|",$line);
                    
                    #echo $num_sourate; echo "<------->"; echo $line_splits[0];  echo '<br/>';
                    if(strcmp($line_splits[0],$num_sourate_arabe)==0){
                        $result = $result.'<div style="font-size:0.85em;color:green">Sourate: '.$line_splits[0].'   Ayyat: '.$line_splits[1].'</div> <div style="font-size:1.85em;color:#0e3c68;font-weight:bold;">'.$line_splits[2].'</div></br>';

                        #calcul du poids de la sourate
                        #$poids_sourate+=poids_phrase($line_splits[2]);
                    }
                }
                $result = $title.$result;
                $style = '<div style="padding:15%;overflow:hidden;">';
                echo $style.'<Br/>Poids de la sourate : '.$poids_sourate.'<Br/>';

                # Divible par 19 ?
                if($poids_sourate % 19 === 0)
                    echo "Poids divible par 19 <Br\>";

                # Divible par 7 ?
                if($poids_sourate % 7 === 0)
                    echo "Poids divible par 7 <Br\>";

                # Divible par 12 ?
                if($poids_sourate % 12 === 0)
                    echo "Poids divible par 12 <Br\>";

                echo $result.'</div>';
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
                $style = '<div style="padding:15%;overflow:hidden;position:relative;">';
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
            
            ## 
            if(!empty($_POST['poids_sourates'])){
                goPageGraph();
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