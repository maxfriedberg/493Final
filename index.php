<?php
	include_once 'connectdb.php';
	include_once 'helpers.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TEST</title>

		<link rel="stylesheet" href="style.css">

	</head>
	<body class="fullsite">

		<div class="navbar">
			<form method="post">
				<span class="navbarsitename">Forum/Imageboard Name (UM Community Site)</span><br>
	        <input type="submit" name="selectcovidbutton"
	                value="COVID-Related" class="selectorbutton"/>
									<span class="navbarselectortext">
										Choose what type of posts you want to see</span>
	        <input type="submit" name="selectfunbutton"
	                value="Fun Posts" class="selectorbutton"/>
	    </form>
		</div>

		<div class="createpostform">
			<form method="post" enctype="multipart/form-data">
				<span class="createpostintrotext">Create your own post!</span>
				<br>
				<br>

				<span class="createpostcategorycontainer">
					<label for="category" class="createpostcategorytext">Select Post Category </label>
						<select id="category" name="category" class="createpostcategorymenu">
	    				<option value="covid">COVID-Related</option>
	    				<option value="fun">Fun Posts</option>
	  				</select>
				</span>

				<span class="createpostfilecontainer">
					<label for="fileUpload" class="createpostfiletext">Select photo </label>
					<input id="fileUpload" type="file" name="image">
				</span>

				<br>

				<p class="intextalign">
					<span class="createposttextcontainer">
	  				<label for="textarea" class="createposttextdisplay">Add Text </label>
	  				<textarea id="textarea" name="text" rows="4" cols="50" class="createposttextadd"></textarea>
					</span>
				</p>

	  		<input type="submit" name="createpost" value="Submit Post" class="createpostsubmitbutton">
			</form>
		</div>

		<br>

		<?php

			if (isset($_POST['selectcovidbutton'])) {
				displaySidebar();
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
						echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
					}

					mysqli_free_result($selected_comments);

					echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
	        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
	        echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
	        echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='covid'>";
	        echo "</form></figure><br><br>";
	      }
			}
			if (isset($_POST['selectfunbutton'])) {
				displaySidebar();
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
						echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
					}

					mysqli_free_result($selected_comments);

					echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
	        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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

						displaySidebar();

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
								echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
							}

							mysqli_free_result($selected_comments);

							echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
			        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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
								echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
							}

							mysqli_free_result($selected_comments);

							echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
			        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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

					displaySidebar();

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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
						echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
						echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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

					displaySidebar();

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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
		        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
						echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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

					displaySidebar();

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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
		        echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
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
							echo "<figcaption><span class='comments' style='font-weight: normal;'>" . $comment['text'] . "</span></figcaption>";
						}

						mysqli_free_result($selected_comments);

						echo "<br><form method='post'><textarea name='commenttext' rows='3' cols='64' class='commentadd'>Add a comment!</textarea><br>";
						echo "<br><input type='submit' name='createcomment' value='Submit Comment' class='createpostsubmitbutton' style='background-color: #E0E0E0;'>";
						echo "<input type='hidden' id='postID' name='commentPostID' value='".$post['postid']."'>";
						echo "<input type='hidden' id='postCategory' name='commentPostCategory' value='fun'>";
						echo "</form></figure><br><br>";
					}
				}
			}


		?>

	</body>
</html>
