$( document ).ready(function() {



// ############ PRJECT MODULE CODE ##################
// $("#msgcontainer").hide();
// $('#projectlist').SetEditable({
// columnsEd: "2,3,4",
// onEdit: function(columnsEd) {
//     $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

//     var projectid = columnsEd[0].childNodes[1].innerHTML;
//     var projecttitle = columnsEd[0].childNodes[5].innerHTML;
//     var projectkey = columnsEd[0].childNodes[7].innerHTML;
//     var projectdetail = columnsEd[0].childNodes[9].innerHTML;
    
//     $.ajax({
//         url: 'projects/'+projectid,
//         type: 'PUT',
//         data: {
//             id:projectid,
//             project_name: projecttitle,
//             project_key: projectkey,
//             project_detail: projectdetail,
//         },
//         success: function(response){
//           $("#msgcontainer").show();
//           if (response) {
//             $.iaoAlert({msg: "Data has been updated",
//             type: "success",
//             mode: "dark",})
//             // $("#successmsg").html(response);
//             // setTimeout(function() {
//             //         $("#msgcontainer").fadeOut("slow");
//             //     }, 2000 );
//           }
//         }
//     });
// }, 

// onDelete: function() {}, 
// onBeforeDelete: function(columnsEd) {
//     $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

//       var projectid = columnsEd[0].childNodes[1].innerHTML;

//         $.ajax({
//             url: 'projects/'+projectid,
//             type: 'DELETE',
//             success: function(response){

//             $.iaoAlert({msg: "Data has been deleted",
//             type: "warning",
//             mode: "dark",})

//               //   $("#msgcontainer").show();
//               //   if (response) {
//               //       $("#successmsg").html(response);
//               //       setTimeout(function() {
//               //           $("#msgcontainer").fadeOut("slow");
//               //       }, 2000 );
//               // }
//             }
//         });

//       },
// onAdd: function() {} 
// });
// ############ PRJECT MODULE CODE ENDS ##################





// ##################################### CODE FOR ISSUE TYPE START #####################################
 
// form required validation code
 $("#issuetypeform").validate({
   rules: {
      issue_type: {
      required: true
      },
      'color[]': {
        required: true
      }
    },
    messages: {
        issue_type: {
        required: "Issue Type field is required",
         },      
         color: {
          required: "Select any background color",
         },     
    },
  });


//issue entry form submit process
$('body').on('submit','#issuetypeform',function(e){

$.ajaxSetup({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
e.preventDefault();


    var formdata = $(this).serialize();
    var issue_type = $('#issue_type').val();
    var url = '{{ url("issuetype") }}';

    $.ajax({
        url: 'issuetype',
        type: 'POST',
        data: formdata,

        success: function(data){
            // $.iaoAlert({msg: "Data has been saved",
            // type: "success",
            // mode: "dark",})
            // // showdata();
            alert(data);

              $('#issuetypemodal').modal('hide');
              document.getElementById("issuetypeform").reset();

               $.iaoAlert({msg: "Data has been saved",
              type: "success",
              mode: "dark",});

               setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);


        },
        error: function (request, status, error) {
            $.iaoAlert({msg: "Please fill the field",
            type: "warning",
            mode: "dark",})



            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.errmsg').show();
                $('.alert-danger').append('<p>'+value+'</p>');
              setTimeout(function() { 
                 $('.errmsg').hide();
                  $('.alert-danger').append('');
              }, 2000);

                
            });
            $("#result").html('');
        }



    });


});

//issue modal closing input data reseting
$('#issuetypeclosebtn').on('click',function(e){
  e.preventDefault();
  document.getElementById("issuetypeform").reset();
});


//datatable apply
   $('#issuetypelist').DataTable( {
        "order": [],
        ordering:false
    } );


// PROJECT LIST DRAG DROP SORTING
//   $( "#tablecontents" ).sortable({
//     items: "tr",
//     cursor: 'move',
//     opacity: 0.6,
//     update: function() {
//         sendOrderToServer();
//     }
//   });

// function sendOrderToServer() {

//     $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

//     var order = [];
//     $('tr.row1').each(function(index,element) {
//       order.push({
//         id: $(this).attr('data-id'),
//         position: index+1
//       });
//        // alert(JSON.stringify(order, null, 4));exit();
//     });

//     $.ajax({
//         url: 'issuetype',
//         type: 'PUT',
//         data: {
//             order:order,
//            _token: '{{csrf_token()}}'
//         },
//         success: function(response){
//           $("#msgcontainer").show();
//           if (response) {
//           $.iaoAlert({msg: "Ordering Successfull",
//             type: "success",
//             mode: "dark",})
//           }
//         },
//         error: function() {
//           alert('Error occurs!');
//        }
//     });



//   }




// ##################################### CODE FOR ISSUE TYPE ENDS #########################







// ##################################### CODE FOR ISSUE CATEGORY STARTS #########################

// form required validation code
 $("#issuecatform").validate({
   rules: {
      category_name: {
      required: true
      }
    },
    messages: {
        category_name: {
        required: "Issue Type field is required",
         }  
    },
  });

//issue CAT entry form submit process
$('body').on('submit','#issuecatform',function(e){

$.ajaxSetup({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
e.preventDefault();


    var formdata = $(this).serialize();
    var issue_type = $('#category_name').val();
    var url = '{{ url("category") }}';

    $.ajax({
        url: 'category',
        type: 'POST',
        data: formdata,

        success: function(data){
            // $.iaoAlert({msg: "Data has been saved",
            // type: "success",
            // mode: "dark",})
            // // showdata();
            alert(data);
            
              $('#issuecatmodal').modal('hide');
              document.getElementById("issuecatform").reset();

               $.iaoAlert({msg: "Data has been saved",
              type: "success",
              mode: "dark",});

               setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);


        },
        error: function (request, status, error) {
            $.iaoAlert({msg: "Please fill the field",
            type: "warning",
            mode: "dark",})



            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.errmsg').show();
                $('.alert-danger').append('<p>'+value+'</p>');
              setTimeout(function() { 
                 $('.errmsg').hide();
                  $('.alert-danger').append('');
              }, 2000);

                
            });
            $("#result").html('');
        }



    });


});

