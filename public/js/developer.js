
// for upload user profile general Data
// $('form[id="profile_general"]').validate({
//     // rules: {
//     //     name: 'required',
//     // },
//     // messages: {
//     //     name: 'This field is required',
//      // },
//      submitHandler: function(form) {
//         // form.submit(event);
//         //event.preventDefault();
//         form_data = $("#profile_general").serialize();
//         profile_general_url = $("#profile_general_url").val();
//         $.ajax({
//             type: "POST",
//             data: form_data,
//             url: profile_general_url,
//             success: function(data) {
//                 //console.log(data);
//                 if (data == "success") {
//                     toastr.success('Profile Updated', 'Successful', {
//                         timeOut: 5000
//                     })
//                 } else {
//                     toastr.error('You Got Error', 'Inconceivable!', {
//                         timeOut: 5000
//                     })
//                 }
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {}
//         });
//     }
// });


// // for upload user profile general Data
// $(document).ready(function() { 
//     $("#profile_password").submit(function(event) { 
//         event.preventDefault();

//         if($("#password").val().length === 0){
//            alert("please fill up password and confirm password");
//        }
//        else{
//          if($('#password').val() != $('#confirm_password').val()){
//             $('.invalid-tooltip').show();
//             $("#password").val('');
//             $("#confirm_password").val('');
//             $("#password").focus();
//         }
//         else{
//             $('.invalid-tooltip').hide();
//             form_data = $("#profile_password").serialize();
//             profile_password_url = $("#profile_password_url").val();
//         //url = $("#url").val();
//         $.ajax({
//             type: "POST",
//             data: form_data,
//             url: profile_password_url,
//             success: function(data) {
//                 //console.log(data);
//                 if (data == "success") {
//                     toastr.success('Profile Updated', 'Successful', {
//                         timeOut: 5000
//                     })
//                 } else {
//                     toastr.error('You Got Error', 'Inconceivable!', {
//                         timeOut: 5000
//                     })
//                 }
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {}
//         });
//     }
// }

// }); 
// }); 

// // for upload user profile info Data
// $('form[id="profile_info"]').validate({

//  submitHandler: function(form) {
//         // form.submit(event);
//         //event.preventDefault();
//         form_data = $("#profile_info").serialize();
//         profile_info_url = $("#profile_info_url").val();
//         $.ajax({
//             type: "POST",
//             data: form_data,
//             url: profile_info_url,
//             success: function(data) {
//                 //console.log(data);
//                 if (data == "success") {
//                     toastr.success('Profile Updated', 'Successful', {
//                         timeOut: 5000
//                     })
//                 } else {
//                     toastr.error('You Got Error', 'Inconceivable!', {
//                         timeOut: 5000
//                     })
//                 }
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {}
//         });
//     }
// });


// // for upload user profile links Data
// $('form[id="profile_links"]').validate({

//  submitHandler: function(form) {
//         // form.submit(event);
//         //event.preventDefault();
//         form_data = $("#profile_links").serialize();
//         profile_links_url = $("#profile_links_url").val();
//         $.ajax({
//             type: "POST",
//             data: form_data,
//             url: profile_links_url,
//             success: function(data) {
//                 //console.log(data);
//                 if (data == "success") {
//                     toastr.success('Profile Updated', 'Successful', {
//                         timeOut: 5000
//                     })
//                 } else {
//                     toastr.error('You Got Error', 'Inconceivable!', {
//                         timeOut: 5000
//                     })
//                 }
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {}
//         });
//     }
// });

// // for hide the success message in user profile update
// $(".list-group-item-action").click(function(){
//     $(".alert-success").hide();
// });

// // for user profile image preview
// function displayImage(e) {
//     if (e.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e){
//             document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
//         }
//         reader.readAsDataURL(e.files[0]);
//     }
// }


