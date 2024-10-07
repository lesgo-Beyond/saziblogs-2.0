<?php
require 'constituents/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'constituents/favicon.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resstyle.css">
    <title>sazi blogs</title>
</head>
<body>
    <div class="container">

        <!-- navbar starts  -->
        <?php include 'constituents/navbar.php' ?>
        <!-- navbar ends -->


        <!-- blog starts  -->
        <div class="blog-container">
            <div class="blog">
                <div class="filter-box">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="filter-text">
                    <select name="category">
                        <option value="" disabled selected>Select a category</option>
                        <option value="all">Show all category</option>
                        <?php
                        // Query to select categories and ids ordered by created_at in descending order
                        $sql_in_category_one = "SELECT id, category FROM category ORDER BY created_at DESC";
                        $result_category = $conn->query($sql_in_category_one);
                        
                        // Check if there are results
                        if ($result_category->num_rows > 0) {
                            // Output data of each row
                            while ($row_category = $result_category->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row_category['id']) . "'>" . htmlspecialchars($row_category['category']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <button name="filter" type="submit">Filter</submit>
                    </div>
                    </form>
                    <div class="search-box">
                            <input onkeyup="filter()" id="search" class="search-box-text" type="text" placeholder="Search by blog titles...🔍">
                            <!-- <button style="display:inline-block;" onclick="filter()" class="search-box-submit">Go</button> -->
                    </div>
                    <style>
                        .search-box{
                            display: flex;
                            justify-content: space-between;
                        }
                    </style>
                </div>
                <div class="blog-box">
                        <?php
                            if(isset($_POST['filter']) && isset($_POST['category']) && $_POST['category'] != "all"){
                                $cat_id = $_POST['category'];
                            
                                $sql_blog_title_filtered = "SELECT id, title FROM blogs WHERE category = '$cat_id' ORDER BY created_at DESC";
                                $sql_blog_title = $sql_blog_title_filtered;
                            }
                            if(!empty($_POST['category'])){
                                if($_POST['category'] == "all"){
                                    $sql_blog_title = "SELECT id, title FROM blogs ORDER BY created_at DESC";
                                }
                            }
                            else{
                                $sql_blog_title = "SELECT id, title FROM blogs ORDER BY created_at DESC";
                            }
                            $blog_title = $conn->query($sql_blog_title);
                            if($blog_title->num_rows > 0){
                                while ($row_blog_title = $blog_title->fetch_assoc()) {
                                    echo "<a class='blog-box-each' href='display-blog.php?id=" . $row_blog_title['id'] . "'><span>".htmlspecialchars($row_blog_title['title'])."</span></a>";
                                }
                            }
                        ?>
                <b id="noContentsFound"></b>
                </div>
            </div>
        </div>
        <!-- blog ends  -->


        <!-- copyright starts -->
        <?php include 'constituents/copyright.php' ?>
        <!-- copyright ends  -->
    </div>
    <button onclick="goToTop()" id="topBtn">Go to Top</button>
    <script src="js/script.js"></script>
</body>
</html>
<script>
    function filter(){
        // declare variables 
        var search, filter, li, a, txtValue;

        search = document.getElementById('search');
        filter = search.value.toUpperCase();
        li = document.getElementsByClassName('blog-box-each');

        found = false;

        // loop to filter 
        for(i=0; i < li.length; i++){
            a = li[i].getElementsByTagName('span')[0];
            txtValue = a.textContent || a.innerText;
            if(txtValue.toUpperCase().indexOf(filter) > -1){
                li[i].style.display = "";
                found = true;
            }else{
                li[i].style.display = "none";
            }
        }

        if (found) {
            document.getElementById('noContentsFound').innerText = "";
        }else{
            document.getElementById('noContentsFound').innerText = "No Contents Found";
        }
    }
</script>

