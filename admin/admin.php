<?php
session_start();
// -------------------------------------------------------------------------
// login handling 
if (!isset($_SESSION['uname'])) {
    header('Location: ../login.php');
    exit;
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location: admin.php');
    exit;
}
// login handling ends 
// ------------------------------------------------------------------------

// database connection
require '../constituents/db.php';

// ------------------------------------------------------------------------
// blog submit handling starts
if(isset($_POST['title']) && isset($_POST['category']) && isset($_POST['content'])){
    // Get form data
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO blogs (title, category, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $category, $content);

    // showing success and error message
    if ($stmt->execute()) {
        $bsm = "Blog Added Successfully";
    } else {
        $bem = "Blog Adding Failed!";
    }
}
// blog submit handling ends
// ------------------------------------------------------------------------
// ------------------------------------------------------------------------
// comment submit handling starts
if(isset($_POST['acategory']) && !empty($_POST['acategory'])){
    $acategory = $conn->real_escape_string($_POST['acategory']);

    $sql = "INSERT INTO category (category) VALUES ('$acategory')";

    if ($conn->query($sql) === TRUE) {
        $csm = "New category added:"." ".$_POST['acategory'];
    } else {
        $cem = "Category adding failed";
    }
}
// comment submit handling ends
// ------------------------------------------------------------------------
// deleting handling:

