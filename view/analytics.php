
<?php

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$loggedin = explode('loggedin=',$_SERVER['REQUEST_URI']);

$getLoggedin = pg_query($db_connection, "select * from member where member_id = $loggedin[1];");

$loggedinUser = pg_fetch_all($getLoggedin); 

include "header.php";


?>

<br>
<br>
<br>
<br>
<br>



<div class="single-page-artical">

    <div id="imageContainer" class="artical-content">
        <h1>Likes per photo</h1>
<img class="graphImage" src="../controller/example_graph3.php"/>
     
        <div id="graphComment">
            <h1>Most of your comments are from inexperienced users</h1>
        </div>
    </div>
</div>

<br>
<br>
<br>

<div class="single-page-artical">
    <div id="imageContainer" class="artical-content">
        <h1>Percentage of comments that are from professionals</h1>
        <img class="graphImage" src="../images/pie_chart.jpg" alt="pie chart"/>  
        <div id="graphComment">
            <h1>Only 38% of your feedback is potentially constructive</h1>
        </div>
    </div>
</div>

<br>
<br>
<br>

<div class="single-page-artical">

    <div id="imageContainer" class="artical-content">
        <h1>Key words per photo</h1>
        <img id="graphImage" src="../images/key_words.jpg"/>    
        <div id="graphComment">
            <h1>Well done! You're receiving more positive feedback!</h1>
        </div>
    </div>
</div>

<br>
<br>
<br>

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
        // Call the layout function for the first time
        applyLayout();


    })(jQuery);
</script>
<!----//wookmark-scripts---->
<!----start-footer--->
<div class="footer">

</div>
<!----//End-footer--->
<!---//End-wrap---->
