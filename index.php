
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

            # script chart js
            function graph($donnees){
                // Les données du tableau
                #$donnees = array("Janvier" => 120, "Février" => 80, "Mars" => 200, "Avril" => 160);

                // Paramètres du graphique
                $largeur = 500;
                $hauteur = 300;
                $marge_gauche = 50;
                $marge_bas = 40;
                $marge_haut = 20;

                // Créer l'image
                $image = imagecreate($largeur, $hauteur);

                // Définir les couleurs
                $blanc = imagecolorallocate($image, 255, 255, 255);
                $noir = imagecolorallocate($image, 0, 0, 0);
                $bleu = imagecolorallocate($image, 0, 0, 255);

                // Remplir le fond en blanc
                imagefill($image, 0, 0, $blanc);

                // Calculer la largeur de chaque barre
                $nb_barres = count($donnees);
                $espace_barre = ($largeur - $marge_gauche) / $nb_barres;

                // Trouver la valeur maximale pour l'échelle du graphique
                $valeur_max = max($donnees);

                // Dessiner les barres
                $index = 0;
                foreach ($donnees as $label => $valeur) {
                    // Calculer la hauteur de la barre proportionnellement à la valeur maximale
                    $hauteur_barre = round(($valeur / $valeur_max) * ($hauteur - $marge_bas - $marge_haut));
                    $x1 = round($marge_gauche + $index * $espace_barre + 10);
                    $y1 = round($hauteur - $marge_bas - $hauteur_barre);
                    $x2 = round($x1 + $espace_barre - 20);
                    $y2 = round($hauteur - $marge_bas);

                    // Dessiner la barre
                    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $bleu);

                    // Ajouter le label en dessous de chaque barre
                    imagestring($image, 2, $x1 + 5, $hauteur - $marge_bas + 5, $label, $noir);

                    // Ajouter la valeur au-dessus de chaque barre
                    imagestring($image, 2, $x1 + 5, $y1 - 15, $valeur, $noir);

                    $index++;
                }

                // Dessiner l'axe des Y
                imageline($image, $marge_gauche, $hauteur - $marge_bas, $marge_gauche, $marge_haut, $noir);

                // Dessiner l'axe des X
                imageline($image, $marge_gauche, $hauteur - $marge_bas, $largeur, $hauteur - $marge_bas, $noir);

                // Afficher l'image
                //header('Content-Type: image/png');
                imagepng($image);
                imagedestroy($image);
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
            

            ## Count weight
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

            // Normalisation des données pour l'affichage
            $donnees_log = array_map(function($x) {
                    return round(log10($x), 3);
                }, $donnees);

            ?>
        </div>
    

        <!--<div style="width:100%; height:3000px; overflow:hidden; position:center">
            <canvas id="histogramme" height="500"></canvas>
        </div>-->
    
    <script>
        const ctx = document.getElementById('histogramme').getContext('2d');
        const histogramme = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($etiquettes); ?>,
                datasets: [{
                    label: 'Poids des sourates du Coran',
                    data: <?php echo json_encode($donnees_log); ?>,
                    backgroundColor: 'rgba(54, 163, 235, 0.58)',
                    borderColor: 'rgba(54, 235, 160, 1)',
                    borderWidth: 1
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
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    </script>

    </div>
    <div class=footer>
        <img class=logo src='coran_transp.png'>
        <p>@Author: Bah Amadou Oury</p>
    </div>

</body>

</html>