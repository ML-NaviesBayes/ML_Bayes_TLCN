<?php
include('model/database.php');
include('model/crawl.php');
include('model/document.php');
include('model/handle.php');
include('model/keyword.php');

include('model/bayes.php');


//goi ham 
// create_table_crawl();
// create_document();
// insert_document();

// //xóa và tạo bảng keyword
// create_keywords();

// // //xóa và tạo bảng doc_key
//  create_doc_key();

//  insert_doc_key();

// insert_doc_key_frequency();


ML_bayes();

// $query_doc_key_test="SELECT Keyword FROM keywords ORDER BY `ID_key` ASC ";
// $result_test2=$db->Query($query_doc_key_test);

// while ($row=$result_test2->fetch()) {
//  echo $row['Keyword']."<br>";
// }

?>