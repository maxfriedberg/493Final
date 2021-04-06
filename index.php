<?php
	include_once 'connectdb.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TEST</title>
	</head>
	<body style="text-align:center">

		<form method="post">
        <input type="submit" name="selectcovidbutton"
                value="COVID"/>

        <input type="submit" name="selectfunbutton"
                value="FUN"/>
    </form>

		<br>

		<form method="post">
			Create Post! <input type="text" name="createpost">
			<br>
			<br>
			<label for="category">Select Post Category! </label>
			<select id="category" name="category">
    		<option value="covid">COVID</option>
    		<option value="fun">FUN</option>
  		</select>
  		<input type="submit">
		</form>

		<br>

		<?php

			if (isset($_POST['createpost'])) {
				$fixed = str_replace("'", "''", $_POST['createpost']);
				if (isset($_POST['category'])) {
					$postcategory = $_POST['category'];
					if ($postcategory == "covid") {
						$sql = "INSERT INTO covid (text, image, location) VALUES ('$fixed', NULL, NULL);";
					}
					if ($postcategory == "fun") {
						$sql = "INSERT INTO fun (text, image) VALUES ('$fixed', NULL);";
					}
					mysqli_query($dbconnection, $sql);
				}
			}

		?>

		<?php
			if (isset($_POST['selectcovidbutton'])) {
					$sql = "SELECT * FROM covid;";
					$selected_posts = mysqli_query($dbconnection, $sql);

					if (mysqli_num_rows($selected_posts) > 0) {
						while($single_post = mysqli_fetch_assoc($selected_posts)) {
							echo $single_post['text'] . "<br>";
						}
				  }
			}
			if (isset($_POST['selectfunbutton'])) {
				$sql = "SELECT * FROM fun;";
				$selected_posts = mysqli_query($dbconnection, $sql);

				if (mysqli_num_rows($selected_posts) > 0) {
					while($single_post = mysqli_fetch_assoc($selected_posts)) {
						echo $single_post['text'] . "<br>";
					}
				}
			}
		?>

	</body>
</html>
