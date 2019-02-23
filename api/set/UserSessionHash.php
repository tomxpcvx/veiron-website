<?php

$email = $_POST["email"];

if ($email != "") {
    if (preg_match('#^([a-zA-Z0-9\.\_\-]+)@([a-zA-Z0-9\.\-]+\.[A-Za-z][A-Za-z]{1,4})$#', $email)) {

        include_once("../../assets/website/php/db.php");

        $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

        if (mysqli_connect_errno()) {
            printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
            header('Content-Type: application/json');
            echo '[{"error":{errorId: "ERWEB05",description: "MySQL Error"}}]';
            exit();
        }

        $query = mysqli_query($db, "SELECT * FROM veiron_users WHERE email='$email'");
        $resultUser = mysqli_fetch_assoc($query);

        $sessionId = hash('sha256', time().$email);
        if (mysqli_num_rows($query) != 0) {
            $query = mysqli_query($db, "UPDATE veiron_users SET sessionId='$sessionId' WHERE email='$email'");
            if (mysqli_affected_rows($db) != 0) {
                header('Content-Type: application/json');
                if ($resultUser["transactionId"] == "0") {
                    $bought = "false";
                } else {
                    $bought = "true";
                }
                echo '[{"upid": "'.$resultUser["upid"].'","username": "'.$resultUser["username"].'","sessionId": "'.$sessionId.'"}]';
            } else {
                header('Content-Type: application/json');
                echo '[{"error":{errorId: "ERWEB04",description: "Cant update user!"}}]';
            }


        } else {
            header('Content-Type: application/json');
            echo '[{"error":{errorId: "ERWEB04",description: "This user dont exist!"}}]';
        }
        mysqli_close($db);

    } else {
        header('Content-Type: application/json');
        echo '[{"error":{errorId: "ERWEB02",description: "Email not validate!"}}]';
    }
} else {
    header('Content-Type: application/json');
    echo '[{"error":{errorId: "ERWEB01",description: "Data not validate!"}}]';
}

?>