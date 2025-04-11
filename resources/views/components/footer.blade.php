        <footer class="site-footer style-3 bg-dark" id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row text-xl-start">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 m-b20">
                            <div class="footer-logo">
                                <a href="/" class="logo-white"><img src="{{ asset('/assets/images/logo-white.svg') }}" alt="Meekismusic"></a>
                            </div>
                            <p class="text">Your premier destination for high-quality beats and music production.</p>
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <h6 class="footer-title">Quick Links</h6>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="footer-title">Marketplace</h6>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('marketplace.index') }}">All Beats</a></li>
                                    <li><a href="{{ route('marketplace.index') }}?genre=hiphop">Hip Hop</a></li>
                                    <li><a href="{{ route('marketplace.index') }}?genre=rnb">R&B</a></li>
                                    <li><a href="{{ route('marketplace.index') }}?genre=trap">Trap</a></li>
                                    <li><a href="{{ route('marketplace.index') }}?genre=afrobeat">Afrobeat</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="footer-title">Newsletter</h6>
                            <form class="dzSubscribe dz-subscribe-wrapper1" action="assets/script/mailchamp.php" method="post">
                                <div class="dzSubscribeMsg"></div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <i class="fa-regular fa-envelope"></i>
                                        <input name="dzEmail" required="required" type="email" class="form-control" placeholder="Enter Your Email Address">
                                        <div class="input-group-addon">
                                            <button name="submit" value="Submit" type="submit" class="btn-link">
                                                <i class="la la-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input checkbox-secondary m-r15" type="checkbox" id="footer_check" value="">
                                    <label class="form-check-label" for="footer_check">I Agree To The <span><a href="javascript:void(0)">Privacy Policy</a></span></label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <div class="contact-sidebar">
        <div class="contact-box1 deznav-scroll">
            <div class="logo-contact logo-header m-0">
                <a href="index.html" class="logo-white"><img src="assets/images/logo-white.png" alt="/"></a>
            </div>
            <p class="text">The power of music lies not just in a the sounds it produces, but in the emotion it evokes, the memories it triggers</p>
            <h4 class="dz-title">Contact Us</h4>

            <ul class="contact-address">
                <li>785 15h Street, Office 478 Berlin, De 81566</li>
                <li>Demo@gmail.com</li>
                <li>+1012 3456 789</li>
            </ul>
            
            <h4 class="dz-title">Newsletter</h4>
            <form class="dzSubscribe dz-subscribe-wrapper1" action="assets/script/mailchamp.php" method="post">
                <div class="dzSubscribeMsg"></div>
                <div class="form-group">
                    <div class="input-group">
                        <i class="fa-regular fa-envelope"></i>
                        <input name="dzEmail" required="required" type="email" class="form-control" placeholder="Enter Your Email Address">
                        <div class="input-group-addon">
                            <button name="submit" value="Submit" type="submit" class="btn-link">
                                <i class="la la-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkbox-secondary m-r15" type="checkbox" id="contact_check" value="">
                    <label class="form-check-label" for="contact_check">I Agree To The <span><a href="javascript:void(0)">Privacy Policy</a></span></label>
                </div>
            </form>
            
            <h4 class="dz-title">Follow Us</h4>
            <div class="dz-social-icon style-1 dz-hover-move white m-b30">
                <ul>                                    
                    <li style="transform: translate(0px, 0px) scale(1);">
                        <a target="_blank" href="https://www.facebook.com/dexignzone/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li style="transform: translate(-0.1px, 0px) scale(1);">
                        <a target="_blank" href="https://twitter.com/dexignzones">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li style="transform: translate(-0.1px, 0px) scale(1);">
                        <a target="_blank" href="https://www.instagram.com/dexignzone/">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li style="transform: translate(0px, -0.1px) scale(1);">
                        <a target="_blank" href="https://www.youtube.com/channel/UCGL8V6uxNNMRrk3oZfVct1g">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>	
        <div class="menu-close"><a href="javascript:void(0)">Close <i class="fa-solid fa-xmark"></i></a></div>
    </div>

    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="{{asset('/assets/js/jquery.min.js')}}"></script><!-- JQUERY.MIN JS -->
    <script src="{{asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="{{asset('/assets/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script><!-- BOOTSTRAP SELEECT -->
    <script src="{{asset('/assets/vendor/magnific-popup/magnific-popup.js')}}"></script><!-- MAGNIFIC POPUP JS -->
    <script src="{{asset('/assets/vendor/masonry/masonry-4.2.2.js')}}"></script><!-- MASONRY -->
    <script src="{{asset('/assets/vendor/wow/wow.js')}}"></script><!-- WOW JS -->
    <script src="{{asset('/assets/vendor/masonry/isotope.pkgd.min.js')}}"></script><!-- ISOTOPE -->
    <script src="{{asset('/assets/vendor/imagesloaded/imagesloaded.js')}}"></script><!-- IMAGESLOADED -->
    <script src="{{asset('/assets/vendor/counter/waypoints-min.js')}}"></script><!-- WAYPOINTS JS -->
    <script src="{{asset('/assets/vendor/countdown/jquery.countdown.js')}}"></script><!-- COUNTDOWN FUCTIONS  -->
    <script src="{{asset('/assets/vendor/perfect-scrollbar/js/perfect-scrollbar.min.js')}}"></script><!-- SCROLLBAR -->
    <script src="{{asset('/assets/vendor/counter/counterup.min.js')}}"></script><!-- COUNTERUP JS -->
    <script src="{{asset('/assets/vendor/swiper/swiper-bundle.min.js')}}"></script><!-- OWL-CAROUSEL -->
    <script src="{{asset('/assets/vendor/particles/particles.js')}}"></script>
    <script src="{{asset('/assets/vendor/particles/particles-app.js')}}"></script>
    <script src="{{asset('/assets/js/dz.carousel.js')}}"></script><!-- OWL-CAROUSEL -->
    <script src="{{asset('/assets/js/custom.js')}}"></script><!-- CUSTOM JS -->
    <script src="{{asset('/assets/vendor/rangeslider/rangeslider.js')}}"></script><!-- CUSTOM JS -->
        <!-- Scripts -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.2/color-thief.umd.js"></script>
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     const colorThief = new ColorThief();
    //     const beatCards = document.querySelectorAll(".music-box");

    //     beatCards.forEach(card => {
    //         const img = new Image();
    //         img.crossOrigin = "Anonymous"; // Prevent CORS issues
    //         img.src = card.getAttribute("data-image");

    //         img.onload = function () {
    //             const palette = colorThief.getPalette(img, 6); // Extract 6 colors

    //             if (palette && palette.length > 0) {
    //                 // Sort colors by brightness (darker ones first)
    //                 palette.sort((a, b) => {
    //                     const lumA = 0.299 * a[0] + 0.587 * a[1] + 0.114 * a[2];
    //                     const lumB = 0.299 * b[0] + 0.587 * b[1] + 0.114 * b[2];
    //                     return lumA - lumB;
    //                 });

    //                 const darkColor = `rgb(${palette[0].join(",")})`; // Darkest color
    //                 const lightColor = `#f8f9fa`; // Soft white

    //                 // Apply gradient background
    //                 card.style.background = `linear-gradient(180deg, ${darkColor} 0%, ${lightColor} 100%)`;
    //             }
    //         };
    //     });
    // });
</script>

        <script>
          let currentSound = null;
let currentButton = null;

document.querySelectorAll('.play-pause').forEach(button => {
    button.addEventListener('click', function () {
        const audioSrc = this.getAttribute('data-audio');

        // Stop currently playing audio if a different button is clicked
        if (currentSound && currentButton !== this) {
            currentSound.pause();
            currentButton.classList.remove('pause');
            currentButton.classList.add('play');
            currentSound = null;
            currentButton = null;
        }

        // Toggle Play/Pause
        if (currentButton === this && currentSound) {
            if (currentSound.paused) {
                currentSound.play();
                this.classList.remove('play');
                this.classList.add('pause');
            } else {
                currentSound.pause();
                this.classList.remove('pause');
                this.classList.add('play');
            }
        } else {
            currentSound = new Audio(audioSrc);
            currentSound.play();
            this.classList.remove('play');
            this.classList.add('pause');
            currentButton = this;

            // Reset to play when audio ends
            currentSound.addEventListener('ended', () => {
                this.classList.remove('pause');
                this.classList.add('play');
                currentSound = null;
                currentButton = null;
            });
        }
    });
});

        </script>
<script>
function toggleWishlist(element, beatId) {
    fetch(`/wishlist/${beatId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.status === 401) {
            // Redirect to login page if unauthorized
            window.location.href = "/login";
            return;
        }
        return response.json();
    })
    .then(data => {
        if (data && data.success) {
            // Check which icon is currently active and toggle between them
            $(element).toggleClass("heart-blast");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
            </script>

    @yield('footerscript')
</body>
</html> 