// deleting blog
if(isset($_POST['blog_id'])){
    $delete_blog_id = $_POST['blog_id'];
    $sql_d_b = "DELETE FROM blogs WHERE id=$delete_blog_id";

    if ($conn->query($sql_d_b) === TRUE) {
        echo "<script>alert('Blog deleted');</script>";
    } else {
        echo "<script>alert('" . $conn->error."'); </script>";
    }
}
// deleting comment
if(isset($_POST['comment_id'])){
    $delete_comment_id = $_POST['comment_id'];
    $sql_d_c = "DELETE FROM comments WHERE id=$delete_comment_id";

    if ($conn->query($sql_d_c) === TRUE) {
        echo "<script>alert('Blog deleted');</script>";
    } else {
        echo "<script>alert('" . $conn->error."'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../constituents/favicon.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/resstyle.css">
    <title>Admin Panel</title>
</head>
<style>
    .create-blog-container,
    .create-category-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .create-blog,
    .create-category {
        width: 700px;
    }

    .blog-title-input,
    .category-selection-input,
    .category-creating-inputs input {
        height: 50px;
        width: 100%;
        font-size: 15px;
        margin: 0px 0px 10px 0px;
        padding: 10px;
    }

    .text-editor {
        margin: 10px 0px 10px 0px;
    }

    .submitBtn {
        border: 1px solid black;
        padding: 10px;
        text-decoration: none;
        background-color: black;
        color: white;
        cursor: pointer;
        width: 120px;
    }

    .submitBtn:hover {
        background-color: white;
        color: black;
    }
</style>
<body onload="enableEditMode()">
    <div class="container">
        <!-- navbar starts  -->
        <?php include '../constituents/navbarAdmin.php' ?>
        <!-- navbar ends -->


        <!-- blog create starts  -->
        <div class="create-blog-container">
            <div class="create-blog">
                <div class="adp">
                    <h1 style="margin-bottom: 30px;">Admin Panel</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="create-blog">
                        <div class="create-blog-title">
                            <h2 style="margin-bottom: 20px;">Create Blog</h2>
                        </div>
                        <div class="bsm" style="margin-bottom: 10px; color: green;">
                            <b>
                                <?php if(!empty($bsm)){
                                echo $bsm;
                            } ?>
                            </b>
                        </div>
                        <div class="create-blog-form">
                            <input class="blog-title-input" type="text" name="title" placeholder="Blog title..."
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
                            </select>
                            <br>
                            <div class="text-editor">
                                <!-- Add editor buttons -->
                                <div
                                    style="display: flex; flex-direction: row; justify-content: space-around; flex-wrap: wrap;">
                                    <button type="button" onclick="Edit('bold')" title="bold"><i
                                            class="fa fa-bold"></i></button>
                                    <button type="button" onclick="Edit('italic')" title="italic"><i
                                            class="fa fa-italic"></i></button>
                                    <button type="button" onclick="Edit('underline')" title="underline"><i
                                            class="fa fa-underline"></i></button>
                                    <button type="button" onclick="Edit('strikeThrough')" title="strikeThrough"><i
                                            class="fa fa-strikethrough"></i></button>
                                    <button type="button" onclick="Edit('justifyLeft')" title="Align Left"><i
                                            class="fa fa-align-left"></i></button>
                                    <button type="button" onclick="Edit('justifyCenter')" title="Align Center"><i
                                            class="fa fa-align-center"></i></button>
                                    <button type="button" onclick="Edit('justifyFull')" title="justify"><i
                                            class="fa fa-align-justify"></i></button>
                                    <button type="button" onclick="Edit('cut')" title="cut"><i
                                            class="fa fa-cut"></i></button>
                                    <button type="button" onclick="Edit('copy')" title="Copy"><i
                                            class="fa fa-copy"></i></button>
                                    <button type="button" onclick="Edit('indent')" title="text-indent"><i
                                            class="fa fa-indent"></i></button>
                                    <button type="button" onclick="Edit('outdent')" title="text outdent"><i
                                            class="fa fa-outdent"></i></button>
                                    <button type="button" onclick="Edit('subscript')" title="subscript"><i
                                            class="fa fa-subscript"></i></button>
                                    <button type="button" onclick="Edit('superscript')" title="superscript"><i
                                            class="fa fa-superscript"></i></button>
                                    <button type="button" onclick="Edit('undo')" title="undo"><i
                                            class="fa fa-undo"></i></button>
                                    <button type="button" onclick="Edit('redo')" title="redo"><i
                                            class="fa fa-redo"></i></button>
                                    <button type="button" onclick="Edit('insertUnorderedList')"
                                        title="unordered list"><i class="fa fa-list-ul"></i></button>
                                    <button type="button" onclick="Edit('insertOrderedList')" title="ordered list"><i
                                            class="fa fa-list-ol"></i></button>
                                    <button type="button" onclick="Edit('insertParagraph')"><i
                                            class="fa fa-paragraph"></i></button>
                                    <select onchange="execVal('formatBlock',this.value)">
                                        <option value="H1">H1</option>
                                        <option value="H2">H2</option>
                                        <option value="H3">H3</option>
                                        <option value="H4">H4</option>
                                        <option value="H5">H5</option>
                                        <option value="H6">H6</option>
                                    </select>
                                    <button type="button"
                                        onclick="Edit('insertImage',prompt('Enter image URL, http://'))"
                                        title="insert image">insert image</button>
                                    <button onclick="Edit('insertHorizontalRule')" title="insert Horizontal Rule">insert
                                        Horizontal Rule</button>
                                    <button onclick="Edit('createLink',prompt('Enter a URL,http://'))"><i
                                            class="fa fa-link"></i></button>
                                    <button onclick="Edit('unlink')"><i class="fa fa-unlink"></i></button>
                                    <select onchange="execVal('fontName',this.value)">
                                        <option value="Arial">Arial</option>
                                        <option value="Comic Sans MS">Comic Sans MS</option>
                                        <option value="Courier">Courier</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Tahoma">Tahoma</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Verdana">Verdana</option>
                                    </select>
                                    <select onchange="execVal('fontSize',this.value)" title="font size">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>Font Color<input type="color" onchange="execVal('foreColor',this.value)" />
                                    Highlight<input type="color" onchange="execVal('hiliteColor',this.value)" />
                                    <button onclic="Edit('SelectAll')">Select All</button>
                                </div>
                            </div>
                            <em>Enter your writting here: <br></em>
                            <iframe id="blogTextt" name="richTextField" style="width:100%; height: 600px; display: block;
                            border: 1px solid black; margin-bottom: 10px;">
                            </iframe>
                        </div>
                        <input type="hidden" name="content" id="blogContent">
                        <button class="submitBtn" type="submit">Save Blog</button>
                    </div>
            </div>
            </form>
        </div>
    <!-- blog create ends  -->


    <!-- category create starts -->
    <div class="create-category-container">
        <div class="create-category">
            <div class="create-category-title">
                <h2 style="margin-bottom: 20px;">Create Category</h2>
            </div>
            <div class="csm" style="margin-bottom: 10px;">
                <b style="color: green">
                    <?php if(!empty($csm)){
                                echo $csm;
                            } ?>
                </b>
            </div>
            <div class="create-category-form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="category-creating-inputs">
                        <input name="acategory" type="text" placeholder="Add New Category...">
                        <button class="submitBtn" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- category create ends -->

    <!-- All Blogs starts -->
    <div class="blog-box-container-ultimate" style="display: flex; justify-content:center; margin-top: 40px;">
    <div class="blog-list-container" style= "width: 700px;">
        <div class="blog-list">
            <div class="blog-list-title">
                <h2>Blog List</h2>
            </div>
            <?php
                    $sql_blogs = "SELECT * FROM blogs ORDER BY created_at DESC";
                    $result_blogs = $conn->query($sql_blogs);
                    if($result_blogs->num_rows > 0){
                        while($row_blogs = $result_blogs->fetch_assoc()){
                            $blog_id_to_list = $row_blogs['id'];
                            $blog_title_to_list = $row_blogs['title'];
                            $blog_content_to_list = $row_blogs['content'];
                            $blog_category_to_list = $row_blogs['category'];
                            $blog_created_at_to_list = $row_blogs['created_at'];
                            
                            $sql_catogory_for_blog = "SELECT category FROM category WHERE id = '$blog_category_to_list'";
                            $result_category_for_blog = $conn->query($sql_catogory_for_blog);
                            if($result_category_for_blog->num_rows > 0){
                                while($row_category_for_blog = $result_category_for_blog->fetch_assoc()){
                                    $blog_category_to_list_real = $row_category_for_blog['category'];
                                }
                            }
                            ?>
                <div class="blog-box-each-container" style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
                <div class="blog-list-each">
                    <div class="blog-list-blog-title">
                        <h3>
                            <?php echo htmlspecialchars($blog_id_to_list)."."." "; ?>
                            <?php echo htmlspecialchars($blog_title_to_list); ?>
                        </h3>
                    </div>
                    <div class="blog-list-blog-content">
                        <p>
                            <?php echo $blog_content_to_list; ?>
                        </p>
                    </div>
                    <div class="blog-list-blog-time-and-cat">
                        <span>Posted on:
                            <span style="color: gray">
                                <?php echo htmlspecialchars($blog_created_at_to_list); ?>
                            </span>
                        </span>
                        <br>
                        <span>Category:
                            <?php echo htmlspecialchars($blog_category_to_list)."-".htmlspecialchars($blog_category_to_list_real); ?>
                        </span>
                    </div>
                    <div class="actionBtn">
                        <!-- <form method="post" action="edit-blog.php">
                            <input type="hidden" name="blog_id" value="<?php echo $blog_id_to_list; ?>">
                            <input class="normalBtn" type="submit" name="edit" value="Edit">
                        </form> -->
                        <form method="post" action="admin.php" onsubmit="return confirmDelete()">
                            <input type="hidden" name="blog_id" value="<?php echo $blog_id_to_list; ?>">
                            <input id="dangerBtn" class="dangerBtn" type="submit" name="delete" value="Delete">
                        </form>
                        <a href="edit-blog.php?id= <?php echo $blog_id_to_list; ?>"><button class="normalbtn">Edit</button></a>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
    </div>
    <!-- All Blogs ends -->

    <!-- All Comments starts -->
    <div class="comment-container">
        <div class="comment">
            <div class="comment-title">
                <h2>Comments</h2>
            </div>
            <div class="comment-box">
                <?php
                    $sql_comment = "SELECT * FROM comments ORDER BY created_at DESC";
                    $result_comment = $conn->query($sql_comment);
                    if($result_comment->num_rows > 0){
                        while($row_comment = $result_comment->fetch_assoc()){
                            $comment_id = $row_comment['id'];
                            $blog_id_of_cat = $row_comment['blog_id'];
                            $cname = $row_comment['cname'];
                            $comment_l = $row_comment['comment'];
                ?>
                <div class="comment-box-each">
                    <b>Blog Id:</b> <?php echo $blog_id_of_cat; ?>
                    <br>
                    <b>Name:</b> <?php echo $cname; ?>
                    <br>
                    <b>Comment:</b> <?php echo $comment_l; ?>
                    <br>
                    <div class="actionBtn">
                    <form method="post" action="admin.php" onsubmit="return confirmDelete()">
                        <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
                        <input id="dangerBtn" class="dangerBtn" type="submit" name="delete" value="Delete">
                    </form>
                </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <!-- All Comments ends -->

    <!-- All category starts -->
    <div class="category-container">

    </div>
    <!-- All category ends -->

    <!-- All sms starts -->
    <div class="sms-container">
        <div class="sms">
            <div class="sms-title">
                <h2>Sent Messages</h2>
            </div>
            <div class="display-sms-box">
                <?php
                $sql_sms= "SELECT * FROM messages ORDER BY submission_datetime DESC";
                $sql_result = $conn->query($sql_sms);
                if($sql_result->num_rows > 0){
                    while($row_sms = $sql_result->fetch_assoc()){
                        $fName = $row_sms['first_name'];
                        $lName = $row_sms['last_name'];
                        $email = $row_sms['email'];
                        $subject = $row_sms['subject'];
                        $message = $row_sms['message'];

                ?>
                <div class="display-sms-box-each" style="border: 1px solid black; margin-bottom: 10px; padding: 10px;">
                    <b>fName:</b> <?php echo $fName; ?>
                    <br>
                    <b>lName:</b> <?php echo $lName; ?>
                    <br>
                    <b>Email:</b> <?php echo $email; ?>
                    <br>
                    <b>Subject:</b> <?php echo $subject; ?>
                    <br>
                    <b>Message:</b> <?php echo $message; ?>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <!-- All sms ends -->


    <!-- copyright starts -->
    <?php include '../constituents/copyright.php'; ?>
    <!-- copyright ends -->
    </div>
</div>
    <div class="logout">
        <form action="admin.php" method="POST"><button type="submit" name="logout"
                style="width: 100%; background-color: red; cursor: pointer; color: white; height: 30px; font-size: 15px; padding: 4px;">Logout</button>
        </form>
    </div>
    <button onclick="goToTop()" id="topBtn">Go to Top</button>
    <script src="../js/script.js"></script>
</body>
<style>
    img {
        width: 300px;
    }
    @media screen and (max-width: 710px) {
        img{
            width: 150px;
        }
        .create-blog,
        .create-category{
            width: 500px;
        }
    }
    @media screen and (max-width: 400px) {
        img{
            width: 100px;
        }
        .create-blog,
        .create-category{
            width: 330px;
        }
    }
</style>
<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
<?php

?>
</html>