$('#issuecatclosebtn').on('click',function(e){
  e.preventDefault();
  document.getElementById("issuetypeform").reset();
});


   $('#issuecatlist').DataTable( {
        "order": [],
        ordering:false
    } );


// ##################################### CODE FOR ISSUE CATEGORY ENDS #########################




// ##################################### CODE FOR PRIORITY START #####################################
 
// form required validation code
 $("#priorityform").validate({
   rules: {
      priority_name: {
      required: true
      },
      'color[]': {
        required: true
      }
    },
    messages: {
        priority_name: {
        required: "Priority Name field is required",
         },      
         color: {
          required: "Select any background color",
         },     
    },
  });


//issue entry form submit process
$('body').on('submit','#priorityform',function(e){

$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

e.preventDefault();


    var formdata = $(this).serialize();

    var issue_type = $('#priority_name').val();
    var url = '{{ url("priority") }}';

    $.ajax({
        url: 'priority',
        type: 'POST',
        data: formdata,

        success: function(data){
            // $.iaoAlert({msg: "Data has been saved",
            // type: "success",
            // mode: "dark",})
            // // showdata();
            alert(data);

              $('#prioritymodal').modal('hide');
              document.getElementById("priorityform").reset();

               $.iaoAlert({msg: "Data has been saved",
              type: "success",
              mode: "dark",});

               setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);


        },
        error: function (request, status, error) {
            $.iaoAlert({msg: "Please fill the field",
            type: "warning",
            mode: "dark",})



            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.errmsg').show();
                $('.alert-danger').append('<p>'+value+'</p>');
              setTimeout(function() { 
                 $('.errmsg').hide();
                  $('.alert-danger').append('');
              }, 2000);

                
            });
            $("#result").html('');
        }



    });


});

//issue modal closing input data reseting
$('#priorityclosebtn').on('click',function(e){
  e.preventDefault();
  document.getElementById("priorityform").reset();
});


//datatable apply
   $('#prioritylist').DataTable( {
        "order": [],
        ordering:false
    } );







// ##################################### CODE FOR PRIORITY ENDS #########################
















});