// check email exist 
$("#emailexist").blur(function(){
    //e.preventDefault();
    var email = $('#emailexist').val();
    var url = $('#emailCheck_url').val();
    var tt = $('#url').val()+"/"+url;
    $.ajax({
        type : "post",
        url : $('#url').val()+"/"+url,
        data:{'email':email, "_token": $('#token').val()}, //values to be passed similarly
        //cache : false,
        success : function(data)
        {
            console.log(data);
            if(data == 'Y'){
                $('.error_message').show();
                $("#emailexist").focus();
            }
            else{
                $('.error_message').hide();
            }
            
        }});
});

// for user search from datatable

$("#search-users").submit(function(e){
    e.preventDefault();
    $('.loader_class').show();
    form_data = $("#search-users").serialize();
    $.ajax({
        type: "POST",
        data: form_data,
        url: "search-users",
        success: function(data) {
            $('.loader_class').hide();
            $("#allUserstbody").empty();
            $("#allUserstbody").html(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });

});

$(document).ready(function() {
    $('body').on("click", ".modalLink", function(e) {
        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        var title = $(this).attr('title');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        //var title = "Are you sure you want to delete?";
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        //var delete_url =  $("#delete_url").val();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function(data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
                //$("a#delete_confirm").attr("href", delete_url);
            }
        });
    });
});

$(document).ready(function() {
    $('body').on("click", ".change_at_once", function(e) {
        $(".display_own").hide();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var total_issue  = $('[name="issue_id[]"]:checked').length;
        if(total_issue >0){
            var arr = [];
            $(".checkbox:checked").each(function () {
                arr.push($(this).val());
            });

            //document.getElementById("demo").innerHTML = arr;
            //e.preventDefault();
            //var track = $("#tracker").val();
            var project_id = $("#project_id").val();
            if(project_id === ""){
                alert("please select project first");
                return false;
            }
            else{
            arr.push(project_id);
            e.preventDefault();
            $('.modal-backdrop').show();
            $("#showDetaildModal").show();
            $("div.modal-dialog").removeClass('modal-md');
            $("div.modal-dialog").removeClass('modal-lg');
            $("div.modal-dialog").removeClass('modal-bg');
            var modal_size = $(this).attr('data-modal-size');
            if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
                $("#modalSize").addClass(modal_size);
            } else {
                $("#modalSize").addClass('modal-md');
            }
            var data_title = $(this).attr('data-original-title');
            $("#showDetaildModalTile").text(data_title);
            $("#showDetaildModal").modal('show');
            $('div.ajaxLoader').show();
            //var delete_url =  $("#delete_url").val();
            $.ajax({
                type: "POST",
                data: JSON.stringify(arr), 
                url: $(this).attr('href'),
                success: function(data) {
                    console.log(data);
                    //alert(data);

                    $("#showDetaildModalBody").html(data);
                    $("#showDetaildModal").modal('show');
                    //$("a#delete_confirm").attr("href", delete_url);
                }
            });
            }
            
        }
        else{
            alert("Please Select issue First");
            return false;
        }
        
    });
});

$(document).ready(function() {
    $('body').on("click", ".change_at_once_my_issues", function(e) {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var total_issue  = $('[name="issue_id[]"]:checked').length;
        if(total_issue >0){
            var arr = [];
            $(".checkbox:checked").each(function () {
                arr.push($(this).val());
            });

            //document.getElementById("demo").innerHTML = arr;
            //e.preventDefault();
            //var track = $("#tracker").val();
            var project_id = $("#project_id").val();
            if(project_id === ""){
                alert("please select project first");
                return false;
            }
            else{
            arr.push(project_id);
            e.preventDefault();
            $('.modal-backdrop').show();
            $("#showDetaildModal").show();
            $("div.modal-dialog").removeClass('modal-md');
            $("div.modal-dialog").removeClass('modal-lg');
            $("div.modal-dialog").removeClass('modal-bg');
            var modal_size = $(this).attr('data-modal-size');
            if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
                $("#modalSize").addClass(modal_size);
            } else {
                $("#modalSize").addClass('modal-md');
            }
            var data_title = $(this).attr('data-original-title');
            $("#showDetaildModalTile").text(data_title);
            $("#showDetaildModal").modal('show');
            $('div.ajaxLoader').show();
            //var delete_url =  $("#delete_url").val();
            $.ajax({
                type: "POST",
                data: JSON.stringify(arr), 
                url: $(this).attr('href'),
                success: function(data) {
                    console.log(data);
                    //alert(data);

                    $("#showDetaildModalBody").html(data);
                    $("#showDetaildModal").modal('show');
                    //$("a#delete_confirm").attr("href", delete_url);
                }
            });
            }
            
        }
        else{
            alert("Please Select issue First");
            return false;
        }
        
    });
});


