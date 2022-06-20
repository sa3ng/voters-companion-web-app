<?php

require_once 'globals.php';

$conn = connectDB($DB_CREDENTIALS);

// Server-side validation prep
$stmt =  $conn->prepare(
    "SELECT full_name
    FROM candidatesTBL;"
);
$stmt->execute();
//server-side name validation
if (isset($_POST["candidate_name"])) {
    $result = $stmt->get_result();
    while ($current_row = $result->fetch_assoc()) {
        if ($_POST["candidate_name"] == $current_row["full_name"]) {
            echo "NAME_IN_DB";
            die();
        }
    }
}
$stmt->close();

// Server-side file validation
if (array_key_exists('candidate_image', $_FILES)) {
    if ($_FILES['candidate_image']['error'] > 0) {
        echo "ERROR_UPLOAD";
        die();
    }
}

// if script reaches this far, ok to do edits

if (isset($_POST["candidate_name"])) {
    $stmt =  $conn->prepare(
        "UPDATE candidatesTBL 
        SET full_name=?
        WHERE candidate_id = ?;"
    );

    $stmt->bind_param(
        "si",
        $_POST["candidate_desc"],
        $_POST["candidate_id"]
    );
    $stmt->execute();
}

$stmt =  $conn->prepare(
    "UPDATE candidatesTBL 
        SET bio=?
        WHERE candidate_id = ?;"
);

$stmt->bind_param(
    "si",
    $_POST["candidate_desc"],
    $_POST["candidate_id"]
);
$stmt->execute();
$stmt->close();

/*-------------------------------------------------------------------------
 We need to add an image associated with the candidate.
 Else, replace a candidate's if there is already present
-------------------------------------------------------------------------*/
if (array_key_exists('candidate_image', $_FILES)) //check if a file exists
{
    $stmt = $conn->prepare(
        "SELECT image_url FROM candidatesTBL WHERE candidate_id=?"
    );
    $stmt->bind_param("i", $_POST['candidate_id']);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if (is_null($result['image_url'])) { // add file and image_url
        $new_file_name = 'c' . time() . uniqid();
        $storage_dir = "../resources/images/candidate_images/";
        $target_directory = $storage_dir . $new_file_name;

        move_uploaded_file(
            $_FILES['candidate_image']['tmp_name'],
            $target_directory
        );

        $stmt = $conn->prepare(
            "UPDATE candidatesTBL 
            SET image_url=?
            WHERE candidate_id = ?;"
        );
        $stmt->bind_param("si", $target_directory, $_POST['candidate_id']);
        $stmt->execute();
        $stmt->close();
    } else { //retain the image_url but replace the file that will be located
        $target_directory = $result['image_url'];
        move_uploaded_file(
            $_FILES['candidate_image']['tmp_name'],
            $target_directory
        );
    }
}

//-------------------------------------------------------------------------

echo "OK";
die();

/* 

formData.append("candidate_name", $(editModalCandidateName).val().toUpperCase());
formData.append("candidate_desc", $(editModalCandidateDescription).val());
formData.append("candidate_id", $(editModalHiddenID).val());

*/
