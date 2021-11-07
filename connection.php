<?php
    //Connecter à la base de donnée
    //base de donnée avec une table de 2 ligne (id et non de la photo)
   $database=mysqli_connect("localhost", "root", "", "galery");
   $nom_table="photo";

  //upload l'image

   if(isset($_POST['submit'])){
       echo uploadImage($nom_table);
   }
    

function uploadImage($nom_table){
    
    //creer les variables
      $upload= "Image/";
      $typeImageAllowded= array('jpg', 'png', 'jpeg', 'gif');
      $nomImage= array_filter($_FILES['photo']['name']);
      $tempNomImage=$_FILES["photo"]["tmp_name"];
    //utiliser trim pour supprimer les espaces ou d'autres caractère
      $nom_table= trim($nom_table);
    if(empty($nomImage)){
        $error="Selectionnez un fichier, Svp!";
        return $error;     
    }else if(empty($nom_table)){
        $error="Déclarez, Svp!";
            return error;
    }else{
        $error=$savedImageBasename='';
        foreach($nomImage as $index=>$file){
            $imageBasename = basename($nomImage[$index]);
            $imagePath = $upload.$imageBasename; 
             $typeImage = pathinfo($imagePath, PATHINFO_EXTENSION);
            
            if(in_array($typeImage, $typeImageAllowded )){
                //upload image
            if(move_uploaded_file($tempNomImage[$index], $imagePath)){
                    // Store image into database table
                    $savedImageBasename .= "('".$imageBasename."'),";
                }else{
                    $error = "File non upload";
                }
            }
            else{
    $error .= $_FILES['file_name']['name'][$index].' - file extensions not allowed<br> ';
 }
            }
            saveImage($savedImageBasename, $nom_table);
            
        }
        return $error;
    }
    

function saveImage($savedImageBasename, $nom_table){
        global $database;
        if(!empty($savedImageBasename)){
            $value = trim($savedImageBasename, ',');
            $saveImage="INSERT INTO ".$nom_table." (nom_photo) VALUES".$value;
            $ex= mysqli_query($database, $saveImage);
            if($ex){
                echo "Image sauvgardée!!";
            }else{
                echo "Error: " .$saveImage ."<br>" . $database->error;
            }
            
        }
    }


    $fetchImage= fetch_image($nom_table);

  //récuperer les données de la base
    function fetch_image($nom_table){
        global $database;
        $nom_table= trim($nom_table);
        if(!empty($nom_table)){
            $query = "SELECT * FROM ".$nom_table." ORDER BY id DESC";
        $result = mysqli_query($database, $query);
            if ($result->num_rows > 0) {
                $row= $result->fetch_all(MYSQLI_ASSOC);
                 return $row;       
             }else{
    
         echo "No Image is stored in the database";
                   }
            
                               }else{
            echo "Déclarer une table";
        }
    }





?>