$(document).ready(function() {
    $('body').on("click", ".change_at_once_mng_pro", function(e) {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var project_id = $(this).attr('project_id');
        var total_issue = $('input:checkbox.checkbox_'+project_id+':checked').length;
        if(total_issue >0){
            var arr = [];
            $(".checkbox:checked").each(function () {
                arr.push($(this).val());
            });

            //document.getElementById("demo").innerHTML = arr;
            //e.preventDefault();
            arr.push(project_id);

            e.preventDefault();
            $('.modal-backdrop').show();
            $("#showDetaildModal").show();
            $("div.modal-dialog").removeClass('modal-md');
            $("div.modal-dialog").removeClass('modal-lg');
            $("div.modal-dialog").removeClass('modal-bg');
            var modal_size = $(this).attr('data-modal-size');
            if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
                $("#modalSize").addClass(modal_size);
            } else {
                $("#modalSize").addClass('modal-md');
            }
            var data_title = $(this).attr('data-original-title');
            $("#showDetaildModalTile").text(data_title);
            $("#showDetaildModal").modal('show');
            $('div.ajaxLoader').show();
            //var delete_url =  $("#delete_url").val();
            $.ajax({
                type: "POST",
                data: JSON.stringify(arr), 
                url: $(this).attr('href'),
                success: function(data) {
                    console.log(data);
                    $("#showDetaildModalBody").html(data);
                    $("#showDetaildModal").modal('show');
                    //$("a#delete_confirm").attr("href", delete_url);
                }
            });
        }
        else{
            alert("Please Select issue First");
            return false;
        }
        
    });
});

// is Complete Status

$(document).ready(function() {
    $('body').on("click", "#is_complete_status", function(e) {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var total_issue  = $('[name="issue_id[]"]:checked').length;
        if(total_issue >0){
            var arr = [];
            $(".checkbox:checked").each(function () {
                arr.push($(this).val());
            });

            //document.getElementById("demo").innerHTML = arr;
            //e.preventDefault();
            //var track = $("#tracker").val();
            var project_id = $("#project_id").val();
            if(project_id === ""){
                alert("please select project first");
                return false;
            }
            else{
            arr.push(project_id);
            e.preventDefault();
        
            $.ajax({
                type: "POST",
                data: JSON.stringify(arr), 
                url: $(this).attr('href'),
                success: function(data) {
                //console.log(data);
                //window.location.replace(data);
                $(".display_own").show();

                $('.checkbox').each(function(){
                    this.checked = false;
                });
                 

                }
             });
            }
            
        }
        else{
            alert("Please Select issue First");
            return false;
        }
        
    });
});

/// is Complete Status for manage project

