<?php
    function ML_bayes(){
        GLOBAL $db;
        //query total
        $a=""; 
        $sql_total="SELECT COUNT(ID_Document) 
        FROM document";
        $querytotal=$db->Query($sql_total);
        $total = $querytotal->fetchColumn();
        //P(Ci)
        $sql_classifier_1="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=1";

        $classifier_1=($db->Query($sql_classifier_1)->fetchColumn()+1)/$total;      
        echo $classifier_1."<br>";
        //
        $sql_classifier_2="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=2";

        $classifier_2=($db->Query($sql_classifier_2)->fetchColumn()+1)/$total; 
        echo $classifier_2."<br>";

        //
        $sql_classifier_3="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=3";

        $classifier_3=($db->Query($sql_classifier_3)->fetchColumn()+1)/$total;   
        echo $classifier_3."<br>";
        //
        $sql_classifier_4="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=4";

        $classifier_4=($db->Query($sql_classifier_4)->fetchColumn()+1)/$total; 
        echo $classifier_4."<br>";
        //
        $sql_classifier_5="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=5";
        //$query_classifier_5=$db->Query($sql_classifier_5);
        //$classifier_5 = $db->Query($sql_classifier_5)->fetchColumn();
        //$classifier_5=$db->Query($sql_classifier_5)->fetchColumn()+1;
        $classifier_5=($db->Query($sql_classifier_5)->fetchColumn()+1)/$total;  
        echo $classifier_5."<br>";

        //tinh vector V
        $query_v="SELECT COUNT(ID_key) 
        FROM keywords";
        $vector = $db->Query($query_v)->fetchColumn();
        
        echo "vector".$vector."<br>";

        //class 1
        
    }

    


?>