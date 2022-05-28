<?php
<<<<<<< HEAD
    function fetchCandidates($db_credentials)
    {
        $conn = new mysqli(
            $db_credentials["server"],
            $db_credentials["user"],
            $db_credentials["pass"],
            $db_credentials["db_name"],
            $db_credentials["port"]
        );
    
        // preparation of prepared statement
        $stmt = $conn->prepare("SELECT * FROM candidatesTBL");
        // execution
        $stmt->execute();
        // result retrieval
        $results = $stmt->get_result();
        //define CandidateName as an array
        $candidateNames = array();

        //Fill up Candidate Names
        while($candidates = mysqli_fetch_assoc($results)){
            array_push($candidateNames , $candidates['full_name']);
            
        }

        return $candidateNames;
        
        $conn->close();
        $stmt->close();

    }

?>
=======
>>>>>>> 25524b6518d74088ff85afb297a7a48e75ed1f3a
