<!-- Main Footer -->
<footer class="main-footer">
    <span>Copyright &copy; {{ date('Y') }} <a href="#">All Shifts</a>.</span>
    All rights reserved.
    {{-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div> --}}
</footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('public/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ url('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ url('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('public/admin/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('public/admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ url('public/admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('public/admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('public/admin/dist/js/pages/dashboard2.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- Summernote -->
<script src="{{ url('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ url('public/admin/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ url('public/admin/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ url('public/admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ url('public/admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ url('public/admin/dist/js/demo.js') }}"></script>
<!-- Custom js -->
@include('admin.ajax')

@yield('script')
<script>
    @if(Session::has('success'))
    alert("{{ session('success') }}");
    @endif
    @if(Session::has('error'))
    alert("{{ session('error') }}");
    @endif
</script>

</body>

</html>