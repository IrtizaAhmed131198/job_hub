<!-- Footer -->
<footer class="footer mt-50">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <a href="#"><img alt="jobhub"
                        src="{{ url('public/assets/imgs/theme/jobhub-logo.svg') }}"></a>
                <div class="mt-20 mb-20">Jobhub is the heart of the design community and the best resource to discover
                    and connect with designers and jobs worldwide.</div>
            </div>
            <div class="col-md-2 col-xs-6">
                <h6>Company</h6>
                <ul class="menu-footer mt-40">
                    <li><a href="{{ route('aboutus') }}">About us</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="{{ route('job') }}">Job</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-xs-6">
                <h6>Support</h6>
                <ul class="menu-footer mt-40">
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6">
                    Copyright ©{{ date('Y') }} <a href="#"><strong>Jobhub</strong></a>. All Rights Reserved
                </div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social">
                        <a href="{{ App\Models\Settings::latest()->first()->facebook ?? '' }}" class="icon-socials icon-facebook"></a>
                        <a href="{{ App\Models\Settings::latest()->first()->twitter ?? '' }}" class="icon-socials icon-twitter"></a>
                        <a href="{{ App\Models\Settings::latest()->first()->instagram ?? '' }}" class="icon-socials icon-instagram"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<!-- Vendor JS -->
<script src="{{ url('public/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ url('public/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('public/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ url('public/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- Plugins JS -->
<script src="{{ url('public/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/wow.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ url('public/assets/js/plugins/swiper-bundle.min.js') }}"></script>

<!-- Template JS -->
<script src="{{ url('public/assets/js/main.js') }}"></script>
@include('front.ajax')
@yield('script')

<script>
    @if (Session::has('success'))
        toastr.success("{{ session('success') }}", 'Success');
    @endif
    @if (Session::has('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif

    const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    console.log('The current time zone is:', timeZone);

</script>
</body>

</html>
