<?php
    function ML_bayes(){
        GLOBAL $db;
        //query total
        $a=""; 
        $sql_total="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t";

        $querytotal=$db->Query($sql_total);
        $total = $querytotal->fetchColumn();
        //echo $total."<br>";
        //P(Ci)
        $sql_classifier_1="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t   
        WHERE t.`Rate_Document`=1";
        
        $classifier_1=($db->Query($sql_classifier_1)->fetchColumn()+1)/$total;      
        //echo $classifier_1."<br>";
        //
        $sql_classifier_2="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t   
        WHERE t.`Rate_Document`=2";

        $classifier_2=($db->Query($sql_classifier_2)->fetchColumn()+1)/$total; 
        //echo $classifier_2."<br>";

        //
        $sql_classifier_3="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t   
        WHERE t.`Rate_Document`=3";

        $classifier_3=($db->Query($sql_classifier_3)->fetchColumn()+1)/$total;   
        //echo $classifier_3."<br>";
        //
        $sql_classifier_4="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t   
        WHERE t.`Rate_Document`=4";

        $classifier_4=($db->Query($sql_classifier_4)->fetchColumn()+1)/$total; 
        //echo $classifier_4."<br>";
        //
        $sql_classifier_5="SELECT COUNT(*) FROM (SELECT * FROM document LIMIT 0,63) as t   
        WHERE t.`Rate_Document`=5";
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
            

            $query_classifier_4="SELECT * FROM document WHERE Rate_Document=4 LIMIT 0,63";
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
            //echo $ld."<br>";
        }
        //end classifier 4
       
  










        //test row 64
        $query_keyword_test="SELECT `ID_key` FROM `keywords` ORDER BY `ID_key` ASC";
        $result_test=$db->Query($query_keyword_test);
        $frequency_test=0;
        $arr_test=array();
        while($row = $result_test->fetch()) {
            $frequency_test=0;
            $ID_key_test=$row['ID_key'];
            //echo $ID_key_test."<br>";
            $query_doc_key_test="SELECT * FROM doc_key WHERE ID_Document=64 ";
            $result_test2=$db->Query($query_doc_key_test);

            while ($row=$result_test2->fetch()) {
                # code...
                $ID_key_test2=$row['ID_key'];
                

                if($ID_key_test==$ID_key_test2){
                    $frequency_test=$row['frequency'];
                    
                    //echo $ID_key_test2."--".$frequency_test."<br>";
                    //array_push($arr_test,$frequency_test);   
                           
                }
               
            }
            array_push($arr_test,$frequency_test); 
            
           
        
        }
        foreach($arr_test as $ld){
            //echo $ld."<br>";
        }
        //print_r($arr_test);        
        //end test


        //tính công thức theo classifier 1.5x10^-4
        //
        $tong=0;
        for($i=0;$i<414;$i++){
            if($arr_test[$i]!=0){
                $tong+=$lamda4[$i]*$arr_test[$i];
                
            }
        }
        $tong.= $classifier_4;
        echo $tong;
        
    }
        
        
    

 

?>