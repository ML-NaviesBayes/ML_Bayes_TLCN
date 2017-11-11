<?php 
    require('./model/database.php');
    require('./model/document.php');
    $crawl = get_document();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Table Crawl</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Table Crawl</h2>
  
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Comment</th>
        <th>Rate</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($crawl as $crawls) : ?>
        <tr>
            <td><?php echo $crawls['ID_Crawl']; ?></td>
            <td><?php echo $crawls['Comment_Document']; ?></td>
            <td><?php echo $crawls['Rate_Document']; ?></td>
            
        </tr>
        <?php endforeach; ?>
     
    </tbody>
  </table>
</div>

</body>
</html>
