<?php

    function create_keywords(){
        GLOBAL $db;	
        //
        $drop_tb = "DROP TABLE keywords";
        $db->Query($drop_tb);
        //
        $Create_Document = "CREATE TABLE keywords (
        ID_key INT(4)  UNSIGNED AUTO_INCREMENT PRIMARY KEY,   
        Keyword VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
        UNIQUE (Keyword)
        )";
       
    
        
        $db->Query($Create_Document ); 

      
    };

    
    function create_doc_key(){
        GLOBAL $db;	
        //
        $drop_tb = "DROP TABLE doc_key";
        $db->Query($drop_tb);
        //
        $Create_Document = "CREATE TABLE doc_key (
         ID_Document int(4) UNSIGNED,
         ID_key int(4) UNSIGNED,
         frequency int(3),
         rate Int(1) NOT NULL,
         PRIMARY KEY (ID_Document,ID_key),
         FOREIGN KEY (ID_Document) REFERENCES Document (ID_Document),
         FOREIGN KEY (ID_key) REFERENCES keywords (ID_key)
        )";
        //
        


        $db->Query($Create_Document ); 

  
    };

    function insert_doc_key(){
        GLOBAL $db;
        
        $query = 'SELECT * FROM document  ';      

        $result = $db->Query($query);
        while($row = $result->fetch()) { 
            $ID_Document=$row["ID_Document"];
            $comment=$row["Comment_Document"];
            $last_id_doc = $ID_Document;

            $result2 = array_unique(explode(" ",$comment));
           
            foreach($result2 as $c){
        
                $sql="INSERT  INTO keywords(Keyword) VALUES ('$c') ";                
                $db->Query($sql );

                $last_id_key;
                //CONVERT('$c' USING binary)
                $stmt = $db->query("SELECT * FROM keywords WHERE Keyword=CONVERT('$c' USING binary)");

                
                while($row = $stmt->fetch()) { 
                    $last_id_key=$row["ID_key"];
                }

                //$last_id_key = $stmt->fetchColumn();
                //
                $sql_doc_key="INSERT  INTO doc_key(ID_Document,ID_key) VALUES ('$last_id_doc','$last_id_key')";
                $db->Query($sql_doc_key); 

                // echo $last_id_key."---".$c;

            }

        }  
        
    };
  
    function insert_doc_key_frequency(){
        GLOBAL $db;
        
        $query = 'SELECT  t.ID_Document,t.Rate_Document,keywords.ID_key,t.Comment_Document,keywords.Keyword
                    FROM keywords
                    INNER JOIN (SELECT  document.Comment_Document,doc_key.ID_key,doc_key.ID_Document, document.Rate_Document
                                FROM document
                                INNER JOIN doc_key
                                ON document.ID_Document = doc_key.ID_Document) as t
                    ON t.ID_key = keywords.ID_key';      
    
        $result = $db->Query($query);
        //
        while($row = $result->fetch()) { 
            $Keyword=$row["Keyword"];
            $ID_Document=$row["ID_Document"];
            $Rate_Document=$row["Rate_Document"];
           
            $ID_key=$row["ID_key"];
            $result2 = explode(" ",$row["Comment_Document"]); 
                     
            $i=0;
            foreach($result2 as $c){
               
                if($Keyword==$c){                   
                    $i++;
                   
                } 
            }
            //update frequency
            $sql="UPDATE doc_key
            SET frequency = '$i'
            WHERE ID_key = '$ID_key' AND ID_Document= $ID_Document";
            $db->Query($sql);
           
            //update rate 
            $sql2="UPDATE doc_key
            SET rate='$Rate_Document'
            WHERE ID_Document='$ID_Document'";
            $db->Query($sql2);
            

        }       
       
    };

   
    
?>