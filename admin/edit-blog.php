<?php
require '../constituents/db.php';

$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (isset($_POST['submit'])) {
    $blog_idd = $_POST['id'];
    $blog_title = $_POST['title'];
    $blog_content = $_POST['content'];
    $blog_category = $_POST['category'];
    // SQL query to update data
    $sql = "UPDATE blogs SET title=?, content=?, category=? WHERE id=?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $blog_title, $blog_content, $blog_category, $blog_idd);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Artist Update was successfull!')</script>";
    } else {
        echo "<script>alert('Artist Update Failed: " . $stmt->error . "')</script>";
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/resstyle.css">
    <title>Document</title>
</head>
<body>

<div class="container">
        <!-- navbar starts  -->
        <?php include '../constituents/navbarAdmin.php' ?>
        <!-- navbar ends -->

    <div class="create-blog-container">
            <div class="create-blog">
                <div class="adp">
                    <h1 style="margin-bottom: 30px;">Admin Panel</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="create-blog">
                        <div class="create-blog-title">
                            <h2 style="margin-bottom: 20px;">Edit Blog</h2>
                        </div>
                        <div class="bsm" style="margin-bottom: 10px; color: green;">
                            <b>
                                <?php if(!empty($bsm)){
                                echo $bsm;
                            } ?>
                            </b>
                        </div>
                        <div class="create-blog-form">
                            <?php
                            $sql_blogs = $conn->prepare("SELECT * FROM blogs WHERE id = ? ORDER BY created_at DESC");
                            $sql_blogs->bind_param("i", $blog_id);
                            $sql_blogs->execute();
                            $result_blogs = $sql_blogs->get_result();
        
                            if ($result_blogs->num_rows > 0) {
                                while ($row_blogs = $result_blogs->fetch_assoc()) {
                                    $blog_title_to_list = htmlspecialchars($row_blogs['title']);
                                    $blog_content_to_list = htmlspecialchars($row_blogs['content']);
                                    $blog_category_to_list = htmlspecialchars($row_blogs['category']);
                                    $blog_created_at_to_list = htmlspecialchars($row_blogs['created_at']);
                            ?>
                        
                            <input value="<?php echo $blog_title_to_list; ?>" class="blog-title-input" type="text" name="title" placeholder="Blog title..."
                                required><br>
                            <select class="category-selection-input" name="category" required>
                                <option value="" disabled selected>Select a category</option>
                                <?php
                                        // Query to select categories and ids ordered by created_at in descending order
                                        $sql = "SELECT id, category FROM category ORDER BY created_at DESC";
                                        $result_category = $conn->query($sql);
                                        
                                        // Check if there are results
                                        if ($result_category->num_rows > 0) {
                                            // Output data of each row
                                            while ($row = $result_category->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['category']) . "</option>";
                                            }
                                        }
                                        ?>
                            </select><br>
                            <textarea name="content" id="editTextarea" class="blog-content"><?php echo $blog_content_to_list; ?></textarea>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $blog_id; ?>">
                            <button name="submit" class="submitBtn" type="submit">Update Blog</button>
                            <?php break;}} ?>
                        </div>
                </div>
            </div>
        </div>
    </div>


     <!-- copyright starts -->
     <?php include '../constituents/copyright.php'; ?>
    <!-- copyright ends -->
</body>
</html>