<?php
require 'constituents/db.php';

// get blog id from URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


if ($blog_id > 0) {
    // fetch blog data 
    $sql = "SELECT title, content, category, created_at FROM blogs WHERE id = $blog_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of the specific blog
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $content = $row["content"];
        $category = $row["category"];
        $created_at_blog = $row["created_at"];
    } else {
        echo "Blog not found.";
    }
    } else {
    echo "Invalid blog ID.";
    }

// Check if form data is set and cname is not "Admin: Sazedur"
if(isset($_POST['cname']) && isset($_POST['comment'])) {
    $cname = $_POST['cname'];
    $comment = $_POST['comment'];

    // Validate cname
    if ($cname == "Admin: Sazedur") {
        $bsm = "You can't use the name: Admin: Sazedur";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO comments (blog_id, cname, comment) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $blog_id, $cname, $comment);

            // Execute and check for success
            if ($stmt->execute()) {
                $bsm = "Comment Added";
            } else {
                $bsm = "Comment Adding Failed: " . $stmt->error;
            }
            $stmt->close();
        }else {
            $bsm = "Failed to prepare the SQL statement.";
        }
    }
}
// getting category
$sql_blog_cat = "SELECT category FROM category WHERE id = '$category'";
$result_blog_cat = $conn->query($sql_blog_cat);
if ($result_blog_cat->num_rows > 0) {
    while ($row_blog_cat = $result_blog_cat->fetch_assoc()) {
        $blog_cat = $row_blog_cat['category'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'constituents/favicon.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resstyle.css">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <div class="container">

        <!-- navbar starts  -->
        <?php include 'constituents/navbar.php' ?>
        <!-- navbar ends -->


        <!-- blog starts  -->
        <div class="show-blog-container">
            <div class="show-blog">
                <div class="blog-title">
                    <h2>
                    <?php echo htmlspecialchars($title); ?>
                    </h2><br>
                </div>
                <div class="blog-text">
                    <p>
                        <?php echo $content; ?>
                    </p>
                </div>
                <br><br>
                <div class="blog-bottom-line">
                    <span>Posted on: <span style="color: gray;"><?php echo htmlspecialchars($created_at_blog); ?></span></span>
                    <br>
                    <span>Category: <em><?php echo htmlspecialchars($blog_cat); ?></em></span>
                </div>
            </div>
        </div>
        <!-- blog ends  -->


        <!-- comment starts -->
        <div class="comment-container">
            <div class="add-comment-box">
                <div class="add-comment">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $blog_id; ?>" method="POST">
                        <b style="display: inline-block; margin-bottom: 10px;">What are your thoughts on this post?</b>
                        <div style="display: inline-block; color: green; margin-bottom: 10px; padding: 5px;"><em><?php 
                        if(!empty($bsm)){
                            echo $bsm;
                            } ?></em></div>
                        <input name="cname" type="text" placeholder="Your name?" style="width: 100%; margin-bottom: 10px; height: 50px; padding: 10px; font-size: 15px;">
                        <div class="add-comment-input">
                            <input name="comment" type="text" placeholder="Add a comment?">
                            <button type="submit">Comment</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="comment-box">
                <div class="comment-title">
                    <h3 style="margin-bottom: 10px;">Comments</h3>
                </div>

                <?php
                    // Comment viewing 
                    $sql_comment = "SELECT * FROM comments WHERE blog_id = '$blog_id' ORDER BY created_at DESC";
                    $comment_result = $conn->query($sql_comment);
                    if($comment_result->num_rows > 0){
                        while ($row_comment = $comment_result->fetch_assoc()) {
                            $cname = $row_comment['cname'];
                            $comment_text = $row_comment['comment'];
                            $created_at_comment = $row_comment['created_at'];
                ?>

                <div class="comment-box-each">
                    <div class="name">
                        <b><?php echo htmlspecialchars($cname); ?></b>
                    </div>
                    <div class="date">
                        <small><small><?php echo htmlspecialchars($created_at_comment); ?></small></small>
                    </div>
                    <div class="comment">
                        <p>
                            <?php echo htmlspecialchars($comment_text); ?>
                        </p>
                    </div>
                </div>
                <?php }} else{ 
                    
                 ?>
                    <div class="comment-box-each">
                        <em>No comments yet.</em>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- comment ends  -->

        
        <!-- copyright starts -->
        <?php include 'constituents/copyright.php'; ?>
        <!-- copyright ends  -->
    </div>
    <button onclick="goToTop()" id="topBtn">Go to Top</button>
    <script src="js/script.js"></script>
</body>
<style>
    img{
        width: 600px;
        border-radius: 10px;
    }
    @media screen and (max-width: 710px) {
        img{
            width: 400px;
        }
    }
    @media screen and (max-width: 400px) {
        img{
            width: 250px;
        }
    }
</style>
</html>