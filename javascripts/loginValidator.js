$("#loginButton").click(function() {
    var errorMessage = "";
            
    if($("#email").val() == "") {
        errorMessage += "Your Email ID is missing.<br>";
    }
            
    if($("#pword").val() == "") {
        errorMessage += "Your Password is missing.<br>";
    }
            
    if(errorMessage != "") {
        $("#errorBox").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>' + errorMessage + '</div>');
                
        return false;
    } else {
                
        return true;
    }
});