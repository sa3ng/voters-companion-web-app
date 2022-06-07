<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if (false) {
			$em = "Sorry, your file is too large.";
		    header("Location: ../phpPages/usrPage.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../resources/images/user_images/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE accProfileTBL
				        SET image_url = '$new_img_name'
						WHERE acc_id = 1";
				mysqli_query($conn, $sql);
				header("Location: ../phpPages/usrPage.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: ../phpPages/usrPage.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: ../phpPages/usrPage.php?error=$em");
	}

}else {
	header("Location: ../phpPages/usrPage.php.php");
}