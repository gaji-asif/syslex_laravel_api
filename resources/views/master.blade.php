<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="ie=edge" http-equiv="x-ua-compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Dashboard</title>
<link href="../assets/images/favicon.png" rel="shortcut icon">
<script src="{{asset('assets_new/js/jquery-3.1.1.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets_new/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/plugins/customScroll/jquery.mCustomScrollbar.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/simple-line/css/simple-line-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/dripicons/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/fontawesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/metrize/metrize.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/plugins/date-range/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/normalize.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/lightbox.css')}}">
<!-- <link rel="stylesheet" href="{{asset('assets_new/css/fileuploader.css')}}"> -->
<link rel="stylesheet" href="{{asset('assets_new/css/checkbox.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/jquery.mswitch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets_new/css/asif_style.css')}}">
<script src="{{asset('/js/developer.js')}}"></script>


<script src="{{asset('assets_new/js/sweetalert.js')}}"></script>
<!-- <script src="{{asset('assets_new/js/fileuploader.min.js')}}"></script> -->
<script src="{{asset('assets_new/js/jquery.uploadPreview.js')}}"></script>
<script src="{{asset('assets_new/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets_new/js/jquery.mswitch.js')}}"></script>
<script src="{{asset('assets_new/js/header.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
});
</script>

</head>
<body>


@include('layouts.header');
@include('layouts.sidebar');



<!--Page Container-->
<section class="page-container">
  @yield('mainContent')
</section>

<div class="has-modal modal fade" id="showDetaildModal">
  <div class="modal-dialog modal-dialog-centered" id="modalSize">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header justify-content-between">
        <h6 class="modal-title" id="showDetaildModalTile"></h6>
        <button type="button" class="close icons" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="showDetaildModalBody">
      </div>
      <!-- Modal footer -->
    </div>
  </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('assets_new/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets_new/js/popper.min.js')}}"></script>
<script src="{{asset('assets_new/js/modernizr.custom.js')}}"></script>
<script src="{{asset('assets_new/plugins/customScroll/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/sortable2/sortable.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/date-range/moment.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/date-range/daterangepicker.js')}}"></script>
<script src="{{asset('assets_new/plugins/data-tables/datatables.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/editable/editable.js')}}"></script>
<script src="{{asset('assets_new/js/main.js')}}"></script>
<script src="{{asset('assets_new/js/lightbox.js')}}"></script>
<script src="{{asset('assets_new/js/custom.js')}}"></script>
<script src="{{asset('assets_new/js/chosen.jquery.js')}}"></script>
<script src="{{asset('assets_new/js/ImageSelect.jquery.js')}}"></script>

<script type="text/javascript">
$(".my-select").chosen({width:"100%"});
</script>

<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script>
        var lineChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'New Member',
                borderColor: window.chartColors.red,
                backgroundColor: window.chartColors.red,
                fill: false,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                yAxisID: 'y-axis-1',
            }, {
                label: 'New Activated Member',
                borderColor: window.chartColors.blue,
                backgroundColor: window.chartColors.blue,
                fill: false,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                yAxisID: 'y-axis-2'
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = Chart.Line(ctx, {
                data: lineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: true,
                        text: 'Member Statistics'
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'left',
                            id: 'y-axis-1',
                        }, {
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'right',
                            id: 'y-axis-2',

                            // grid line settings
                            gridLines: {
                                drawOnChartArea: false, // only want the grid lines for one axis to show up
                            },
                        }],
                    }
                }
            });
        };
    </script>
  

<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  });

  $('.choose_file_file_tab input').change(function(){
    $('.choose_file_file_tab button').trigger('click');
  });
</script>

<!-- <script>
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script> -->

<!-- <script type="text/javascript">
  $('.sidebar_tabs.nav-pills .nav-link').click(function(){
      var fid = $(this).attr("href");
      var itemId = fid.substring(1, fid.length);
      ('.client_data_tab').css("display", "none !important");
      $('.client_data_tab').attr("id", itemId).fadeIn(500);
  });
</script> -->

<script type="text/javascript">
  //one
  $('.sidebar_tabs .nav-link[href="#v-pills-client-data"]').click(function(){
    $('.alert-success').hide();
    $('#v-pills-client-data').show(500);
    $('#v-pills-coaching, #v-pills-membership, #v-pills-files, #v-pills-notes').hide(500);
  });

  //two
  $('.sidebar_tabs .nav-link[href="#v-pills-coaching"]').click(function(){
    $('.alert-success').hide();
    $('#v-pills-coaching').show(500);
    $('#v-pills-client-data, #v-pills-membership, #v-pills-files, #v-pills-notes').hide(500);
  });

  //three
  $('.sidebar_tabs .nav-link[href="#v-pills-membership"]').click(function(){
    $('.alert-success').hide();
    $('#v-pills-membership').show(500);
    $('#v-pills-client-data, #v-pills-coaching, #v-pills-files, #v-pills-notes').hide(500);
  });

  //four
  $('.sidebar_tabs .nav-link[href="#v-pills-files"]').click(function(){
    $('.alert-success').hide();
    $('#v-pills-files').show(500);
    $('#v-pills-client-data, #v-pills-coaching, #v-pills-membership, #v-pills-notes').hide(500);
  });

  //fifth
  $('.sidebar_tabs .nav-link[href="#v-pills-notes"]').click(function(){
    $('.alert-success').hide();
    $('#v-pills-notes').show(500);
    $('#v-pills-client-data, #v-pills-coaching, #v-pills-membership, #v-pills-files').hide(500);
  });
</script>
</body>
</html>