$(document).ready(function() {
    $('body').on("click", "#is_complete_status_mng_pro", function(e) {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var total_issue  = $('[name="issue_id[]"]:checked').length;
        if(total_issue >0){
            var arr = [];
            $(".checkbox:checked").each(function () {
                arr.push($(this).val());
            });

            //document.getElementById("demo").innerHTML = arr;
            //e.preventDefault();
            //var track = $("#tracker").val();
            var project_id = $("#project_id").val();
            if(project_id === ""){
                alert("please select project first");
                return false;
            }
            else{
            arr.push(project_id);
            e.preventDefault();
        
            $.ajax({
                type: "POST",
                data: JSON.stringify(arr), 
                url: $(this).attr('href'),
                success: function(data) {
                //console.log(data);
                //window.location.replace(data);
                alert("Your Issue are updated in complete status.");

                $('.checkbox').each(function(){
                    this.checked = false;
                });
                 

                }
             });
            }
            
        }
        else{
            alert("Please Select issue First");
            return false;
        }
        
    });
});

//Dropzone script
    // Dropzone.autoDiscover = false;
    // var myDropzone = new Dropzone("div#myDrop", 
    //  { 

    //      paramName: "files", // The name that will be used to transfer the file
    //      addRemoveLinks: true,
    //      uploadMultiple: true,
    //      autoProcessQueue: false,
    //      parallelUploads: 50,
    //      maxFilesize: 2, // MB
    //      acceptedFiles: ".png, .jpeg, .jpg, .gif",
    //      url: $('#url').val()+"/add_comment",
    //  });


    //  /* Add Files Script*/
    //  myDropzone.on("success", function(file, message){
    //     $("#msg").html(message);
    //     //setTimeout(function(){window.location.href="index.php"},800);
    //  });

    //  myDropzone.on("error", function (data) {
    //      $("#msg").html('<div class="alert alert-danger">There is some thing wrong, Please try again!</div>');
    //  });

    //  myDropzone.on("complete", function(file) {
    //     myDropzone.removeFile(file);
    //  });

    //  $("#add_file").on("click",function (){
    //     myDropzone.processQueue();
    //  });


//for upload user profile general Data
// $('form[id="comment_form"]').validate({
//     // rules: {
//     //     name: 'required',
//     // },
//     // messages: {
//     //     name: 'This field is required',
//      // },
//     submitHandler: function(form) {
//     $.ajax({
//     type: "POST",
//     url : $('#url').val()+"/"+url,
//     data: {$("#comments_file").serialize(), "_token": $('#token').val()},
//     //cache:false,
//     //contentType: false,
//     //processData: false,  
//     success: function(data) {
//         console.log("ok");

//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {}
//         });
//     }
// });


// student section info for student admission
$(document).ready(function(){

    $("#selectProject").change(function(){
        var selectProject = $(this).val();
        var formData = {
            id: $(this).val()
        };
        // get category by project
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: 'getDropdownData',
            success: function (data) {
                console.log(data);
                var a = '';
                $('#selectCategory').find('option').not(':first').remove();
                $.each(data.categories, function (i, category) {
                    $('#selectCategory').append($('<option>', { 
                        value: category.id,
                        text : category.category_name 
                    }));
                });

                $('#selectPriority').find('option').not(':first').remove();
                $.each(data.priorities, function (i, priority) {
                    $('#selectPriority').append($('<option>', { 
                        value: priority.id,
                        text : priority.priority_name 
                    }));
                });

                $('#selectStatus').find('option').not(':first').remove();
                $.each(data.statuss, function (i, status) {
                    $('#selectStatus').append($('<option>', { 
                        value: status.id,
                        text : status.status_name 
                    }));
                });

                console.log(a);    
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});


$(".project_status").click(function(){
 $.ajax({
    type: "post",
        //data: formData,
        data:{'id':$(this).attr('value'), 'project_id': $(this).attr('project_value'),  "_token": $('#token').val()},
        //dataType: 'json',
        url: $('#url').val()+"/seacrh_project_issue_by_status",
        success: function (data) {
          console.log(data);
          $(".issue_list_wrapper").html('');
          $(".issue_list_wrapper_another").show();
          $(".issue_list_wrapper_another").html(data);
      },
      error: function (data) {
        console.log('Error:', data);
    }
});

});


