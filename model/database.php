<?php
    
    $dsn = 'mysql:host=localhost;dbname=ML_Naives_Bayes;charset=utf8';   
    $username = 'root';
    $password = '';
    
    

    try {
       
        $db = new PDO($dsn, $username, $password);               
        $db->exec("set names utf8"); 
        
        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('./errors/database_error.php');
        exit();
    }  
    
    
    
?>