@extends('layouts.app')
@section('title', $beat->title)
@section('content')
<div class="page-content bg-white">
    <x-breadcrumb title="{{ $beat->title }}" content="Enjoy" />
		<section class="content-inner-3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-xl-6 col-lg-6 col-md-12 m-b0 m-sm-b30">
						<div class="dz-product-detail">
							<div class="swiper-btn-center-lr">
								<div class="swiper product-gallery-swiper2">
									<div class="swiper-wrapper" id="lightgallery">
										<div class="swiper-slide">
											<div class="dz-media DZoomImage">
												<a class="mfp-link lg-item" href="{{ Storage::url($beat->cover_image) }}" data-src="assets/images/products/headphone-1.png">
													<i class="feather icon-maximize dz-maximize top-right"></i>
												</a>
												<img src="{{ Storage::url($beat->cover_image) }}" alt="image">
                                                
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>	
					</div>
					<div class="col-xl-6 col-lg-6 col-md-12 m-b30">
						<div class="dz-product-detail style-2">
							<div class="dz-content">
								<div class="dz-content-footer">
									<div class="dz-content-start">
										<span class="badge bg-primary mb-2 rounded-0">SALE 20% Off</span>
										<h4 class="title mb-1">{{ $beat->title }}</h4>
										<div class="dz-player  style-2" data-src="{{ Storage::url($beat->preview_url) }}">
                                            <button class="dz-play-btn"><span class="dz-play-btnIco"><i class="fa-solid fa-play"></i></span></button>
                                            <button class="dz-play-btn"><span class="dz-play-btnIco"><svg class="svg-inline--fa fa-pause" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pause" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"></path></svg></span></button>
                                            <div class="dzPlayNum">
                                                <span class="dzPlayCurDuration">0:00</span>
                                            </div>
                                            <div class="dz-player-range">
                                                <span class="under-dz-player-ranger"></span>
                                                <input class="dzPlayRange" type="range" min="0" value="0" step="1" max="205"><span class="change-dz-player-range"></span>
                                            </div>
                                            <div class="dzPlayNum">
                                                <span class="dzPlayDuration">3:25</span>
                                            </div>
                                            <div class="dz-volume-container">
                                                <span class="dzPlayerVolIcon"><i class="fa fa-volume-up"></i></span>
                                                <div class="dz-player-range-volume">
                                                    <span class="under-dz-player-ranger"></span>
                                                    <input class="dzPlayVol" type="range" min="0" max="1" value="1" step="0.1"><span class="change-dz-player-range"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-num">
											<ul class="dz-rating me-2">
												<li>
													<svg width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z" fill="#FF8A00"></path>
													</svg>
												</li>	
												<li>
													<svg width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z" fill="#FF8A00"></path>
													</svg>
												</li>
												<li>
													<svg width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z" fill="#FF8A00"></path>
													</svg>
												</li>
												<li>
													<svg width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.2" d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z" fill="#5E626F"></path>
													</svg>

												</li>
												<li>
													<svg width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.2" d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z" fill="#5E626F"></path>
													</svg>
												</li>	
											</ul>
											<span class="text-secondary me-2">4.7 Rating</span>
											{{-- <a href="javascript:void(0);">(5 customer reviews)</a> --}}
										</div>
									</div>
								</div>
								<p class="para-text">
									{{ $beat->description }}</p>
								<div class="product-num align-items-center">
									<div class="d-block">
										<div>
											<h5 class="sub-title">Price:</h5>
											<div class="me-3">
												<span class="price-num">${{ number_format($beat->price,2) }} <del>${{ number_format($beat->price + 200, 2) }}</del></span>
											</div>	
										</div>
									</div>
								</div>
								<div class="btn-group cart-btn">
                                    @auth
                    <form action="{{ route('checkout.initialize') }}" method="POST">
                        @csrf
                        <input type="hidden" name="beat_id" value="{{ $beat->id }}">
                        <button type="submit" class="btn btn-secondary btn-md rounded-0 text-uppercase">
                            Buy Now
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-md rounded-0 text-uppercase">
                        Login to Purchase
                    </a>
                @endauth
									<button onclick="toggleWishlist(this,{{ $beat->id }})" class="btn btn-gray btn-md btn-icon rounded-0 {{ $isInWishlist ? 'active' : '' }}">
										<svg width="19" height="17" viewbox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M9.24805 16.9986C8.99179 16.9986 8.74474 16.9058 8.5522 16.7371C7.82504 16.1013 7.12398 15.5038 6.50545 14.9767L6.50229 14.974C4.68886 13.4286 3.12289 12.094 2.03333 10.7794C0.815353 9.30968 0.248047 7.9162 0.248047 6.39391C0.248047 4.91487 0.755203 3.55037 1.67599 2.55157C2.60777 1.54097 3.88631 0.984375 5.27649 0.984375C6.31552 0.984375 7.26707 1.31287 8.10464 1.96065C8.52734 2.28763 8.91049 2.68781 9.24805 3.15459C9.58574 2.68781 9.96875 2.28763 10.3916 1.96065C11.2292 1.31287 12.1807 0.984375 13.2197 0.984375C14.6098 0.984375 15.8885 1.54097 16.8202 2.55157C17.741 3.55037 18.248 4.91487 18.248 6.39391C18.248 7.9162 17.6809 9.30968 16.4629 10.7792C15.3733 12.094 13.8075 13.4285 11.9944 14.9737C11.3747 15.5016 10.6726 16.1001 9.94376 16.7374C9.75136 16.9058 9.50417 16.9986 9.24805 16.9986ZM5.27649 2.03879C4.18431 2.03879 3.18098 2.47467 2.45108 3.26624C1.71033 4.06975 1.30232 5.18047 1.30232 6.39391C1.30232 7.67422 1.77817 8.81927 2.84508 10.1066C3.87628 11.3509 5.41011 12.658 7.18605 14.1715L7.18935 14.1743C7.81021 14.7034 8.51402 15.3033 9.24654 15.9438C9.98344 15.302 10.6884 14.7012 11.3105 14.1713C13.0863 12.6578 14.6199 11.3509 15.6512 10.1066C16.7179 8.81927 17.1938 7.67422 17.1938 6.39391C17.1938 5.18047 16.7858 4.06975 16.045 3.26624C15.3152 2.47467 14.3118 2.03879 13.2197 2.03879C12.4197 2.03879 11.6851 2.29312 11.0365 2.79465C10.4585 3.24179 10.0558 3.80704 9.81975 4.20255C9.69835 4.40593 9.48466 4.52733 9.24805 4.52733C9.01143 4.52733 8.79774 4.40593 8.67635 4.20255C8.44041 3.80704 8.03777 3.24179 7.45961 2.79465C6.811 2.29312 6.07643 2.03879 5.27649 2.03879Z" fill="black"></path>
										</svg>
										{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
									</button>
								</div>
								<div class="dz-info">
									<ul>
										<li>
											<strong>BPM:</strong>
											<span>{{ $beat->bpm }}BPM</span>
										</li>
										<li>
											<strong>Genre:</strong>
                                            @foreach($beat->genres as $genre)
                                                <span>{{ $genre->name }},</span>
                                            @endforeach
										</li>
										<li>
											<strong>Tags:</strong>
											<span>Leather jacket,</span>
											<span>Cap,</span>
											<span>Headphone,</span>
											<span>T-Shirts</span>
										</li>
										<li>
											<strong>Share:</strong>
											<span>											
												<a href="https://www.facebook.com/dexignzone">
													<i class="fa-brands fa-facebook-f"></i>
												</a>
											</span>
											<span>											
												<a href="https://www.linkedin.com/showcase/3686700/admin/">
													<i class="fa-brands fa-linkedin-in"></i>
												</a>
											</span>
											<span>											
												<a href="https://www.instagram.com/dexignzone/">
													<i class="fa-brands fa-instagram"></i>
												</a>
											</span>
											<span>											
												<a href="https://twitter.com/dexignzones">
													<i class="fa-brands fa-twitter"></i>
												</a>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        @if($relatedBeats->count() > 0)
                <section class="content-inner-1">
                    <div class="container">
                        <div class="section-head style-1">
                            <h2 class="title">Related Products</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($relatedBeats as $beat)
                                <x-beatcolumn :beat="$beat" colClass="col-6 col-lg-3 col-md-3" />
                            @endforeach
                        </div>
                    </div>
                </section>
                @endif
@endsection 