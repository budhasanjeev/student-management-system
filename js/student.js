/**
 * Created by Arun Tamang on 8/23/2016.
 */

function deleteStudent(id){

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
                    url:'../controller/studentController.php',
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

function editStudent(id) {

    var mode ='edit';

    $.ajax({
        type:"POST",
        url:'../controller/studentController.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){

            var data = JSON.parse(data);
            
            var s_id = data['id'];

            window.localStorage.setItem('first_name',data['first_name']);
            $('#lastName').val(data['last_name']);
            // $('#username').val(data['username']);
            // $('#email').val(data['email']);
            // $('#role').val(data['role']);
            // $('#student_id').val(data['student_id']);
            // $('#photo').attr('value',data['photo']);


            $('legend').html("EDIT STUDENT");
            // $('#addUser button[type=submit]').html("save changes");
            // $('#user-form').attr('action','../controller/userController.php');
            // $('#modes').attr('value','update');
            $('#student_id').attr('value',s_id);
            //
            // $('.modal').on('hidden.bs.modal', function(){
            //     $(this).find('form')[0].reset();
            // });
            document.location.href = '../views/studentForm.php';

        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });

    return false;
}
