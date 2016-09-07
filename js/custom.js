/**
 * Created by sanjeevbudha on 6/18/16.
 */

function displayMessage(message,messageType){
    noty({
        layout: 'topRight',
        text: message,
        type: messageType,
        timeout: 3000
    });
}

function customReloadWindow(delayTime){
    setTimeout(
        function()
        {
            window.location.reload()

        }, delayTime);
}

function displayLoginMessage(message,messageType){
    noty({
        layout:'topCenter',
        text:message,
        type:messageType,
        timeout:3000
    })
}