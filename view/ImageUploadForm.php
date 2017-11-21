<?php 
$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}



$loggedin = explode('=',$_SERVER['REQUEST_URI']);

$getLoggedin = pg_query($db_connection, "select * from member where member_id = $loggedin[1];");

$loggedinUser = pg_fetch_all($getLoggedin); 

include 'header.php'
?>
<html>
<body>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image').html('<img src="' + e.target.result + '"  />');
    };
    reader.readAsDataURL(input.files[0]);
	
  }
}


</script>
<link href="../css/ImageUploadForm.css" rel="stylesheet" type="text/css"/>
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<form method='POST' action='../controller/uploadPost.php?memberid=<?php echo $loggedin[1] ?>' enctype='multipart/form-data'>
    <div class="content">
        <div class="wrap">
            <div class="single-page">
                <div class="single-page-artical">
                    <div class="artical-content">
					<div id=formDiv>
						<input id="chooseFile" class="center" type="file"  name="image" onchange="readURL(this)";>
						<label for="chooseFile" class="Button">Choose Picture</label>
						<h3>Add Title</h3>
                            <div class="center" id="titlediv">
                                <input name="title" id=title type="text">
                            </div>
                            <br>
                            <h3>Add Description</h3>
                            <div class="center" id="textdiv">
                                <textarea name="desc" id="text" rows="4" cols="50"></textarea>
                            </div>
                            <br>

                            <h3>Add Tags</h3>
                            <div class="center" id="tagdiv">
                                <input name="tags" type="text">
                            </div>
                            <br>
							<h3>Location</h3>
                            <div class="center" id="tagdiv">
                                <input name="location" type="text">
                            </div>
                            <br>

                            <input type='submit' id="submit" value='Submit'>

                    </div>
					<div id=image></div>
					</div>
					
                </div>
            </div>
        </div>
		
    </div>
</form>



</body>
</html>
