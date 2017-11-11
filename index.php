<?php
include('model/database.php');
include('model/crawl.php');
include('model/document.php');
include('model/handle.php');
include('model/keyword.php');




//goi ham 
// create_table_crawl();
// create_document();
// insert_document();

// // //xóa và tạo bảng keyword
create_keywords();

// //xóa và tạo bảng doc_key
 create_doc_key();

 insert_doc_key();

insert_doc_key_frequency();



// if("thật"=="thất"){                   
   
//     echo "bang";
// } else{
//     echo "ko bang";
// }




?>