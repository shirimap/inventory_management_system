

<!-- jQuery -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{URL::asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{URL::asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{URL::asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('dist/js/demo.js')}}"></script>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- FLOT CHARTS -->
<script src="{{asset('plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->




<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('dist/js/pages/dashboard3.js')}}"></script>
<!-- DataTables -->
<script src="{{URL::asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script src="{{URL::asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{URL::asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"],
        "pageLength": 10 // Show 10 rows per page
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true, // Allow changing the number of rows per page
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        // "displayStart": 5, // Display starting from the 5th row
        "pageLength": 10 // Show 10 rows per page
    });
    
    $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        // "displayStart": 15, // Display starting from the 15th row
        "pageLength": 10 // Show 10 rows per page
    });
});

</script>



</script>




{{--  <script>
    const export2Pdf = async () => {

      let printHideClass = document.querySelectorAll('.print-hide');
      printHideClass.forEach(item => item.style.display = 'none');
      await fetch('http://localhost:8000/export-pdf', {
        method: 'GET'
      }).then(response => {
        if (response.ok) {
          response.json().then(response => {
            var link = document.createElement('a');
            link.href = response;
            link.click();
            printHideClass.forEach(item => item.style.display='');
          });
        }
      }).catch(error => console.log(error));
    }
  </script>  --}}


</body>

</html>