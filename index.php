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
				Create Your Own Post!
				<br>
				<br>
				<label for="category">Select Post Category </label>
				<select id="category" name="category">
	    		<option value="covid">COVID-Related</option>
	    		<option value="fun">Fun Posts</option>
	  		</select>

				Select Photo <input type="file" name="image">
				<br>

				<p class="intextalign">
	  			<label for="textarea">Add Text </label>
	  			<textarea id="textarea" name="text" rows="4" cols="50"></textarea>
				</p>
				
	  		<input type="submit" name="createpost" value="Submit Post">
			</form>
		</div>

		<br>

		<?php

			if (isset($_POST['selectcovidbutton'])) {
				$sql = "SELECT * FROM covid;";
				$selected_posts = mysqli_query($dbconnection, $sql);

				if (mysqli_num_rows($selected_posts) > 0) {
					while ($single_post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($single_post['image'])) {
							echo $single_post['text'] . "<br>";
						}
						else {
							echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
							echo $single_post['text'] . "<br>";
						}
					}
				}
			}
			if (isset($_POST['selectfunbutton'])) {
				$sql = "SELECT * FROM fun;";
				$selected_posts = mysqli_query($dbconnection, $sql);

				if (mysqli_num_rows($selected_posts) > 0) {
					while ($single_post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($single_post['image'])) {
							echo $single_post['text'] . "<br>";
						}
						else {
							echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
							echo $single_post['text'] . "<br>";
						}
					}
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

						$sqlselect = "SELECT * FROM covid;";

						$selected_posts = mysqli_query($dbconnection, $sqlselect);

						if (mysqli_num_rows($selected_posts) > 0) {
							while ($single_post = mysqli_fetch_assoc($selected_posts)) {
								if (is_null($single_post['image'])) {
									echo $single_post['text'] . "<br>";
								}
								else {
									echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
									echo $single_post['text'] . "<br>";
								}
							}
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

						$sqlselect = "SELECT * FROM fun;";

						$selected_posts = mysqli_query($dbconnection, $sqlselect);

						if (mysqli_num_rows($selected_posts) > 0) {
							while ($single_post = mysqli_fetch_assoc($selected_posts)) {
								if (is_null($single_post['image'])) {
									echo $single_post['text'] . "<br>";
								}
								else {
									echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
									echo $single_post['text'] . "<br>";
								}
							}
						}
					}
				}
			}
			elseif (empty($_POST['text']) && isset($_POST['createpost'])) {

				echo "<b> Error: Text is required to post</b><br><br>";

				$postcategory = $_POST['category'];

				if ($postcategory == "covid") {
					$sqlselect = "SELECT * FROM covid;";

					$selected_posts = mysqli_query($dbconnection, $sqlselect);

					if (mysqli_num_rows($selected_posts) > 0) {
						while ($single_post = mysqli_fetch_assoc($selected_posts)) {
							if (is_null($single_post['image'])) {
								echo $single_post['text'] . "<br>";
							}
							else {
								echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
								echo $single_post['text'] . "<br>";
							}
						}
					}
				}
				if ($postcategory == "fun") {
					$sqlselect = "SELECT * FROM fun;";

					$selected_posts = mysqli_query($dbconnection, $sqlselect);

					if (mysqli_num_rows($selected_posts) > 0) {
						while ($single_post = mysqli_fetch_assoc($selected_posts)) {
							if (is_null($single_post['image'])) {
								echo $single_post['text'] . "<br>";
							}
							else {
								echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
								echo $single_post['text'] . "<br>";
							}
						}
					}
				}
			}

		?>

	</body>
</html>
