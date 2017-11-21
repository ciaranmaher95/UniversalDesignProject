<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include ("header.php");
?>



<div class="content">
    <div class="wrap">
        <div id="main" role="main">
            <ul id="tiles">

                <?php
                foreach ($blogs as $blog) :
                ?>

                    <li onclick="location.href = '../controller/?action=show_single_page&amp;blogID=<?php echo $blog['blogID']; ?>'">
                        <img src="<?php echo $blog['imagePath'] ?>" width="282" height="344">
                        <div class="post-info">
                            <div class="post-basic-info">
                                <h3><a href="#"></a><?php echo $blog['title'] ?></h3>
                                <span><a href="#"><label> </label><?php echo $blog['tags'] ?></a></span>
                                <p><?php echo substr($blog['description'], 0, 100) ?></p>
                            </div>
                            <div class="post-info-rate-share">
                                <div class="rateit">
                                    <span> </span>
                                </div>
                                <div class="post-share">
                                    <span> </span>
                                </div>
                                <div class="clear"> </div>
                            </div>
                        </div>
                    </li>
                    <?php
                endforeach;
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
</body>
</html>
