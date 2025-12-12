<?php
include 'db/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    
    $stmt = $conn->prepare("SELECT * FROM bookmarks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookmark = $result->fetch_assoc();
    $stmt->close();

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $url = $_POST['url'];

        if (!empty($title) && filter_var($url, FILTER_VALIDATE_URL)) {
            $stmt = $conn->prepare("UPDATE bookmarks SET title = ?, url = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $url, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Bookmark</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Edit Bookmark</h1>

<form action="" method="post">
    <input type="text" name="title" value="<?= htmlspecialchars($bookmark['title']); ?>" required>
    <input type="url" name="url" value="<?= htmlspecialchars($bookmark['url']); ?>" required>
    <input type="submit" value="Update Bookmark">
</form>

<p><a href="index.php">Back to bookmarks</a></p>
</body>
</html>
