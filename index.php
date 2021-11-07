<?php 
  include('connection.php');

?>

<!DOCTYPE html>
<html>
  <head>
    
  </head>
    
  <body>
      <form method="post" enctype="multipart/form-data">
          <input type="file" name="photo[]" multiple>
          <input type="submit" value="upload" name="submit">
      </form>
    
  </body>



</html>