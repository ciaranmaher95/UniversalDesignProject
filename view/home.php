
<?php

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$loggedin = explode('=',$_SERVER['REQUEST_URI']);

$getLoggedin = pg_query($db_connection, "select * from member where member_id = $loggedin[1];");

$loggedinUser = pg_fetch_all($getLoggedin); 

$getPosts = pg_query($db_connection, "select * from photo;");

$results = pg_fetch_all($getPosts); 

include "header.php";
?>


<div class="content">
    <div class="wrap">
        <div id="main" role="main">
            <ul id="tiles">
           <?php
		   
		   if (is_array($results) || is_object($results)){
                foreach ($results as $result) :
                ?>
					<li>
                    <a href="../controller/check.php?loggedin=<?php echo $loggedinUser[0]['member_id']?>&photoid=<?php echo $result['photo_id']?>&memberid=<?php echo $result['member_id']?>"><?php echo '<img id="userimages" src="data:image/jpeg;base64,'.pg_unescape_bytea($result["imagepath"]).' " width="300" height="300"/>'?></a>
                        <div class="post-info">
                            <div class="post-basic-info">
                                <h3><a href="#"></a><?php echo $result['title'] ?></h3>
                                <span><a href="#"><?php echo $result['tags'] ?></a></span>
                                <p><?php echo substr($result['description'], 0, 100) ?></p>
								
								<?php $userid =  $result['member_id'];
									$getname =  pg_query($db_connection, "select username, usertype from member where member_id='$userid';");
									$username = pg_fetch_all($getname); ?>
							<?php if($username[0]["usertype"]  == "t") { ?>
								<span><a href="profilepage.php?loggedin=<?php echo $loggedinUser[0]['member_id']?>&memberid=<?php echo $userid?>"><?php echo $username[0]['username']?><span id=tick>&#10004;</span></a></span>
                            <?php } 
							else { ?>
								<span><a href="profilepage.php?loggedin=<?php echo $loggedinUser[0]['member_id']?>&memberid=<?php echo $userid?>"><?php echo $username[0]['username']?></a></span>	
							<?php } ?>
								
							</div>
                            
                        </div>
                    </li>
              <?php
                endforeach;
		   }
              ?>
                <!-- End of grid blocks -->
            </ul>
        </div>
    </div>
</div>
<!---//End-content---->
<!----wookmark-scripts---->
<script src="../js/jquery.imagesloaded.js"></script>
<script src="../js/jquery.wookmark.js"></script>
<script type="text/javascript">
                        (function ($) {
                            var $tiles = $('#tiles'),
                                    $handler = $('li', $tiles),
                                    $main = $('#main'),
                                    $window = $(window),
                                    $document = $(document),
                                    options = {
                                        autoResize: true, // This will auto-update the layout when the browser window is resized.
                                        container: $main, // Optional, used for some extra CSS styling
                                        offset: 20, // Optional, the distance between grid items
                                        itemWidth: 280 // Optional, the width of a grid item
                                    };
                            /**
                             * Reinitializes the wookmark handler after all images have loaded
                             */
                            function applyLayout() {
                                $tiles.imagesLoaded(function () {
                                    // Destroy the old handler
                                    if ($handler.wookmarkInstance) {
                                        $handler.wookmarkInstance.clear();
                                    }

                                    // Create a new layout handler.
                                    $handler = $('li', $tiles);
                                    $handler.wookmark(options);
                                });
                            }
                            /**
                             * When scrolled all the way to the bottom, add more tiles
                             */
                            function onScroll() {
                                // Check if we're within 100 pixels of the bottom edge of the broser window.
                                var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
                                        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

                                if (closeToBottom) {
                                    // Get the first then items from the grid, clone them, and add them to the bottom of the grid
                                    var $items = $('li', $tiles),
                                            $firstTen = $items.slice(0, 10);
                                    $tiles.append($firstTen.clone());

                                    applyLayout();
                                }
                            }
                            ;

                            // Call the layout function for the first time
                            applyLayout();

                            // Capture scroll event.
                            $window.bind('scroll.wookmark', onScroll);
                        })(jQuery);
</script>
<!----//wookmark-scripts---->
<!----start-footer--->
<div class="footer">

</div>
<!----//End-footer--->
<!---//End-wrap---->
