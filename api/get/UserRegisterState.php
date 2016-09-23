<?php
/**
 * Created by IntelliJ IDEA.
 * User: tompi
 * Date: 11.09.2016
 * Time: 12:19
 */

$email = $_POST["email"];
$password = $_POST["password"];

if ($email != "" || $password != "") {
    if (preg_match('#^([a-zA-Z0-9\.\_\-]+)@([a-zA-Z0-9\.\-]+\.[A-Za-z][A-Za-z]{1,4})$#', $email)) {
        if ($password != "") {

            include_once("../../assets/website/php/db.php");

            $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

            if (mysqli_connect_errno()) {
                printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
                header('Content-Type: application/json');
                echo '[{"error":{errorId: "ERWEB05",description: "MySQL Error"}}]';
                exit();
            }

            $query = mysqli_query($db, "SELECT * FROM veiron_users WHERE email='$email' AND password='$password'");
            $result = mysqli_fetch_assoc($query);

            if(mysqli_num_rows($query) != 0){
                header('Content-Type: application/json');
                if($result["sessionId"] == "0"){
                    $isActive = "false";
                } else {
			mysqli_query($db, "UPDATE veiron_users SET sessionId='0' WHERE email='$email'");
                    	$isActive = "false";
                }
                echo '[{"upid": "'.$result["upid"].'","username": "'.$result["username"].'","isActive": "'.$isActive.'"}]';
            } else {
                header('Content-Type: application/json');
                echo '[{"error":{errorId: "ERWEB04",description: "This user dont exist!"}}]';
            }
            mysqli_close($db);

        } else {
            header('Content-Type: application/json');
            echo '[{"error":{errorId: "ERWEB03",description: "Password not validate!"}}]';
        }

    } else {
        header('Content-Type: application/json');
        echo '[{"error":{errorId: "ERWEB02",description: "Email not validate!"}}]';
    }
} else {
    header('Content-Type: application/json');
    echo '[{"error":{errorId: "ERWEB01",description: "Data not validate!"}}]';
}

?>