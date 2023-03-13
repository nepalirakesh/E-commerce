<!-- jQuery -->
<script src="
{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="
{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="
{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="
{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="
{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="
{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="
{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="
{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="
{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="
{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="
{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="
{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="
{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="
{{ asset('dist/js/adminlte.js') }}"></script>
{{-- Data Table --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "{{ route('users.data') }}",
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'created_at'
                }
            ]
        });
    });
</script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    var loadFile = function(event) {
        var show = document.getElementById('show')
        show.style.display = "block";
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);

    };
</script>
<script>
    var loadFile_front = function(event) {
        var show = document.getElementById('front_show')
        show.style.display = "block";
        var preview = document.getElementById('front_preview');
        preview.src = URL.createObjectURL(event.target.files[0]);

    };
</script>
<script>
    var loadFile_back = function(event) {
        var show = document.getElementById('back_show')
        show.style.display = "block";
        var preview = document.getElementById('back_preview');
        preview.src = URL.createObjectURL(event.target.files[0]);

    };
</script>
<script>
    var loadFile_side = function(event) {
        var show = document.getElementById('side_show')
        show.style.display = "block";
        var preview = document.getElementById('side_preview');
        preview.src = URL.createObjectURL(event.target.files[0]);

    };
</script>
