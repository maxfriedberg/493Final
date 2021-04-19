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

  function postDownload($postsToDownload, $commentsToDownload) {
    if (mysqli_num_rows($postsToDownload) > 0) {
      while ($single_post = mysqli_fetch_assoc($postsToDownload)) {
        if (is_null($single_post['image'])) {
          echo "<figure><figcaption>" . $single_post['text'] . "</figcaption>";
        }
        else {
          echo "<figure><figcaption>" . $single_post['text'] . "</figcaption>";
          echo "<img src='uploads/".$single_post['image']."' >";
        }
        $post_postid = $single_post['postid'];
        $comment_found = FALSE;
        echo "<div class='commentsintro'>Comments</div>";
        if (mysqli_num_rows($commentsToDownload) > 0) {
          while ($single_comment = mysqli_fetch_assoc($commentsToDownload)) {
            $comment_postid = $single_comment['postid'];
            if ($post_postid == $comment_postid) {
              $comment_found = TRUE;
              echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $single_comment['text'] . "</span></figcaption>";
            }
          }
        }
        echo "<br><form><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'></form>";
        echo "</figure>";
        if ($comment_found == TRUE) {
          echo "<br><br>";
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

  function commentUpload($commentCategory, $commentText, $postID) {
    if ($commentCategory == 'covid') {
      $sqlinsert = "INSERT INTO covidcomments (text, postid, commentid) VALUES ('$commentText', '$postID', NULL);";
      mysqli_query($uploadDB, $sqlinsert);
    }
    else {
      $sqlinsert = "INSERT INTO funcomments (text, postid, commentid) VALUES ('$commentText', '$postID', NULL);";
      mysqli_query($uploadDB, $sqlinsert);
    }
  }

?>
