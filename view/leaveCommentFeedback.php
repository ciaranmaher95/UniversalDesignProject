<?php
$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$l = explode('&photoid=',$_SERVER['REQUEST_URI']);
$loggedin = explode('loggedin=',$l[0]);
$imageid = explode('photoid=',$_SERVER['REQUEST_URI']);
$photoid = explode('&memberid=',$imageid[1]);
$memberid = explode('memberid=',$_SERVER['REQUEST_URI']);

$getLoggedin = pg_query($db_connection, "select * from member where member_id = $loggedin[1];");

$loggedinUser = pg_fetch_all($getLoggedin); 

$getUser = pg_query($db_connection, "select * from member where member_id = $memberid[1];");

$user = pg_fetch_all($getUser); 

$getPhoto =  pg_query($db_connection, "select * from photo where photo_id='$photoid[0]';");

$photoDetails = pg_fetch_all($getPhoto); 

$getPhotoUser =  pg_query($db_connection, "select * from member where member_id = (select member_id from photo where photo_id='$photoid[0]');");

$photoUser = pg_fetch_all($getPhotoUser);

$getComments =  pg_query($db_connection, "select c.comment, m.username, m.usertype from comment c, member m where c.member_id = m.member_id and c.photo_id = '$photoid[0]';");
$comments = pg_fetch_all($getComments); 

include 'header.php';
?>
<head>
    <title>Pinball Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/fav-icon.png" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!----webfonts---->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!----//webfonts---->
    <!-- Global CSS for the page and tiles -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- //Global CSS for the page and tiles -->
    <!---start-click-drop-down-menu----->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/search.js"></script>
    <!----start-dropdown--->
    <script type="text/javascript"></script>
</head>

<!---start-content---->
<div class="content">
    <div class="wrap">
        <div class="single-page">
            <div class="single-page-artical">
                <div class="artical-content">

					<?php echo '<img id="userimages" src="data:image/jpeg;base64,'.pg_unescape_bytea($photoDetails[0]["imagepath"]).' " />'?>
                        
                        <h3><a href="#"><?php echo $photoDetails[0]["title"] ?></a></h3>
                        <br>
                        <span><?php echo $photoDetails[0]["tags"] ?></span>
                        <p><?php echo $photoDetails[0]["description"]?></p> 
                </div>


                <div class="artical-links">
                    <ul>
                        <li><i class="fa fa-user-circle-o" aria-hidden="true"></i>
						<span id="userName"> <?php echo $user[0]["username"] ?></span></a></li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i>
						<span id="time"><?php echo '10:00 21/11/2017' ?></span></a></li>
                    </ul>
                </div>
                <div class="share-artical">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="clear"> </div>
            </div>
            <!---start-comments-section--->
            <div class="comment-section">
                <div class="grids_of_2">
                    <h2>Comments</h2>
                    

                </div>								
                <div class="artical-commentbox">
                    <h2>Leave a Comment</h2>
                    <div class="table-form">
                        <form action="../controller/insertCommentFeedback.php?loggedin=<?php echo $loggedin[1] ?>&photoid=<?php echo $photoid[0] ?>&type=comment" method="post" name="post_comment">
                           <div>
                                <label>Your Comment<span>*</span></label>
                                <textarea name="comment"></textarea>	
                            </div>
                            <input type="submit" value="submit">
                        </form>

                    </div>
                </div>
				
                <div class="artical-feedbackbox">
					
                    <h2>Leave some feedback</h2>
                    <div class="table-feedback-form">
                        <form action="../controller/insertCommentFeedback.php?loggedin=<?php echo $loggedin[1] ?>&photoid=<?php echo $photoid[0] ?>&type=feedback" method="post" name="post_comment">
                            <input type="hidden" name="action" value="add_comment"> 
                            <input type="hidden" name="blogID" value="">
                            <div>
                                <label>Your feedback<span>*</span></label>
                                <textarea name="feedback"></textarea>	
                            </div>
                            <input type="submit" value="submit">
                        </form>

                    </div>
                </div>
                <div class="clear"> </div>
				<?php
				if(!empty($comments)) {
                    foreach ($comments as $comment):
                    ?>

                    <div class="grid1_of_2">
                        <div class="grid_img">
                            <a href=""><img src="../images/user.png" class="icon_pic" alt=""></a>
                        </div>

                        <div class="grid_text">
                            <?php if($comment["usertype"] == 't') { ?>
                           <h4 class="style1 list"><a href="#"><?php echo $comment["username"] ?><span id=tick>&#10004;</span></a></h4>
							<?php } else { ?>
							<h4 class="style1 list"><a href="#"><?php echo $comment["username"] ?></a></h4>
							<?php } ?>
                            <h3 class="style"></h3>
                            <p class="para top"><?php echo $comment["comment"]?></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                   endforeach;
				}
                    ?>
            </div>			
        </div>
    </div>
    <!---//End-comments-section--->
</div>
</div>
</div>

<!---//End-wrap---->
</body>
</html>


