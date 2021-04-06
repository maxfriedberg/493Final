<?php
	include_once 'connectdb.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TEST</title>

		<style>
			img {
				width: 300px;
				height: 200px;
				object-fit: cover;
			}
		</style>

	</head>
	<body style="text-align:center">

		<form method="post">
        <input type="submit" name="selectcovidbutton"
                value="COVID"/>

        <input type="submit" name="selectfunbutton"
                value="FUN"/>
    </form>

		<br>

		<form method="post" enctype="multipart/form-data">
			Create Post! <input type="text" name="createpost">
			<br>
			<br>
			<label for="category">Select Post Category! </label>
			<select id="category" name="category">
    		<option value="covid">COVID</option>
    		<option value="fun">FUN</option>
  		</select>
			<br>
			<br>

  		<!--Select image to upload:
  		<input type="file" name="image">
  		<input type="submit" value="Upload" name="image">

			<br>
			<br>
			-->

  		<input type="submit">
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
			if (isset($_POST['createpost'])) {
				$fixed = str_replace("'", "''", $_POST['createpost']);
				if (isset($_POST['category'])) {
					$postcategory = $_POST['category'];
					if ($postcategory == "covid") {
						$sqlinsert = "INSERT INTO covid (text, image, location) VALUES ('$fixed', NULL, NULL);";

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
						$sqlinsert = "INSERT INTO fun (text, image) VALUES ('$fixed', NULL);";

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
			}

		?>

	</body>
</html>
