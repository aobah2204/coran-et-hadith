<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Coran Arabe / Français</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@700&display=swap" rel="stylesheet">
    <style>
        
        #container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .column {
            width: 48%;
            padding: 15px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0,0,0,0.15);
            font-size: 22px;
            line-height: 1.8;
            direction: rtl;
        }

        .fr {
            direction: ltr;
        }

        .controls {
            margin-bottom: 2px;
        }

        button {
            padding: 8px 14px;
            font-size: 18px;
            cursor: pointer;
        }

        #pageNum {
            font-weight: bold;
            font-size: 22px;
        }
    </style>
</head>
<body>
    
    <div class="page-coran" id="page-coran">
        <div class="text-ar">
            <?php  
              ## goPageCoran
              if(!empty($_POST['page_coran'])){
                  $page = intval($_POST['num_page']);
                  if ($page < 1) $page = 1;
                  if ($page > 604) $page = 604;
                  read_coran_page($page);
              } 
            ?>   
        </div>      
    </div>    

    <?php
            $page = 1; // commence à la page 1
            $max = 604;
            
            ## FunctionRead and print the coran text 
            function read_coran_page($num_page){
                $fh = fopen('quran-uthmani-min-page.txt', 'r');
                $result = '';
                $style = "<div style='padding:15%;overflow:hidden; font-size:0.85em;color:#0e3c68;font-weight:bold; font-family:Scheherazade New, serif;direction:rtl;'>";
                
                $asma_ar = ["اللَّه", "ِ الرَّحمٰنِ", "الرَّحيمِ","لِلَّهِ", "رَبِّ","رَبَّ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ", "رَبِّهِمْ", "رَبَّنَا", "رَبِّكَ", "رَبُّكَ","الرَّحمٰنِ","الرَّحيمِ","مٰلِكِ","القُدُّوس","السَّلَام",
                        "المُؤْمِن","المُهَيْمِن", "العَزِيز","الجَبَّار","المُتَكَبِّر","الخَالِق","البَارِىء","المُصَوِّر","الغَفَّار", "القَهَّار","الوَهَّاب","الرَّزَّاق","الفَتَّاح","العَلِيم","القَابِض","البָاسِط",
                        "الخَافِض","الرَّافِع","المُعِزّ","المُذِلّ","السَّمِيع","البَصِير","الحَكَم","العَدْل", "اللَّطِيف","الخَبِير","الحَلِيم","العَظِيم","الغَفُور","الشَّكُور","العَلِيّ","الكَبِير",
                        "الحَفِيظ","المُقِيت","الحَسِيب","الجَلِيل","الكَرِيم","الرَّقِيب","المُجِيب","الوَاسِع", "الحَكِيم","الوَدُود","المَجِيد","البَاعِث","الشَّهِيد","الحَقّ","الوَكِيل","القَوِيّ",
                        "المَتِين","الوَلِيّ","الحَمِيد","المُحْصِي","المُبْدِئ","المُعِيد","المُحْيِي","المُمِيت", "الحَيّ","القَيّوم","الوَاجِد","المَاجِد","الوَاحِد","الأَحَد","الصَّمَد","القَادِر",
                        "المُقْتَدِر","المُقَدِّم","المُؤَخِّر","الأَوَّل","الآخِر","الظَّاهِر","البَاطِن", "الوَالِي","المُتَعَالِي","البَرّ","التَّوَّاب","المُنْتَقِم","العَفُوّ","الرَّؤُوف",
                        "مَالِكُ المُلْك","ذُو الجَلَال وَالإِكْرَام","المُقْسِط","الجَامِع","الغَنِيّ","المُغْنِي", "المَانِع","الضَّار","النَّافِع","النُّور","الهَادِي","البَدِيع","البَاقِي","الوَارِث",
                        "الرَّشِيد","الصَّبُور", "هُوَ الَّذى", "رَبُّكَ", "إِنّى", "أَنّى"];
                
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

                foreach ($asma_ar as $mot) {
                    $result = str_replace($mot, "<span style='color:red;'>$mot</span>", $result);
                }

                $bismillah_list = ["بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ","بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ", "بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ", "بِسمِ اللَّهِ الرَّحمٰنِ الرَّحيمِ"];

                foreach ($bismillah_list as $bismillahi){
                    $result = str_replace($bismillahi, "<Br/><span class='bismillah'>".$bismillahi."</span><Br/>", $result);                    
                } 

                echo $result;
            }

            function nextPage() {
              echo "Page :".$page;
              if ($page < $max) {
                $page++;
                read_coran_page($page);
              }
            }

            function prevPage() {
              echo "Page :".$page;
              if ($page > 1) {
                $page--;
                read_coran_page($page);
              }
            }            
    ?>

</body>
</html>
