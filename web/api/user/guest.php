<?php
include ('../connect.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['userPhone'])) {
            $userPhone=$_POST['userPhone'];
            try {
                $sql="SELECT * FROM user WHERE phone='$userPhone'";
                if ($result = $mysqli -> query($sql)) {
                    echo "Returned rows are: " . $result -> num_rows;
                    $result -> free_result();
                }
                http_response_code(202);
                exit();
            } catch (\PDOException $e) {
                echo "Error: " . $e->getMessage();
                http_response_code(404);
                exit();
            }
        }
    }
    echo json_encode(array("Messenger" => "Please input data!"));
    http_response_code(404);
    exit();
?>