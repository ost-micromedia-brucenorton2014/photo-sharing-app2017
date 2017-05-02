<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>gallery image upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link href="css/lightbox.min.css" rel="stylesheet">
	<link href="css/basic_uploader.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon navbar-toggler-right"></span>
  </button>
  <a class="navbar-brand" href="/home/nortonb/">nortonb/</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li><a class="nav-link" href="/home/nortonb/2016-17/webtech/">webtech 2</a></li>
       <form class="form" role="userForm" id="userForm">
          <div class="form-group">
              <input name="userEmail" id="userEmail" placeholder="Email" class="form-control form-control-sm" type="email" required="" value="nortonb@vanier.college">
          </div>
          <div class="form-group" id="passwordGroup"></div>
          <div class="form-group" id="nameGroup"></div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" id="loginButton">Login</button>
          </div>
      </form>

    </ul>
  </div>
</nav>
	<div class="container">
    <div id="galleryUploader">
  		<form id="uploadForm" class="ml-auto">
  			<h2>gallery uploader</h2>

  			<div class="row " id="uploads">
          <h3 id="message">drag & drop images here<br>or select the Choose Files button</h3>
        </div>

  			<input id="fileupload" type="file" name="files[]" data-url="uploads/" multiple>
        <input type="text" name="userID" id="userID" value="0">
  			<p><button type="submit" class="btn btn-secondary" >add to gallery</button></p>
  		</form>
      <hr>
    </div>
    <h2>photo sharing gallery</h2>
		<section id="gallery" class="row"></section>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="//maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>
	<!--add the following for blueimp file upload-->
	<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/js/jquery.iframe-transport.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/js/jquery.fileupload.min.js"></script>

	<!--add lightbox and our custome uploader-->
	<script src="js/lightbox.js"></script>
	<script src="js/uploader.js"></script>

</body> 
</html>