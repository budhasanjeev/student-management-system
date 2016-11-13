/**
 * Created by anijor on 9/16/2016.
 */




function checkAlphabet(id) {

    var input = $('#' + id).val();

    var alphaExp = /^[a-zA-Z]+$/;

    if (input.match(alphaExp)) {
        return true;

    }
    else {
        // alert("Invalid");
        return false;
    }
}

function checkNumeric(id)
{
    var input=$('#' + id).val();
    var numericExpression = /^[0-9]+$/;
    if (input.match(numericExpression)) {
        return true;

    }
    else {
        // alert("Invalid");
        return false;
    }
}


