</div>
    </main>    
  </div>
</div>
</div>
</div>
<footer class="footer bg-dark py-2">
  <div class="d-sm-flex justify-content-center justify-content-sm-between text-light">
    <span class="text-center text-sm-left text-light d-block d-sm-inline-block mt-3 mt-sm-2">Copyright © 2023. Admin. Tous droits réservés.</span>
    <span class="float-none float-sm-right d-block mt-3 mt-sm-2 text-center">L3 Info <i class="ti-heart text-danger ml-1"></i></span>
  </div>
</footer>

<!-- plugins:js -->
<script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
{{-- <script src="{{ url('js/data-table.js') }}"></script> --}}
{{-- <script src="{{ url('vendors/datatables.net/jquery.dataTables.js') }}"></script> --}}
{{-- <script src="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script> --}}
{{-- <script src="{{ url('js/dataTables.select.min.js') }}"></script> --}}

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ url('js/off-canvas.js') }}"></script>
<script src="{{ url('js/hoverable-collapse.js') }}"></script>
<script src="{{ url('js/template.js') }}"></script>
<script src="{{ url('js/settings.js') }}"></script>
<script src="{{ url('js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ url('js/dashboard.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/Chart.roundedBarCharts.js') }}"></script> 
<script src="{{ url('js/owl.carousel.min.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>
<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ url('datatables/datatables.min.js') }}"></script>

{{-- Reusable Confirmation Dialog --}}
{{-- <script src="{{ url('reusable-confirmation-dialog/dialog/index.js') }}"></script> --}}

{{-- sweetalert --}}
{{-- <script src="{{ url('sweetalert/sweetalert.min.js') }}"></script> --}}
<script src="sweetalert2.all.min.js"></script>

<!-- End custom js for this page-->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script> --}}

@yield('scripts')
@stack('scripts')

</body>
</html>