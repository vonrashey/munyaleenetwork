$("#bookingForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Please fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var fname = $("#fname").val();
	var lname = $("#lname").val();
    var date = $("#date").val();
	var email = $("#email").val();
	var service_requested = $("#service_requested").val();
    var number_travellers = $("#number_travellers").val();
	var country = $("#country").val();
	var message = $("#message").val();

    $.ajax({
        type: "POST",
        url: "contactform/booking-process.php",
        data: "fname=" + fname + "&lname=" + lname  + "&date=" + date 
		+ "&email=" + email + "&service_requested=" + service_requested 
		+ "&number_travellers=" + number_travellers + "&country=" + country + "&message=" + message,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#bookingForm")[0].reset();
    submitMSG(true, "Request Submitted!")
}

function formError(){
    $("#bookingForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h4 text-center tada animated text-success";
    } else {
        var msgClasses = "h4 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}