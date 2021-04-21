<?php

  function postUpload($uploadCategory, $imagePresent, $uploadText, $uploadDB, $uploadImage, $uploadDest, $uploadTempName) {

    if ($uploadCategory == "covid") {
      if ($imagePresent == FALSE) {
        $sqlinsert = "INSERT INTO covid (text, image, location) VALUES ('$uploadText', NULL, NULL);";
        mysqli_query($uploadDB, $sqlinsert);
      }
      elseif ($imagePresent == TRUE) {
        $sqlinsert = "INSERT INTO covid (text, image, location) VALUES ('$uploadText', '$uploadImage', NULL);";

        move_uploaded_file($uploadTempName, $uploadDest);

        mysqli_query($uploadDB, $sqlinsert);
      }
    }
    elseif ($uploadCategory == "fun") {
      if ($imagePresent == FALSE) {
        $sqlinsert = "INSERT INTO fun (text, image) VALUES ('$uploadText', NULL);";
        mysqli_query($uploadDB, $sqlinsert);
      }
      elseif ($imagePresent == TRUE) {
        $sqlinsert = "INSERT INTO fun (text, image) VALUES ('$uploadText', '$uploadImage');";

        move_uploaded_file($uploadTempName, $uploadDest);

        mysqli_query($uploadDB, $sqlinsert);
      }
    }
  }

  function commentUpload($commentCategory, $commentText, $postID, $uploadDB) {
    if ($commentCategory == 'covid') {
      $sqlinsert = "INSERT INTO covidcomments (text, postid) VALUES ('$commentText', '$postID');";
      mysqli_query($uploadDB, $sqlinsert);
    }
    else {
      $sqlinsert = "INSERT INTO funcomments (text, postid) VALUES ('$commentText', '$postID');";
      mysqli_query($uploadDB, $sqlinsert);
    }
  }

?>
