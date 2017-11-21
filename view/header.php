
<html>
    <head>
	<style>
	#tick
	{
		color: blue;
		
	}
	</style>
        <title></title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="../css/header.css" rel='stylesheet' type='text/css' />
		<link href="../css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="../images/fav-icon.png" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!----webfonts---->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!----//webfonts---->
        <!-- Global CSS for the page and tiles -->
        <link rel="stylesheet" href="../css/main.css">
        <!-- //Global CSS for the page and tiles -->
        <!---start-click-drop-down-menu----->
        <script src="../js/jquery.min.js"></script>
        <!----start-dropdown--->
        <script type="text/javascript">
            var $ = jQuery.noConflict();
            $(function () {
                $('#activator').click(function () {
                    $('#box').animate({'top': '0px'}, 500);
                });
                $('#boxclose').click(function () {
                    $('#box').animate({'top': '-700px'}, 500);
                });
            });
            $(document).ready(function () {
                //Hide (Collapse) the toggle containers on load
                $(".toggle_container").hide();
                //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
                $(".trigger").click(function () {
                    $(this).toggleClass("active").next().slideToggle("slow");
                    return false; //Prevent the browser jump to the link anchor
                });
            document.querySelector('.mini-photo-wrapper').addEventListener('click', function () 
            {
               document.querySelector('.menu-container').classList.toggle('active');
            });
            });
            
            
        </script>
    </head>
    <body>
        <!---start-wrap---->
        <!---start-header---->
        <div class="header">
            <div class="wrap">
                <div class="logo">                     
                    <a href="home.php?memberid=<?php echo $loggedinUser[0]["member_id"] ?>"><img src="../images/logo2.png" title="pinbal" /></a>
                </div>
                <div class="nav-icon">
                    
                </div>
                <div class="top-searchbar">
                    <form>
                        <input type="text" /><input type=hidden value="" />
                    </form>
                </div>
				<?php if($loggedinUser[0]["usertype"]  == "t") { ?>
                <div class="user-menu-wrap"><a class="mini-photo-wrapper" href="#"><img class="mini-photo" src="../images/user.png" width="40" height="40"/></a>
                    <h3><?php echo $loggedinUser[0]["username"] ?><span id=tick>&#10004;</span></h3>
				<?php }
				else { ?>
					<div class="user-menu-wrap"><a class="mini-photo-wrapper" href="#"><img class="mini-photo" src="../images/user.png" width="40" height="40"/></a>
                    <h3><?php echo $loggedinUser[0]["username"] ?></h3>
				<?php }?>

					<div class="menu-container">
                        <ul class="user-menu">
                            <li class="user-menu__item"><a class="user-menu-link" href="profilepage.php?loggedin=<?php echo $loggedinUser[0]["member_id"] ?>&memberid=<?php echo $loggedinUser[0]["member_id"] ?>">My Profile</a></li>
                            <li class="user-menu__item"><a class="user-menu-link" href="imageUploadForm.php?memberid=<?php echo $loggedinUser[0]["member_id"] ?>">New Image</a></li>
							<li class="user-menu__item"><a class="user-menu-link" href="analytics.php?loggedin=<?php echo $loggedinUser[0]["member_id"] ?>">Image Statistics</a></li>
							
							
                            <li class="user-menu__item"><a class="user-menu-link" href="signup_login.php">Log Out</a></li>
							
						</ul>
                    </div>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
