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

				<label for="category" class="createpostcategorytext">Select Post Category </label>
					<select id="category" name="category" class="createpostcategorymenu">
	    			<option value="covid">COVID-Related</option>
	    			<option value="fun">Fun Posts</option>
	  			</select>

				<label for="fileUpload" class="createpostfiletext">Select photo </label>
				<input id="fileUpload" type="file" name="image">

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
				$sql = "SELECT * FROM covid;";
				$selected_posts = mysqli_query($dbconnection, $sql);
				postDownload($selected_posts);
			}
			if (isset($_POST['selectfunbutton'])) {
				$sql = "SELECT * FROM fun;";
				$selected_posts = mysqli_query($dbconnection, $sql);
				postDownload($selected_posts);
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
						postDownload($selected_posts);
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
						postDownload($selected_posts);
					}
				}
			}
			elseif (empty($_POST['text']) && isset($_POST['createpost'])) {

				echo "<b> Error: Text is required to post</b><br><br>";

				$postcategory = $_POST['category'];

				if ($postcategory == "covid") {
					$sqlselect = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sqlselect);
					postDownload($selected_posts);
				}
				if ($postcategory == "fun") {
					$sqlselect = "SELECT * FROM fun;";
					$selected_posts = mysqli_query($dbconnection, $sqlselect);
					postDownload($selected_posts);
				}
			}

		?>

	</body>
</html>
