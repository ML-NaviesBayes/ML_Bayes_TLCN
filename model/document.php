<?php

    function create_document(){
        GLOBAL $db;	
        //
        $drop_tb = "DROP TABLE Document";
        $db->Query($drop_tb);
        //
        $Create_Document = "CREATE TABLE Document (
        ID_Document INT(4)  UNSIGNED AUTO_INCREMENT PRIMARY KEY,   
        ID_Crawl INT(4) UNSIGNED NOT NULL,
        Comment_Document Text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
        Rate_Document Int(1) NOT NULL,
        FOREIGN KEY (ID_Crawl) REFERENCES Crawl(ID_Crawl)
        )";
        $db->Query($Create_Document ); 
    };

    function insert_document(){
        GLOBAL $db;	
        $sql = "SELECT ID_Crawl, Comment_Crawl,Rate_Crawl FROM Crawl ";
        $result = $db->Query($sql);
        
        while($row = $result->fetch()) { 
                $id_crawl=$row['ID_Crawl'];
                $Star= $row["Rate_Crawl"];
                $comment=$row["Comment_Crawl"];
                $trim_comment= trim($comment);
                $recomment=reg($trim_comment); 
                $recomment= trim($recomment);
                $recomment2=preg_replace('/\s+/', ' ', $recomment);
                $strtolowers=mb_strtolower($recomment2);
                
                $recomment_stopword=cut_stopword($strtolowers);

               // $recomment_stopword=cut_stopword($strtolowers);
             

                $cut_stopword_sql = "INSERT INTO document (ID_Crawl,Comment_Document,Rate_Document)
                    VALUES ('$id_crawl','$recomment_stopword','$Star')";
                        
                    
                    
                $db->Query($cut_stopword_sql );    
            }          
    };

    function get_document() {
        global $db;
        $query = 'SELECT * FROM document
                  ORDER BY ID_Crawl';
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement;    
    };

    function a() {
        global $db;
        $query = 'SELECT * FROM document
        WHERE ID_Document= 1 ';
        $result = $db->Query($query);
        while($row = $result->fetch()) { 
            //$id_crawl=$row['ID_Crawl'];
            //$Star= $row["Rate_Crawl"];
            $comment=$row["Comment_Document"];
            $b= trim($comment);
            //$recomment=reg($comment);  
            $c=preg_replace('/\s+/', ' ', $b);
            $recomment_stopword=cut_stopword($c);
            print_r (explode(' ',$recomment_stopword));
            //echo $recomment_stopword;
            

           
         

                    
                
                
           // $db->Query($cut_stopword_sql );    
        }     
  
        
    };
        
?>