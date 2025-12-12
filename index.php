<?php
include 'db/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookmark Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Bookmark Manager</h1>

    
    <form action="process.php" method="post">
        <input type="text" name="title" placeholder="Bookmark Title" required>
        <input type="url" name="url" placeholder="https://example.com" required>
        <input type="submit" value="Add Bookmark">
    </form>

    <h2>Saved Bookmarks</h2>
    <ul>
        <?php
        
        $sql = "SELECT * FROM bookmarks ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<li>';
                echo '<a href="' . htmlspecialchars($row['url']) . '" target="_blank">' . htmlspecialchars($row['title']) . '</a>';
                echo ' <a href="edit.php?id=' . $row['id'] . '">[Edit]</a>';
                echo ' <a href="delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this bookmark?\')">[Delete]</a>';
                echo '</li>';
            }
        } else {
            echo "<li>No bookmarks yet.</li>";
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>
