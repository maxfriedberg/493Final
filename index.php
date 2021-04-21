<?php
	include_once 'connectdb.php';
	include_once 'helpers.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="scripts/page.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <title>COVID Forum</title>
    </head>


    <body>
        <!-- Header -->
        <div class='header'>
            <p>Ann Arbor Community Forum</p>
        </div>

    	<!-- Button group -->
    	<div class="row" style="left: 125px; margin-bottom: 20px;">
    	    <div class="btn-group mx-auto">
						<form method="post">
							<button class="btn btn-primary" type="submit" name="selectcovidbutton">COVID Info</button>
						</form>
						<form method="post">
							<button class="btn btn-primary" type="submit" name="selectfunbutton">Fun Posts</button>
						</form>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create Post</button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button" id="New-CovidInfo">COVID Info</button>
                    <button class="dropdown-item" type="button" id="New-Funpost">Fun Posts</button>
                </div>
            </div>
    	</div>

        <!-- Sidebar w/ Map -->
        <div class='sidebar'>
            <!-- Map -->
    	    <div id="Map">
                <iframe height="200" width="300" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2952.0781838996077!2d-83.73789956055973!3d42.27685438662087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1617908463079!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <hr style='color:black;height:2px'>
            <div class='testing_links'>
                <h6>Testing Locations</h6>
                <a href="https://www.lynxdx.com/" target="_blank">LynxDx, Inc</a>
                <br>
                <a href="https://www.walgreens.com/findcare/covid19/testing" target="_blank">COVID-19 Drive-Thru Testing at Walgreens</a>
                <br>
                <a href="https://www.cvs.com/store-locator/ann-arbor-mi-pharmacies/2100-w-stadium-blvd-ann-arbor-mi-48103/storeid=8088?WT.mc_id=LS_GOOGLE_FS_8088" target="_blank">CVS</a>
                <br>
                <a href="https://www.riteaid.com/locations/mi/ann-arbor/2603-jackson-avenue.html" target="_blank">Rite Aid</a>
            </div>
            <hr style='color:black;height:2px'>

            <div class='vaccine_links'>
                <h6>Vaccination Info</h6>
                <a href="https://www.washtenaw.org/3269/COVID-19-Vaccination" target="_blank">Washtenaw County Vaccine Info</a>
                <br>
                <a href="https://www.uofmhealth.org/coronavirus/vaccine-info-update" target="_blank">UofM Health Vaccine Info</a>
                <br>
                <a href="https://www.stjoeshealth.org/health-and-wellness/covid-19/schedule-vaccine" target="_blank">Saint Joseph Vaccine Appt.</a>

            </div>
        </div>

        <div class='submissions'>
        <!-- Input box for Covid Info -->
	        <div class="row d-none" id="NewpostForCovid">
	            <form method="post" class="mx-auto" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="image">Add Photo (COVID Info)</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="text">Add Text (COVID Info)</label>
                        <textarea rows="5" class="form-control" name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="createpost">Post</button>
										<input type='hidden' name='category' value='covid'>
                    <button type="button" class="btn btn-primary" id="Cancel">Cancel</button>
                </form>
            </div>

        <!-- Input box for Fun Post -->
	        <div class="row d-none" id="NewpostFun">
	            <form method="post" class="mx-auto" enctype="multipart/form-data">
										<div class="form-group ">
											<label for="image">Add Photo (Fun Posts)</label>
											<input type="file" class="form-control-file" name="image">
										</div>
                    <div class="form-group">
                        <label for="text">Add Text (Fun Posts)</label>
                        <textarea rows="5" class="form-control" name="text"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="createpost">Post</button>
										<input type='hidden' name='category' value='fun'>
                    <button type="button" class="btn btn-primary" id="Cancel2">Cancel</button>
                </form>
            </div>
        </div>

       <!--Posts Section-->
			 <!--
       <br><br><br><br><br><br>
       <figure>
         <figcaption>Example Post #1</figcaption>
         <img src="uploads/mountain.JPG">
       </figure>
       <br>
       <figure>
         <figcaption>Example Post #2</figcaption>
       </figure>
       <br>
       <figure>
         <figcaption>Example Post #3</figcaption>
         <img src="uploads/walking.JPG">
       </figure>
       <br>
		 	 -->




    	<!--jQuery and Bootstrap JS-->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script >

      /*$("#category-covid").click(function() {

        alert("Hi");

      });
			*/

      $("#New-CovidInfo").click(function() {
				$("#NewpostForCovid").toggleClass('d-none');
				if(!$("#Map").hasClass('d-none')) {
					// $("#Map").addClass('d-none');
				}
				if($("#NewpostForCovid").hasClass('d-none')) {
					// $("#Map").removeClass('d-none');
				}
				$("#NewpostFun").addClass('d-none');
			});

			$("#Cancel").click(function() {
				$("#NewpostForCovid").addClass('d-none');
				// $("#Map").removeClass('d-none');
			});

			$("#Cancel2").click(function() {
				$("#NewpostFun").addClass('d-none');
				// $("#Map").removeClass('d-none');
			});

			$("#New-Funpost").click(function() {
				$("#NewpostFun").toggleClass('d-none');
				if(!$("#Map").hasClass('d-none')) {
					// $("#Map").addClass('d-none');
				}
				if($("#NewpostFun").hasClass('d-none')) {
					// $("#Map").removeClass('d-none');
				}
				$("#NewpostForCovid").addClass('d-none');
			});


		</script>

		<br><br><br><br><br><br>

		<?php

			if (isset($_POST['selectcovidbutton'])) {
					$sqlposts = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

			    while ($post = mysqli_fetch_assoc($selected_posts)) {
				   	if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM covidcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
						echo "</form></figure><br><br>";
					}
			}
			if (isset($_POST['selectfunbutton'])) {
					$sqlposts = "SELECT * FROM fun;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

			    while ($post = mysqli_fetch_assoc($selected_posts)) {
				   	if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM funcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
						echo "</form></figure><br><br>";
					}
			}
			if (!empty($_POST['text']) && isset($_POST['createpost'])) {
				$fixed = str_replace("'", "''", $_POST['text']);
				if (isset($_POST['category'])) {
					$postcategory = $_POST['category'];
					if ($postcategory == "covid") {

						if (empty($_FILES['image']['name'])) {
							postUpload($postcategory, FALSE, $fixed, $dbconnection, "nostring", "nostring", "nostring");
						}
						else {
							$image = str_replace("'", "''", $_FILES['image']['name']);
							$dest_file = "uploads/" . basename($_FILES['image']['name']);
							postUpload($postcategory, TRUE, $fixed, $dbconnection, $image, $dest_file, $_FILES['image']['tmp_name']);
						}

						$sqlposts = "SELECT * FROM covid;";
						$selected_posts = mysqli_query($dbconnection, $sqlposts);

						while ($post = mysqli_fetch_assoc($selected_posts)) {
							if (is_null($post['image'])) {
					      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
					    }
					    else {
					      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
					      echo "<img src='uploads/".$post['image']."' >";
					    }

					    echo "<div class='commentsintro'>Comments</div>";

							$currentPostID = $post['postid'];
							$sqlcomments = "SELECT * FROM covidcomments WHERE postid='".$currentPostID."';";
							$selected_comments = mysqli_query($dbconnection, $sqlcomments);

							while ($comment = mysqli_fetch_assoc($selected_comments)) {
								echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
							}

							mysqli_free_result($selected_comments);

							echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
							echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
							echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
							echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
							echo "</form></figure><br><br>";
			      }
					}
					if ($postcategory == "fun") {

						if (empty($_FILES['image']['name'])) {
							postUpload($postcategory, FALSE, $fixed, $dbconnection, "nostring", "nostring", "nostring");
						}
						else {
							$image = str_replace("'", "''", $_FILES['image']['name']);
							$dest_file = "uploads/" . basename($_FILES['image']['name']);
							postUpload($postcategory, TRUE, $fixed, $dbconnection, $image, $dest_file, $_FILES['image']['tmp_name']);
						}

						$sqlposts = "SELECT * FROM fun;";
						$selected_posts = mysqli_query($dbconnection, $sqlposts);

						while ($post = mysqli_fetch_assoc($selected_posts)) {
							if (is_null($post['image'])) {
					      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
					    }
					    else {
					      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
					      echo "<img src='uploads/".$post['image']."' >";
					    }

					    echo "<div class='commentsintro'>Comments</div>";

							$currentPostID = $post['postid'];
							$sqlcomments = "SELECT * FROM funcomments WHERE postid='".$currentPostID."';";
							$selected_comments = mysqli_query($dbconnection, $sqlcomments);

							while ($comment = mysqli_fetch_assoc($selected_comments)) {
								echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
							}

							mysqli_free_result($selected_comments);

							echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
							echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
							echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
							echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
							echo "</form></figure><br><br>";
						}
					}
				}
			}
			elseif (empty($_POST['text']) && isset($_POST['createpost'])) {

				echo "<b> Error: Text is required to post</b><br><br>";

				$postcategory = $_POST['category'];

				if ($postcategory == "covid") {


					$sqlposts = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM covidcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
						echo "</form></figure><br><br>";
					}
				}
				if ($postcategory == "fun") {
					$sqlposts = "SELECT * FROM fun;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM funcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
						echo "</form></figure><br><br>";
					}
				}
			}
			if (!empty($_POST['commenttext']) && isset($_POST['createcomment'])) {
				$comment_text = str_replace("'", "''", $_POST['commenttext']);
				$comment_postID = $_POST['commentPostID'];
				$comment_category = $_POST['commentPostCategory'];
				commentUpload($comment_category, $comment_text, $comment_postID, $dbconnection);

				$postcategory = $_POST['commentPostCategory'];

				if ($postcategory == "covid") {

					$sqlposts = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
				      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
				    }
				    else {
				      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
				      echo "<img src='uploads/".$post['image']."' >";
				    }

				    echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM covidcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
						echo "</form></figure><br><br>";
		      }
				}
				if ($postcategory == "fun") {
					$sqlposts = "SELECT * FROM fun;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM funcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
						echo "</form></figure><br><br>";
					}
				}
			}
			elseif (empty($_POST['commenttext']) && isset($_POST['createcomment'])) {

				echo "<b> Error: Text is required to comment</b><br><br>";

				$postcategory = $_POST['commentPostCategory'];

				if ($postcategory == "covid") {

					$sqlposts = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
				      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
				    }
				    else {
				      echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
				      echo "<img src='uploads/".$post['image']."' >";
				    }

				    echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM covidcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
						echo "</form></figure><br><br>";
		      }
				}
				if ($postcategory == "fun") {
					$sqlposts = "SELECT * FROM fun;";
					$selected_posts = mysqli_query($dbconnection, $sqlposts);

					while ($post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($post['image'])) {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
						}
						else {
							echo "<figure><figcaption>" . $post['text'] . "</figcaption>";
							echo "<img src='uploads/".$post['image']."' >";
						}

						echo "<div class='commentsintro'>Comments</div>";

						$currentPostID = $post['postid'];
						$sqlcomments = "SELECT * FROM funcomments WHERE postid='".$currentPostID."';";
						$selected_comments = mysqli_query($dbconnection, $sqlcomments);

						while ($comment = mysqli_fetch_assoc($selected_comments)) {
							echo "<figcaption style='padding: 0px;'><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<form method='post'><textarea name='commenttext' rows='2' cols='64' class='form-control' id='exampleFormControlTextarea1' style='margin-top: 5px;margin-bottom: 3px; resize: none;font-size: 12.75px;'>Add a comment!</textarea>";
						echo "<input type='submit' name='createcomment' value='Submit Comment' class='btn btn-secondary' style='background-color: #E0E0E0;color: black;padding: 1.75px 2.5px;font-size: 12.75px;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
						echo "</form></figure><br><br>";
					}
				}
			}

		?>

    </body>
</html>
