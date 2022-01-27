$("#signUpButton").click(function() {

        var errorMessage = "";

        if($("#fname").val() == "") {
            errorMessage += "Your First Name is missing.<br>";
        }
        if($("#lname").val() == "") {
            errorMesssage += "Your Last Name is missing.<br>";
        }
        if($("#email").val() == "") {
            errorMessage += "Your Email ID is missing.<br>";
        }
        if($("#pword").val() == "") {

            errorMessage += "Your Password is missing.<br>";

        } else if ($("#pword").val() != $("#rePword").val()) {

            errorMessage += "Your Password mis-matches.<br>";

        }


        if(errorMessage != "") {

            $("#errorBox").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>' + errorMessage + '</div>');

            return false;

        } else {

            return true;

        }


    });