$(document).ready(function () {
    console.log('here')
    $('#registerUserForm').validate({ // initialize the plugin
        rules: {
            name:{
                required: true,
            },
            email:{
                required:true,
                email: true,
              
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password:{
                required:true
            },
            phone:{
                required:true
            },
            age:{
                required:true
            },
            about:{
                required:true,
                maxlength:300
            }
        },
        messages:{
            email:{
                required: "Please enter your email address.",
                email: "Please enter a valid email address.",
                remote: "Email address already in use!"
            }
        },
        submitHandler: function(form) {
            form.submit();
         }
    
    });
   
  
});


var uploadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var file = document.getElementById('profile-img-tag');
      file.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


  function myFunction() {
    if(!confirm("Are You Sure to delete this"))
    event.preventDefault();
}

