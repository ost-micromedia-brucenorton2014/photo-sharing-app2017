$(function () {
	let i=0;
    //chmod on uploads/files/ folder to 777
    $('#fileupload').fileupload({
        dataType: 'json',
        limitMultiFileUploads: 3,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                displayImage(file.name);
                console.log("file.name: " + file.name);
                console.log("index: "+ index);
            });
        }
    });


    function displayImage(imgSrc){
    	i++;
    	console.log("displayImage: "+ imgSrc)
    	$("#uploads").append('<section class="col-sm-4">\
        <img src="uploads/files/'+imgSrc+'" class="img-fluid">\
        <figcaption>'+imgSrc+'</figcaption>\
        <input type="text" name="photoCaption'+i+'" placeholder="caption"></input>\
        <input type="text" name="photoSRC'+i+'" value="'+imgSrc+'"></input>\
        </section>');
    }

    $( document ).on( "submit", "#uploadForm", function( event ) {
      event.preventDefault();
      let formData = $('#uploadForm').serializeArray();
      //console.log(formData);
       $.post("gallery_insert.php", formData, function(insertData) {
        console.log("insertData " + insertData);
        if(insertData > 0){
            console.log("successfully inserted "+ insertData +" new images");
            $("#uploads").html("Thanks you have uploaded "+ insertData + " new images.");
            //i shouldn't be repeating this... but I'm lazy
            $.getJSON( "gallery_select_user.php", function(galleryData) {
              showGallery(galleryData);
            });
        }else{
            console.log("sorry, something went wrong");
        }
      });
    });


    //user login / register logic
    $( document ).on( "submit", "#userForm", function( event ) {
      event.preventDefault();
      let userFormData = $('#userForm').serializeArray();
      //console.log(userFormData);
       $.post("user_login.php", userFormData, function(userData) {
        //move this to "checkState() function??"
        if(userData){
            console.log("userData: " + userData);
            //should set all these variables up top??
            let userJSON = JSON.parse(userData);
            let emailResponse = userJSON[0][0];
            let passwordResponse = userJSON[0][1];
            if(emailResponse == "email not registered"){
                $('#nameGroup').html('<input name="userName" id="userName" placeholder="Name" class="form-control form-control-sm" type="text" required="" value="Bruce">');
                $('#passwordGroup').html('<input name="userPassword" id="userPassword" placeholder="Password" class="form-control form-control-sm" type="text" required="" value="ostmh">');
                $('#loginButton').text('Register');
            }else if(emailResponse == "email registered"){
              let nameResponse = userJSON[0][3];
              let userEmail = userJSON[0][4]; 
            }
            
            if(passwordResponse == "password not submitted"){
              $('#passwordGroup').html('<input name="userPassword" id="userPassword" placeholder="Password" class="form-control form-control-sm" type="text" required="" value="ostmh">');

            }else if(passwordResponse == "password matched"){
                let nameResponse = userJSON[0][3];
                console.log('userID: ' +userJSON[0][2]);
                //user is logged in
                $('#galleryUploader').css('display', 'block');
                $('#userID').val(userJSON[0][2]);
                $("#userForm").html('<li><a href="#" class="nav-link">Welcome ' + nameResponse + '</a></li>');
            }
            
            
        }else{
            console.log("sorry, user_login.php went wrong");
        }
      });
    });

    /*php version
    function showGallery(){
        $('#gallery').html("");
        $('#gallery').load("gallery_select.php", function(event){

        });
    }
    showGallery();
    */

    //JSON version
    //user "gallery_select.php" for just the photos table
    $.getJSON( "gallery_select_user.php", function(galleryData) {
      showGallery(galleryData);
    });

    function showGallery(galleryData){
        $('#gallery').html("");
      galleryData.forEach( function(image) { 
        
        $('#gallery').append('<figure class="col-sm-4"><a href="uploads/files/'+image[1]+
            '" data-lightbox="roadtrip" data-title="'+image[2]+'">\
            <img src="uploads/files/'+image[1]+'" class="img-fluid"></a>\
            <figcaption>'+image[2]+'<br>by '+image[3]+'</figcaption</figure>');
      });

    }

});