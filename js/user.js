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
                    url:'../controller/userController.php',
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
        url:'../controller/userController.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){
            
            var data = JSON.parse(data);

            var u_id = data['id'];
            $("#firstName").val(data['first_name']);
            $('#lastName').val(data['last_name']);
            $('#username').val(data['username']);
            $('#email').val(data['email']);
            $('#role').val(data['role']);
            $('#student_id').val(data['student_id']);
            $('#photo').attr('value',data['photo']);


            $('#addUser').modal('show');
            $('#addUser .modal-title').html("EDIT USER");
            $('#addUser button[type=submit]').html("save changes");
            $('#user-form').attr('action','../controller/userController.php');
            $('#modes').attr('value','update');
            $('#user_id').attr('value',u_id);

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
        url:'../controller/userController.php',
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

    var data = $('#user-form').serialize();

    alert(data);
    
}