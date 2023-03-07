<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D-bla Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/fontawesome-free/css/all.min.css")}} ">
  <!-- Theme style -->

  
  <!-- SimpleMDE -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/simplemde/simplemde.min.css")}} ">
  <link rel="stylesheet" href=" {{asset("assets/plugins/codemirror/codemirror.css")}} ">
  <link rel="stylesheet" href=" {{asset("assets/plugins/codemirror/theme/monokai.css")}} ">

  <link rel="stylesheet" href=" {{asset("assets/plugins/select2/css/select2.min.css")}} ">
  <link rel="stylesheet" href=" {{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}} ">
  <!-- iCheck -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}} ">
  <!-- JQVMap -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/jqvmap/jqvmap.min.css")}} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}} ">
  <!-- Daterange picker -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/daterangepicker/daterangepicker.css")}} ">
  <!-- summernote -->
  <link rel="stylesheet" href=" {{asset("assets/plugins/summernote/summernote-bs4.min.css")}} ">
  <!-- CodeMirror -->
  <link rel="stylesheet" href=" {{asset("assets/richtexteditor/rte_theme_default.css")}} " />

  <link rel="stylesheet" href=" {{asset("assets/dist_admin/css/adminlte.min.css")}} ">
  
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed sidebar-collapse">
<div class="wrapper">
     <!-- Preloader -->
    @yield('content')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src=" {{asset("assets/plugins/jquery/jquery.min.js")}} "></script>
<!-- jQuery UI 1.11.4 -->
<script src=" {{asset("assets/plugins/jquery-ui/jquery-ui.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables/jquery.dataTables.min.js")}} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src=" {{asset("assets/js/chartjs.js")}} "></script>
<script sourceMappingURL="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src=" {{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}} "></script>
<script src=" {{asset("assets/plugins/select2/js/select2.full.min.js")}} "></script>
<!-- AdminLTE App -->
<!-- ChartJS -->
<script src=" {{asset("assets/plugins/chart.js/Chart.min.js")}} "></script>
<!-- Sparkline -->
<script src=" {{asset("assets/plugins/sparklines/sparkline.js")}} "></script>
<!-- JQVMap -->
<script src=" {{asset("assets/plugins/jqvmap/jquery.vmap.min.js")}} "></script>
<script src=" {{asset("assets/plugins/jqvmap/maps/jquery.vmap.usa.js")}} "></script>
<!-- jQuery Knob Chart -->
<script src=" {{asset("assets/plugins/jquery-knob/jquery.knob.min.js")}} "></script>
<!-- daterangepicker -->
<script src=" {{asset("assets/plugins/moment/moment.min.js")}} "></script>
<script src=" {{asset("assets/plugins/daterangepicker/daterangepicker.js")}} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=" {{asset("assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}} "></script>
<!-- Summernote -->
<script src=" {{asset("assets/plugins/summernote/summernote-bs4.min.js")}} "></script>
<!-- overlayScrollbars -->
<!-- Select2 -->

<script src=" {{asset("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables/jquery.dataTables.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}} "></script>
<script src=" {{asset("assets/plugins/jszip/jszip.min.js")}} "></script>
<script src=" {{asset("assets/plugins/pdfmake/pdfmake.min.js")}} "></script>
<script src=" {{asset("assets/plugins/pdfmake/vfs_fonts.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-buttons/js/buttons.html5.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-buttons/js/buttons.print.min.js")}} "></script>
<script src=" {{asset("assets/plugins/datatables-buttons/js/buttons.colVis.min.js")}} "></script>
<script src=" {{asset("assets/dist_admin/js/adminlte.min.js")}} "></script>
<script type="text/javascript" src=" {{asset("assets/richtexteditor/rte.js")}} "></script>
<script type="text/javascript" src=" {{asset("assets/richtexteditor/plugins/all_plugins.js")}} "></script>

<script src=" {{asset("assets/dist_admin/js/pages/dashboard.js")}} "></script>
<!-- AdminLTE for demo purposes -->
<script src=" {{asset("assets/dist_admin/js/demo.js")}} "></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script>
	var editor1 = new RichTextEditor("#div_editor1");

	/* function btngetHTMLCode() {
		alert(editor1.getHTMLCode())
	}

	function btnsetHTMLCode() {
		editor1.setHTMLCode("<h1>editor1.setHTMLCode() sample</h1><p>You clicked the setHTMLCode button at " + new Date() + "</p>")
	}
	function btngetPlainText() {
		alert(editor1.getPlainText())
	} */

</script>



<script>
  $(function () {
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>