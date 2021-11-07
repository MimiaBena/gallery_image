<?php 
  include('connection.php');

?>

<!DOCTYPE html>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" type="text/css" href="assets/style.css">
    
  </head>
    
  <body>
      <form method="post" enctype="multipart/form-data">
          <input type="file" name="photo[]" multiple>
          <input type="submit" value="upload" name="submit">
      </form>
    
  </body>



</html>