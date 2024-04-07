<!-- Start Footer  -->
<footer>
  <div class="footer-main">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="footer-widget">
                      <h4>A propos nous</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                          ullamco laboris nisi ut aliquip ex ea commodo consequat.
                      </p>
                      <ul>
                          <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>                          
                          <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12" hidden>
                  <div class="footer-link">
                      <h4>Informations</h4>
                      <ul>
                          <li><a href="{{ route('about.index') }}">A propos nous</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="footer-link-contact">
                      <h4>Contactez-nous</h4>
                      <ul>
                          <li>
                              <p><i class="fas fa-map-marker-alt"></i>Adresse: Tlemcen. <br>Tlemcen,<br> Tlemcen
                              </p>
                          </li>
                          <li>
                              <p><i class="fas fa-phone-square"></i>Tél: <a href="tel:+1-888705770">+213-43 000
                                      000</a></p>
                          </li>
                          <li>
                              <p><i class="fas fa-envelope"></i>Email: <a
                                      href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </footer>
  <!-- End Footer  -->
  
  <!-- Start copyright  -->
  <div class="footer-copyright">
  <p class="footer-company">Tous droits réservés. &copy; 2023 <a href="#">L3 INFO</a>
  </div>
  <!-- End copyright  -->
  
  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
  
      <!-- ALL JS FILES -->
      <script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ url('js/popper.min.js') }}"></script>
      <script src="{{ url('js/bootstrap.min.js') }}"></script>
      <!-- ALL PLUGINS -->
      <script src="{{ url('js/jquery.superslides.min.js') }}"></script>
      <script src="{{ url('js/bootstrap-select.js') }}"></script>
      <script src="{{ url('js/inewsticker.js') }}"></script>
      <script src="{{ url('js/bootsnav.js') }}"></script>
      <script src="{{ url('js/images-loded.min.js') }}"></script>
      <script src="{{ url('js/isotope.min.js') }}"></script>
      <script src="{{ url('js/owl.carousel.min.js') }}"></script>
      <script src="{{ url('js/baguetteBox.min.js') }}"></script>
      <script src="{{ url('js/jquery-ui.js') }}"></script>
      <script src="{{ url('js/jquery.nicescroll.min.js') }}"></script>
      <script src="{{ url('js/form-validator.min.js') }}"></script>
      <script src="{{ url('js/contact-form-script.js') }}"></script>
      <script src="{{ url('js/custom.js') }}"></script>
      <script src="{{ url('js/script.js') }}"></script>
      <script src="{{ url('js/cart.js') }}"></script>

      @yield('scripts')
      
  </body>
  
  </html>