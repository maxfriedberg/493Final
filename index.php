<?php
	include_once 'connectdb.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TEST</title>

		<link rel="stylesheet" href="style.css">

	</head>
	<body style="text-align:center">

		<form method="post">
        <input type="submit" name="selectcovidbutton"
                value="COVID-Related" class="selectorbutton"/>
								<span style="padding-left: 10px;padding-right: 10px;font-family: Helvetica, sans-serif;font-size:
								24px;font-weight: bold;vertical-align: middle;">
									Choose what type of posts you want to see</span>
        <input type="submit" name="selectfunbutton"
                value="Fun Posts" class="selectorbutton"/>
    </form>

		<br>

		<form method="post" enctype="multipart/form-data">
			Create Your Own Post!
			<!-- <input type="text" name="text"> -->
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

			<!-- the input button below is to finally/completely submit the post -->
  		<input type="submit" name="createpost" value="Submit Post">
		</form>

		<br>

		<?php

			if (isset($_POST['selectcovidbutton'])) {
				$sql = "SELECT * FROM covid;";
				$selected_posts = mysqli_query($dbconnection, $sql);

				if (mysqli_num_rows($selected_posts) > 0) {
					while ($single_post = mysqli_fetch_assoc($selected_posts)) {
						if (is_null($single_post['image'])) {
							//original, text only echo code
							echo $single_post['text'] . "<br>";
						}
						else {
							//image echo code, followed by: . "<br>";
							//followed by: original, text only echo code (above)
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
							//original, text only echo code
							echo $single_post['text'] . "<br>";
						}
						else {
							//image echo code, followed by: . "<br>";
							//followed by: original, text only echo code (above)
							echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
							echo $single_post['text'] . "<br>";
						}
					}
				}
			}
			if (!empty($_POST['text']) && isset($_POST['createpost'])) {
				if (!empty($_FILES['image']['name'])) {
					global $dir, $target, $size, $fileType, $badUpload;
					$dir = "uploads/";
					$target = $dir . basename($_FILES['image']['name']);
					$size = $_FILES["image"]["size"];
					$fileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
				}
				$fixed = str_replace("'", "''", $_POST['text']);
				if (isset($_POST['category']) && $size <= 3000000 && ($fileType == "jpg" ||
				$fileType == "png" || $fileType == "jpeg" || $fileType == "gif")) {
					$postcategory = $_POST['category'];
					if ($postcategory == "covid") {

						if (empty($_FILES['image']['name'])) {
							$sqlinsert = "INSERT INTO covid (text, image, location) VALUES ('$fixed', NULL, NULL);";
						}
						else {
							$image = str_replace("'", "''", $_FILES['image']['name']);

							$sqlinsert = "INSERT INTO covid (text, image, location) VALUES ('$fixed', '$image', NULL);";

							$dest_dir = "uploads/";
							$dest_file = $dest_dir . basename($_FILES['image']['name']);

							move_uploaded_file($_FILES['image']['tmp_name'], $dest_file);
						}

						$sqlselect = "SELECT * FROM covid;";

						mysqli_query($dbconnection, $sqlinsert);

						$selected_posts = mysqli_query($dbconnection, $sqlselect);

						if (mysqli_num_rows($selected_posts) > 0) {
							while ($single_post = mysqli_fetch_assoc($selected_posts)) {
								if (is_null($single_post['image'])) {
									//original, text only echo code
									echo $single_post['text'] . "<br>";
								}
								else {
									//image echo code, followed by: . "<br>";
									//followed by: original, text only echo code (above)
									echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
									echo $single_post['text'] . "<br>";
								}
							}
						}
					}
					if ($postcategory == "fun") {

						if (empty($_FILES['image']['name'])) {
							$sqlinsert = "INSERT INTO fun (text, image) VALUES ('$fixed', NULL);";
						}
						else {
							$image = str_replace("'", "''", $_FILES['image']['name']);

							$sqlinsert = "INSERT INTO fun (text, image) VALUES ('$fixed', '$image');";

							$dest_dir = "uploads/";
							$dest_file = $dest_dir . basename($_FILES['image']['name']);

							move_uploaded_file($_FILES['image']['tmp_name'], $dest_file);
						}

						$sqlselect = "SELECT * FROM fun;";

						mysqli_query($dbconnection, $sqlinsert);

						$selected_posts = mysqli_query($dbconnection, $sqlselect);

						if (mysqli_num_rows($selected_posts) > 0) {
							while ($single_post = mysqli_fetch_assoc($selected_posts)) {
								if (is_null($single_post['image'])) {
									//original, text only echo code
									echo $single_post['text'] . "<br>";
								}
								else {
									//image echo code, followed by: . "<br>";
									//followed by: original, text only echo code (above)
									echo "<img src='uploads/".$single_post['image']."' >" . "<br>";
									echo $single_post['text'] . "<br>";
								}
							}
						}
					}
				}
				if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
					echo "<b> Error: Invalid File (Only JPG, JPEG, PNG, GIF Supported)</b><br><br>";

				}
				if ($size > 3000000) {
					echo "<b> Error: File Must Be Less Than 3MB";
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
								//original, text only echo code
								echo $single_post['text'] . "<br>";
							}
							else {
								//image echo code, followed by: . "<br>";
								//followed by: original, text only echo code (above)
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
								//original, text only echo code
								echo $single_post['text'] . "<br>";
							}
							else {
								//image echo code, followed by: . "<br>";
								//followed by: original, text only echo code (above)
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
