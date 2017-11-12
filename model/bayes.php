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
        //echo $classifier_1."<br>";
        //
        $sql_classifier_2="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=2";

        $classifier_2=($db->Query($sql_classifier_2)->fetchColumn()+1)/$total; 
        //echo $classifier_2."<br>";

        //
        $sql_classifier_3="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=3";

        $classifier_3=($db->Query($sql_classifier_3)->fetchColumn()+1)/$total;   
        //echo $classifier_3."<br>";
        //
        $sql_classifier_4="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=4";

        $classifier_4=($db->Query($sql_classifier_4)->fetchColumn()+1)/$total; 
        //echo $classifier_4."<br>";
        //
        $sql_classifier_5="SELECT COUNT(ID_Document) 
        FROM document WHERE Rate_Document=5";
        //$query_classifier_5=$db->Query($sql_classifier_5);
        //$classifier_5 = $db->Query($sql_classifier_5)->fetchColumn();
        //$classifier_5=$db->Query($sql_classifier_5)->fetchColumn()+1;
        $classifier_5=($db->Query($sql_classifier_5)->fetchColumn()+1)/$total;  
        //echo $classifier_5."<br>";






        //tinh vector V
        $query_v="SELECT COUNT(ID_key) 
        FROM keywords";
        $vector = $db->Query($query_v)->fetchColumn();
        
       





        //classifier_4
     
        //total of keyword
        $query_id_key="SELECT `ID_key` FROM `keywords` ORDER BY `ID_key` ASC";
        $result=$db->Query($query_id_key);
        $N4=0; // total of all keyword
        $Laplace_smoothing; //kỹ thuật Laplace smoothing
        $sum_N4_totalKey; //sum of N4 and total keyword 
        $lamda4=array(); // lamda of N4

        $A=array();
        
        while($row = $result->fetch()) {
            $ID_key=$row['ID_key'];
           
            $total_keyword=0; //total of a keyword
            

            $query_classifier_4="SELECT * FROM document WHERE Rate_Document=4";
            $result1=$db->Query($query_classifier_4);  
            
            while($row = $result1->fetch()) {
                $ID_Document=$row['ID_Document'];
                //echo $ID_Document."<br>";
                
                $query_doc_key="SELECT * FROM doc_key WHERE ID_Document='$ID_Document'";
                $result2=$db->Query($query_doc_key);
            
                while($row = $result2->fetch()) {
                    $ID_key2=$row['ID_key'];
            
                    if($ID_key2==$ID_key){
                        $frequency=$row['frequency'];
                        //echo $frequency;
                        $total_keyword+=$frequency;
                       
                    }
                   

                    
                }
                
            }
           // 
           array_push($A,$total_keyword);          
           //
          
           $N4+=$total_keyword; //total of all keyword
                    
            
    
        }
       
              
        // echo "total of all keyword=".$N4."<br>";
        // echo "vector V=".$vector."<br>"; 
        $sum_N4_totalKey=$N4+$vector; //sum=N4+|V|
        //
        foreach($A as $a){

            $b=($a+1)/$sum_N4_totalKey;
            array_push($lamda4,$b);
        }
        
        foreach($lamda4 as $ld){
            echo $ld."<br>";
        }
     
       
        
        

        
    }

    


?>