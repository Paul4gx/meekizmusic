@extends('layouts.app')
@section('title', $beat->title)
@section('content')
<div class="page-content bg-white">
	<style>
		.modal-body {
			max-height: 70vh; /* 70% of the viewport height */
			overflow-y: auto; /* vertical scroll if needed */
			padding: 20px;
			}
	</style>
    <x-breadcrumb title="{{ $beat->title }}" content="Beat" />
		<section class="content-inner-3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-xl-6 col-lg-6 col-md-12 m-b0 m-sm-b30">
						<div class="dz-product-detail">
							<div class="swiper-btn-center-lr">
								<div class="swiper product-gallery-swiper2">
									<div class="swiper-wrapper" id="lightgallery">
										<div class="swiper-slide">
											<div class="dz-media">
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
									<div class="dz-content-start w-100">
										<span class="badge bg-primary mb-2 rounded-0">SALE 20% Off</span>
										<h4 class="title mb-1">{{ $beat->title }} </h4>
										<div class="dz-player style-2 p-2" style="gap:0;" data-src="{{ htmlspecialchars(url($beat->preview_url)) }}">
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
                                                <span class="dzPlayDuration">{{ $beat->duration }}</span>
                                            </div>
                                            <div class="dz-volume-container">
                                                <span class="dzPlayerVolIcon"><i class="fa fa-volume-up"></i></span>
                                                <div class="dz-player-range-volume">
                                                    <span class="under-dz-player-ranger"></span>
                                                    <input class="dzPlayVol" type="range" min="0" max="1" value="1" step="0.1"><span class="change-dz-player-range"></span>
                                                </div>
                                            </div>
                                        </div>

										  
                                        {{-- <div class="review-num"> --}}
											{{-- <ul class="dz-rating me-2">
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
											</ul> --}}
											{{-- <span class="text-secondary me-2">4.7 Rating</span> --}}
											{{-- <a href="javascript:void(0);">(5 customer reviews)</a> --}}
										{{-- </div> --}}
									</div>
								</div>
								<p class="para-text">
									{{ $beat->description }}</p>
								<div class="product-num align-items-center" style="margin-bottom: 0px">
									<div class="d-block">
										{{-- <div>
											<h5 class="sub-title">Price:</h5>
											<div class="me-3">
												<span class="price-num">
													{{ currency_symbol().number_format($beat->price, 2) }}
													<del>{{ currency_symbol().number_format($beat->price * 1.2, 2) }}</del>
												</span>
												
											</div>	
										</div> --}}
									</div>
								</div>
								<div style="text-align: left; margin-top: 10px;">
									<span style="display: inline-block; padding: 10px 10px; color: #28a745; font-weight: bold;">
									  🔒 Certified Exclusive Beats - Yours Only
									</span>
								</div>
								<p><strong>Rights:</strong> Full commercial usage granted upon purchase. Files include full audio files and beat licensing document.</p>

								<div class="btn-group cart-btn">
				{{-- @if($beat->is_sold === false)
                @auth
				<form action="{{ route('checkout.initialize') }}" method="POST">
					@csrf
					<input type="hidden" name="beat_id" value="{{ $beat->id }}">
					<button type="submit" class="btn btn-secondary btn-md rounded-0 text-uppercase">
						Buy Now
					</button>
				</form> --}}
                        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#purchaseAgreementModal" class="btn btn-secondary btn-md rounded-0 text-uppercase">
                            Buy Now
                        </button> --}}
                {{-- @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-md rounded-0 text-uppercase">
                        Login to Purchase
                    </a>
                @endauth --}}
				<a href="https://wa.me/2347041039145?text={{ urlencode('Hi, I am interested in purchasing this beat: ' . $beat->title) }}" target="_blank" class="btn btn-md rounded-0 text-uppercase"  style="background-color:green;color:white;"><i class="la la-whatsapp-square" style="color:white;padding:5px;"></i>
                        Purchase Now
                </a>
				{{-- @else 
				<button class="btn btn-md rounded-0 text-uppercase" style="background-color:green;color:white;" disabled><i class="la la-check-circle" style="color:white;padding:5px;"></i> Sold</button>
				@endif --}}
									{{-- <button onclick="toggleWishlist(this,{{ $beat->id }}, true)" class="btn btn-gray btn-md btn-icon rounded-0 {{ $isInWishlist ? 'active' : '' }}">
										<span style="cursor: pointer" id="beat-like-icon" class="{{ $isInWishlist ? 'heart heart-blast' : 'heart' ?? 'heart' }}"></span>
										<span id="theliketext">{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}</span>
									</button> --}}
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
                                                <span>{{ collect(json_decode($genre->name, true) ?? [$genre->name])->implode(', ') }}</span>
                                            @endforeach
										</li>
										{{-- <li>
											<strong>Tags:</strong>
											<span>Leather jacket,</span>
											<span>Cap,</span>
											<span>Headphone,</span>
											<span>T-Shirts</span>
										</li> --}}
										@php
											$productUrl = urlencode(route('beats.show', $beat->id)); // or $beat->id
										@endphp

										<li>
											<strong>Share:</strong>
											<span>
												<a href="https://www.facebook.com/sharer/sharer.php?u={{ $productUrl }}" target="_blank">
													<i class="fa-brands fa-facebook-f"></i>
												</a>
											</span>
											<span>
												<a href="https://www.instagram.com/?url={{ $productUrl }}" target="_blank">
													<i class="fa-brands fa-instagram"></i>
												</a>
											</span>
											<span>
												<a href="https://x.com/intent/tweet?url={{ $productUrl }}" target="_blank">
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
  
  <!-- Modal -->
  <div class="modal fade" id="purchaseAgreementModal" tabindex="-1" aria-labelledby="purchaseAgreementModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Use XL and centered -->
		<div class="modal-content" style="max-width: 100%; margin: auto;">
		
		<div class="modal-header">
		  <h5 class="modal-title" id="purchaseAgreementModalLabel">Purchase Agreement</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		
		<div class="modal-body">
			<div class="blog-single dz-card mb-0">
				<div class="dz-info">
					<div class="dz-post-text">
						<div class="author-box p-1">
							<div class="author-profile-info">
								<div class="author-profile-content">
									<h6>By proceeding with this purchase, you hereby acknowledge and agree to the following terms:</h6>
								</div>
							</div>
						</div>
						<ul>
							<li>You are purchasing an exclusive license to use the beat for commercial and/or non-commercial purposes.</li>
							<li>You are prohibited from reselling, redistributing, transferring, or sublicensing the original beat file as-is.</li>
							<li>You agree to credit the Producer appropriately in all instances where the beat is used or performed publicly.</li>
							<li>All sales are final. No refunds will be issued after purchase completion, as the product is a digital good delivered instantly.</li>
							<li>The Producer retains authorship rights to the beat composition.</li>
							<li>You agree not to infringe upon the Producer’s copyright by claiming authorship of the beat itself.</li>
							<li>Violations of these terms may result in legal action and forfeiture of usage rights.</li>
						  </ul>
						  
						  <p class="mb-0">By clicking "Proceed to Checkout," you legally bind yourself to the terms stated above and acknowledge full understanding and acceptance of this License Agreement.</p>
						  
					</div>
			
				</div>
			</div>
		</div>
  
		<div class="modal-footer">
			<form action="{{ route('checkout.initialize') }}" method="POST">
				@csrf
				<input type="hidden" name="beat_id" value="{{ $beat->id }}">
				<button type="submit" class="btn btn-secondary btn-md rounded-0 text-uppercase">
					Proceed to Checkout
				</button>
			</form>
		</div>
  
	  </div>
	</div>
  </div>
  
@endsection 