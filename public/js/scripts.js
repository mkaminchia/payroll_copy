$(function(){
    var $loginForm = $("#loginForm");

    $.validator.addMethod("checkSpaces", function(value, element){
        return value == '' || value.trim().length != 0
    }, "Only a space character is not allowed in this field");

    if($loginForm.length){
        $loginForm.validate({
            rules:{
                email:{
                    required: true,
                    email: true,
                    maxlength: 60
                },
                password:{
                    required: true,
                    checkSpaces: true,
                    minlength: 8
                }
            },
            messages:{
                email:{
                    required: "This field is required",
                    email: "Please enter a valid e-mail address",
                    maxlength: "The maximum length of this field is 60 characters"
                },
                password:{
                    required: "This field is required",
                    minlength: "Your password must be at least 8 characters"
                }
            },
        })
    }
})

$(function(){
    var $registrationForm = $("#registrationForm");

    $.validator.addMethod("checkSpaces", function(value, element){
        return value == '' || value.trim().length != 0
    }, "Only a space character is not allowed in this field");

    if($registrationForm.length){
        $registrationForm.validate({
            rules:{
                email:{
                    required: true,
                    email: true,
                    maxlength: 60
                },
                fname:{
                    required: true,
                    checkSpaces: true,
                    maxlength: 25
                },
                lname:{
                    required: true,
                    checkSpaces: true,
                    maxlength: 25
                },
                password:{
                    required: true,
                    checkSpaces: true,
                    minlength: 8
                },
                confpassword:{
                    required: true,
                    equalTo: "#password"
                }
            },
            messages:{
                email:{
                    required: "This field is required",
                    email: "Please enter a valid e-mail address",
                    maxlength: "The maximum length of this field is 60 characters"
                },
                fname:{
                    required: "This field is required",
                    maxlength: "The maximum length of this field is 25 characters"
                },
                lname:{
                    required: "This field is required",
                    maxlength: "The maximum length of this field is 25 characters"
                },
                password:{
                    required: "This field is required",
                    minlength: "Your password must be at least 8 characters"
                },
                confpassword:{
                    required: "This field is required",
                    equalTo: "The second password should be identical to the first"
                },
            },
        })
    }
})