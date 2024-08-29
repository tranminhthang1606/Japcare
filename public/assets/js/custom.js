$(document).ready(function(){
    // move alert
    var $myDiv = $(".alert");
    if($myDiv.is("html *")){
        setTimeout(function(){
            $myDiv.hide('slow', function(){ $myDiv.remove(); });
        }, 5000);
    }

});

function showResultAlert(type, message) {
    Swal.fire({
        position: 'bottom-end',
        type: type,
        title: message,
        showConfirmButton: false,
        timer: 2000
    });
}
