<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookmarkDB";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];

    
    if(!empty($title) && filter_var($url, FILTER_VALIDATE_URL)) {
        $stmt = $conn->prepare("INSERT INTO bookmarks (title, url) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $url);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();


header("Location: index.php");
exit;
?>
