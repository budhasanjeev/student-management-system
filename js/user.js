/**
 * Created by Arun Tamang on 8/23/2016.
 */

function deleteUser(id){

    var mode ='delete';

    var n = noty({
        layout: 'center',
        text: "Are you sure you want delete? ",
        killer: true,
        buttons: [
            {
                addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
                n.close();
                $.ajax({
                    type:"POST",
                    url:'../controller/userHandler.php',
                    data:"mode="+mode+"&id="+id,
                    success:function(data){
                        var data = JSON.parse(data);

                        if(data.message=='success'){
                            displayMessage("Successfully Deleted","success");
                            customReloadWindow(2000)
                        }
                    },error: function (er) {
                        console.log(er);
                    }
                });
                return false;
            }
            },
            {
                addClass: 'btn btn-danger', text: 'Cancel', onClick: function ($noty) {
                n.close();
            }
            }
        ]
    })

}

function editUser(id) {

    var mode ='edit';

    $.ajax({
        type:"POST",
        url:'../controller/userHandler.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){
            var data = JSON.parse(data);

            var s_id = data['id'];
            $("#image").attr('value',data['image']);
            $("#first_name").val(data['first_name']);
            $('#last_name').val(data['last_name']);
            $('#mobile_number').val(data['mobile_number']);
            $('#email_address').val(data['email_address']);
            $('#city').val(data['city']);
            $('#zone').val(data['zone']);
            $('#district').val(data['district']);
            $('#role').val(data['role']);


            $('#insert-user').modal('show');
            $('#insert-user .modal-title').html("प्रयोगकर्ता परिमार्जन गर्नुहोस्");
            $('#insert-user button[type=submit]').html("पेश गर्नुहोस्");
            $('#user-form').attr('action','../controller/userHandler.php');
            $('#modes').attr('value','update');
            $('#user_id').attr('value',s_id);

            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
            });

        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });

    return false;
}

function resetPassword(id) {

    var mode = 'resetPassword'

    $.ajax({
        type:"POST",
        url:'../controller/userHandler.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){

           var data = JSON.parse(data);

            if(data.message=='success'){
                displayMessage("Password successfully reset","success");
                customReloadWindow(2000)
            }

        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });

    return false;
}

function createUser() {
    var formData = new FormData($(this)[0]);

    alert(formData);
    
}