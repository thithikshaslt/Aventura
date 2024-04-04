<?php
function displayPosts($sql, $conn, $num, $username=null)
{
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
?>
            <div id="main-window">
                <div class="post">
                    <div class="user">
                        <div class="user-stuff">
                            <div class="user-img">
                                <?php
                                if ($post['profile_img'] != NULL) {
                                    echo '<img style="width: 35px; height: 35px;" src="data:image/jpeg;base64,' . base64_encode($post['profile_img']) . '"/>';
                                } else {
                                ?>
                                    <img class="media-object" style="width: 35px; height: 35px;" alt="Portrait Placeholder" src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="user-info">
                                <div class="user-name">
                                    <a href="profile.php?username=<?php echo $post['username']; ?>">
                                        <?php echo $post['name']; ?>
                                    </a>
                                </div>
                                <span class="post-date"><?php echo $post['created_at']; ?></span>
                            </div>
                        </div>
                        <?php
                        if ($num === 1 and $username == $_SESSION['username']) {
                        ?>
                            <div class="actions">
                                <span class="share"></span>
                                <form method="post" action="delete-post.php" id="delete-post" name="delete-post">
                                    <?php
                                    global $post_id;
                                    $post_id = $post['post_id'];
                                    ?>
                                    <span>
                                        <a class="text-danger" href="delete-post.php?id=<?php echo $post['post_id']; ?>">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </span>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="content">
                        <?php
                        if ($post['content_img'] != NULL) {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($post['content_img']) . '"/>';
                        }
                        echo $post['content'];
                        ?>
                    </div>

                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <p class="text-center">No posts yet!</p>
    <?php
    }
    $conn->close();
    ?>
<?php
}
?>