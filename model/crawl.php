<?php

function crawl_data(){
	GLOBAL $db;
	//require gọi thư viện vào
	require('simple_html_dom.php');
	//require "simple_html_dom.php";
	//lấy html cua trang web ve
	$tenweb="https://www.thegioididong.com/dtdd";
	$html= file_get_html($tenweb);
	//echo $html;
	$data=$html->find("ul.cate li a");
	foreach ($data as $t) {
		$link= "https://www.thegioididong.com".$t->href;
		//echo "<h2>".$t->href."</h2>";
		$linksp= file_get_html($link);
		$rate=$linksp->find("ul.ratingLst div.rc");
		foreach ($rate as $comments) {
		$comment= $comments->plaintext;
		//echo $comment."-----------------";
		$Stars=$comments->find(".iconcom-txtstar");
		$Star= count($Stars);
		if($Star!=0){
			//echo $Star."<hr/>";
			$sql_Crawl_Data = "INSERT INTO Crawl (	Comment_Crawl, Rate_Crawl)
			VALUES ('$comment', '$Star')";
            //mysqli_query($conn_create, $sql_Crawl_Data);
            $db->Query($sql_Crawl_Data);
		}
		
		}
    }
};
////////////////////////////////////////////////////////////////
function create_table_crawl(){
	GLOBAL $db;	

	$drop_tb = "DROP TABLE Crawl";
	$db->Query($drop_tb);

    // sql to create table	
    $Create_Crawl = "CREATE TABLE Crawl (
	ID_Crawl INT(4)  UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
	Comment_Crawl Text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
	Rate_Crawl Int(1) NOT NULL
    )";
    
    $db->Query($Create_Crawl ); 
	crawl_data();
};
////////////////////////////////////////////////////////////////
function get_crawl() {
    global $db;
    $query = 'SELECT * FROM Crawl
              ORDER BY ID_Crawl';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;    
}
////////////////////////////////////////////////////////////////

?>