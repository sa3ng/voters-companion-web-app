<?php
require_once 'globals.php';

if (array_key_exists("REQUEST_METHOD", $_SERVER)) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $conn = connectDB($DB_CREDENTIALS);

        $stmt = $conn->prepare(
            "SELECT acc_id FROM accTBL WHERE name=?"
        );
        $stmt->bind_param("s", $_POST['user']);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();


        $user_id = -1;
        if (!(empty($result))) {
            $user_id = $result['acc_id'];

            // TO REMOVE THE FOREIGN KEY CONSTRANT THAT PREVENTS DELETION
            $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS = 0;");
            $stmt->execute();

            $stmt = $conn->prepare(
                "DELETE FROM accTBL 
                WHERE acc_id=?;"
            );
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $stmt = $conn->prepare(
                "DELETE FROM accCandidatesTBL 
                WHERE acc_id=?;"
            );
            $stmt->bind_param("i", $user_id);
            $stmt->execute();


            $stmt = $conn->prepare(
                "SELECT image_url FROM accProfileTBL WHERE acc_id=?"
            );
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            //delete image file if there is a associated link found in db
            $result_image_url = $stmt->get_result()->fetch_assoc();
            if (!(empty($result_image_url)))
                if (!(empty($result_image_url['image_url'])))
                    unlink($result_image_url['image_url']);

            $stmt = $conn->prepare(
                "DELETE FROM accProfileTBL 
                        WHERE acc_id=?;"
            );
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS = 1;");
            $stmt->execute();

            echo "OK";
        } else {
            echo "USER NOT FOUND TO DELETE";
        }

        $stmt->close();
        $conn->close();
    }
}
