<script>
	var url = window.location.href;
	
	if(url.includes("?"))
	{
		if(url.includes("?Username"))
		{
			var splitURL = url.split("?");
			var error = splitURL[1].replace(/%20/g," ");
			error = error.replace(/%27/g,"");
			alert(error);
		}
		else
		{
			var splitURL1 = url.split("?");
			var splitURL2 = splitURL1[1].split("_");
			var variable1 = splitURL2[0];
			var variable2 = splitURL2[1];
			var variable3 = splitURL2[2];
			alert("Already Taken:\n"+variable1+"\n"+variable2+"\n"+variable3);
		}
	}
	
</script>
<html>
<head>
<meta name='google-signin-client_id' content='526844871597-f3j9gbriaj9r905an99hfj4munt1lipk.apps.googleusercontent.com'>
<link rel="stylesheet" type="text/css" href="../css/registration.css">
<title></title>
</head>
<body>
<img id=image1 src='../images/photography1.jpg'></img>
<div id=formDiv>
<div id=sitename>
<h1>Cam Coach</h1>
</div>
<div id=signupdiv>
<form id=signupform method='POST' action='../controller/signup.php' enctype='multipart/form-data'>
<h2> Sign Up </h2>
<input name='name' type=text placeholder='Full Name' required>
<input name='username' type=text placeholder=Username required>
<input name='email' type=email placeholder='Email Address'>
<input name='password' type=password placeholder=Password required>
<div id="check">
<input type="radio" name="usertype" value="amatuer">
<input type="radio" name="usertype" value="professional">
</div>
<div id=labels>
<p id=am>Register as amatuer photographer</p>
<p id=prof>Register as professional photographer</p>
</div>
<button>Submit</button>
</form>
</div>
<div id=divider></div>
<div id=logindiv>
<form id=loginform method='POST' action='../controller/loginvalidation.php' enctype='multipart/form-data'>
<h2> Log In </h2>
<input name='username' type=text placeholder=Username required>
<input name='password' type=password placeholder=Password required>
<button>Submit</button>
</form>
<h3>____________________</h3>
<!--<h3>Continue With Google</h3>-->
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<a href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/ui/test.html">Sign out</a>
</div>
</div>
</body>
</html>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>

function onSignIn(googleUser) 
{
  var profile = googleUser.getBasicProfile();
  var google_id = profile.getId(); 
  var google_name = profile.getName();
  var google_profilepic = profile.getImageUrl();
  var google_email = profile.getEmail(); 
  
 
}
</script>