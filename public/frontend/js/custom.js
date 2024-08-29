$(document).ready(function(){
    // move alert
    var $myDiv = $(".alert");
    if($myDiv.is("html *")){
        setTimeout(function(){
            $myDiv.hide('slow', function(){ $myDiv.remove(); });
        }, 5000);
    }

});

function showFrontendAlert(type, message) {
    Swal.fire({
        position: 'bottom-end',
        type: type,
        title: message,
        showConfirmButton: false,
        timer: 2000
    });
}

function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
        console.log(e)
    }
}
function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function inputPhoneTyping() {
    let phoneTxt = $(`input[name="phone_number"]`).val();
    let first_character = parseInt(phoneTxt.charAt(0));
    let flag = 1;
    if (first_character != 0) {
        flag = 0;
    } else {
        flag = 1;
    }

    if (phoneTxt) {
        if (!is_phonenumber(phoneTxt) || phoneTxt == '0123456789') {
            $('#btn_register').prop('disabled', true);
            $(`input[name="phone_number"]`).css('border', '1px solid #ea553d');
        } else {
            if (flag == 1) {
                $('#btn_register').prop('disabled', false);
                $(`input[name="phone_number"]`).css('border', 'none');
            }
        }
    } else {
        $('#btn_register').prop('disabled', false);
        $(`input[name="phone_number"]`).css('border', 'none');
    }
}

// check phone
function is_phonenumber(phonenumber) {
    var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
    if (phonenumber.match(phoneno)) {
        return true;
    } else {
        return false;
    }
}
