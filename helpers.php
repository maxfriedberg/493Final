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

  function postDownload($postsToDownload) {
    if (mysqli_num_rows($postsToDownload) > 0) {
      while ($single_post = mysqli_fetch_assoc($postsToDownload)) {
        if (is_null($single_post['image'])) {
          echo "<figure><figcaption>" . $single_post['text'] . "</figcaption></figure>";
        }
        else {
          echo "<figure><img src='uploads/".$single_post['image']."' >";
          echo "<figcaption>" . $single_post['text'] . "</figcaption></figure>";
        }
      }
    }
  }

  function displaySidebar() {
    echo "<div class='sidebarcontainer'>";
      echo "<span class='sidebarintrotext'>Helpful Links</span>";
      echo "<br><br>";
      echo "<a href='https://www.cdc.gov/coronavirus/2019-ncov/index.html' target='_blank' class='sidebarlinkbutton'>CDC COVID Info</a>";
      echo "<br><br><br>";
      echo "<a href='https://campusblueprint.umich.edu/dashboard/' target='_blank' class='sidebarlinkbutton'>UM COVID Info</a>";
      echo "<br><br><br>";
      echo "<a href='https://uhs.umich.edu/covid-testing' target='_blank' class='sidebarlinkbutton'>UHS COVID Testing</a>";
      echo "<br><br><br>";
      echo "<a href='https://www.washtenaw.org/3269/COVID-19-Vaccination' target='_blank' class='sidebarlinkbutton'>Washtenaw Vaccinations</a>";
    echo "</div>";
  }

?>
