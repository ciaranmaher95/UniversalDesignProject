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

$getComments =  pg_query($db_connection, "select c.comment, m.username, m.usertype from comment c, member m where m.member_id = c.member_id and c.photo_id = '$photoid[0]';");
$comments = pg_fetch_all($getComments); 

$getFeedback =  pg_query($db_connection, "select f.feedback, m.username, m.usertype from feedback f, member m where m.member_id = f.member_id and f.photo_id = '$photoid[0]';");
$feedback = pg_fetch_all($getFeedback); 

include 'header.php';

?>
<html>
<head>
<title></title>

       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!----webfonts---->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!----//webfonts---->
        <!-- Global CSS for the page and tiles -->
        <!-- //Global CSS for the page and tiles -->
        <!---start-click-drop-down-menu----->
       <!----start-dropdown--->
        <link href="../css/style.css" rel='stylesheet' type='text/css' />
		
</head>
<body>

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
            <div class="artical-commentbox">
                <div class="grids_of_2">
                    <h2>Comments</h2>
                   
                    <?php if (is_array($comments) || is_object($comments)) 
							{

					foreach($comments as $comment): ?>
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
                            <p class="para top"><?php echo $comment["comment"]?></p>
                        </div>
                        <div class="clear"></div>
                    </div>
					<?php endforeach;
					} ?>
                    
                    </div>								
                   	
                </div>
				<div class="artical-feedbackbox">
                <div class="grids_of_2">
                    <h2>Feedback</h2>
                   <div class="grid_img">
                            
                            <a href=""><img src="../images/user.png" class="icon_pic" alt=""></a>
                       
                        </div>
                    <?php for($i = 0; $i < count($feedback); $i++){?>
                    <div class="grid1_of_2">
                        <div class="grid_img">
                            
                        </div>
                        
                        <div class="grid_text">
							<?php if($feedback[$i]["usertype"] == 't') { ?>
                           <h4 class="style1 list"><a href="#"><?php echo $feedback[$i]["username"] ?><span id=tick>&#10004;</span></a></h4>
							<?php } else { ?>
							<h4 class="style1 list"><a href="#"><?php echo $feedback[$i]["username"] ?></a></h4>
							<?php } ?>
                            <p class="para top"><?php echo $feedback[$i]["feedback"]?></p>

                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    
                    </div>								
                   	
                </div>
				<div class="clear"> </div>
            </div>
            <!---//End-comments-section--->
			
        </div>
    </div>


<!---//End-wrap---->
</body>
</html>


