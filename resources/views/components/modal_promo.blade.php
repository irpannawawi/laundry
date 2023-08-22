  <!-- Modal -->
  <div class="modal fade" id="modalPromo" tabindex="-1" aria-labelledby="modalPromoLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body p-2">
                  <button type="button" style="position:absolute; z-index:2; right:20px" class="btn-close float-end" onclick="modal_dismiss()" aria-label="Close"></button>
                  <div id="template-mo-zay-hero-carousel-2" class="m-0 carousel slide" data-bs-ride="carousel">
                      <ol class="carousel-indicators">
                          <li data-bs-target="#template-mo-zay-hero-carousel-2" data-bs-slide-to="0" class="active">
                          </li>
                          <li data-bs-target="#template-mo-zay-hero-carousel-2" data-bs-slide-to="1"></li>
                          <li data-bs-target="#template-mo-zay-hero-carousel-2" data-bs-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                          <div class="carousel-item active">
                              <div class="container">
                                  <img src="assets/images/gallery/banner_promo1.png" alt="banner_promo1" class="img-fluid">
                              </div>
                          </div>
                          <div class="carousel-item">
                              <div class="container">
                                  <img src="assets/images/gallery/banner_promo2.png" alt="banner_promo1" class="img-fluid">
                              </div>
                          </div>
                          <div class="carousel-item">
                              <div class="container">
                                  <img src="assets/images/gallery/banner_promo3.png" alt="banner_promo1" class="img-fluid">
                              </div>
                          </div>
                      </div>
                      <a class="carousel-control-prev text-decoration-none w-auto ps-3"
                          href="#template-mo-zay-hero-carousel-2" role="button" data-bs-slide="prev">
                          <i class="fas fa-chevron-left"></i>
                      </a>
                      <a class="carousel-control-next text-decoration-none w-auto pe-3"
                          href="#template-mo-zay-hero-carousel-2" role="button" data-bs-slide="next">
                          <i class="fas fa-chevron-right"></i>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @if (Auth::user()== null)

      @section('extraJs')
          <script>
              var myModal = new bootstrap.Modal(document.getElementById('modalPromo'))
              myModal.show()
              function modal_dismiss(){
                myModal.hide()
              }
          </script>
      @endsection
  @endif
