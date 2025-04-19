@extends('layouts.app')

@section('title', 'Welcome')

@section('metadata')
@endsection
@section('headerscript')
@endsection
@section('content')
<div class="page-content bg-white">
		
    <div class="dz-bnr-inr style-2" style="background-image:url('assets/images/banner/main.webp');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="dz-bnr-inr-entry">
                        <h3 class="title" style="margin-bottom:5px;">Feel the Beat, Own the Vibe</h3>
                        <p class="text text-white"  style="margin-bottom:50px;">Exclusive sounds crafted by Meekizmusic producers, ready to ignite your creativity. <br>Hit play and let the rhythm take over.</p>
                        @if(!empty($heroBeat) && $heroBeat->preview_url)
                                <div class="dz-player style-2 m-b30" data-src="{{ htmlspecialchars(url($heroBeat->preview_url)) }}">
                                    <h5 class="title">{{ $heroBeat->title }}</h5>
                                    <button class="dz-play-btn">
                                        <span class="dz-play-btnIco"><i class="fa-solid fa-play"></i></span>
                                    </button>
                                    <button class="dz-play-btn">
                                        <span class="dz-play-btnIco">
                                            <svg class="svg-inline--fa fa-pause" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pause" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"></path></svg>
                                        </span>
                                    </button>
                                    <div class="dzPlayNum">
                                        <span class="dzPlayCurDuration">0:00</span>
                                    </div>
                                    <div class="dz-player-range">
                                        <span class="under-dz-player-ranger"></span>
                                        <input class="dzPlayRange w-100" type="range" min="0" value="0" step="1" max="251">
                                        <span class="change-dz-player-range"></span>
                                    </div>
                                    <div class="dzPlayNum">
                                        <span class="dzPlayDuration">{{ $heroBeat->duration }}</span>
                                    </div>
                                    <div class="dz-volume-container">
                                        <span class="dzPlayerVolIcon"><i class="fa fa-volume-up"></i></span>
                                        <div class="dz-player-range-volume">
                                            <span class="under-dz-player-ranger"></span>
                                            <input class="dzPlayVol" type="range" min="0" max="1" value="1" step="0.1">
                                            <span class="change-dz-player-range"></span>
                                        </div>
                                    </div>
                                </div>
                            @endif
	
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="dvd-box" style="">
                        <img src="assets/images/dvd.png" alt="">
                    </div>	
                </div>		
            </div>
        </div>
    </div>
<div class="main-bnr-three">
    <div class="dz-search-area">
        <div class="container">
            <form class="header-item-search" action="{{ route('marketplace.index') }}" method="GET">
                <div class="input-group search-input">
                    <div class="dropdown bootstrap-select default-select"><select class="default-select" tabindex="null">
                        <option>All Genres</option>
                        @foreach($genres as $genre)
                        <option>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    
                    <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="All Genres">
                        <div class="filter-option">
                            <div class="filter-option-inner">
                                <div class="filter-option-inner-inner">All Genres</div>
                            </div> 
                        </div>
                    </button>
                    <div class="dropdown-menu" style="max-height: 849px; overflow: hidden; min-height: 114px;">
                        <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-activedescendant="bs-select-1-0" style="max-height: 831px; overflow: hidden auto; min-height: 96px;">
                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                <li class="selected active">
                                    <a role="option" class="dropdown-item selected active" id="bs-select-1-0" tabindex="0" aria-setsize="5" aria-posinset="1" aria-selected="true">
                                        <span class="text">All Genres</span>
                                    </a>
                                </li>
                                @foreach($genres as $genre)
                                <li>
                                    <a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0">
                                        <span class="text">{{ $genre->name }}</span>
                                    </a>
                                </li>
                                @endforeach
                                

                                    </ul></div></div>
                    </div>
                    <input type="search" name="search" class="form-control" aria-label="Text input with dropdown button" placeholder="Search Beat">
                    <button class="btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                          <g clip-path="url(#clip0_1362_3437)">
                            <path d="M16.4562 15.4843L12.4102 11.2762C13.4505 10.0396 14.0205 8.48359 14.0205 6.86374C14.0205 3.07913 10.9413 0 7.15671 0C3.3721 0 0.292969 3.07913 0.292969 6.86374C0.292969 10.6484 3.3721 13.7275 7.15671 13.7275C8.57751 13.7275 9.93145 13.299 11.089 12.4854L15.1658 16.7255C15.3362 16.9024 15.5654 17 15.811 17C16.0435 17 16.264 16.9114 16.4314 16.7502C16.7871 16.4079 16.7985 15.8403 16.4562 15.4843ZM7.15671 1.79054C9.95413 1.79054 12.2299 4.06632 12.2299 6.86374C12.2299 9.66117 9.95413 11.9369 7.15671 11.9369C4.35929 11.9369 2.08351 9.66117 2.08351 6.86374C2.08351 4.06632 4.35929 1.79054 7.15671 1.79054Z" fill="#000"></path>
                          </g>
                          <defs>
                            <clipPath id="clip0_1362_3437">
                              <rect width="17" height="17" fill="white"></rect>
                            </clipPath>
                          </defs>
                        </svg>
                    </button>
                </div>
                <ul class="recent-tag">
                    <li class="pe-0"><span>Quick Search :</span></li>
                @if($adminSettings && $adminSettings->quick_search)
                        @foreach($adminSettings->quick_search as $word)
                        <li><a href="{{ route('marketplace.index', ['search' => $word]) }}">{{ $word }}</a></li>
                        @endforeach
                @endif
                </ul>
            </form>




            <div class="row">
                <div class="col-xl-12">
                    <h3 class="mb-3">Featured Beats</h3>
                    <div class="swiper category-swiper2">
                        <div class="swiper-wrapper">
                            @foreach($featuredBeats as $beat)
                            <div class="swiper-slide col-6 col-lg-3 col-md-3">
                                    <x-beatcolumn :beat="$beat" colClass="col-12" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
    
    <section class="content-inner overflow-hidden">
        <div class="container">
            <div class="d-lg-flex  d-block align-items-end border-bottom m-b30">
                <div class="section-head  style-1 m-0 flex-1 text-center text-xl-start">
                    <h5 class="sub-title wow flipInX" data-wow-delay="0.2s">Latest Releases</h5>
                    <h2 class="title wow flipInX" data-wow-delay="0.4s">Latest Releases</h2>
                </div>
                <div class="m-b30 text-center text-xl-end">
                    <a href="/marketplace" class="btn-link btn-gradient wow flipInX" data-wow-delay="0.6s">VIEW ALL BEATS</a>
                </div>
            </div>
            <div class="row">
                @forelse($latestBeat as $beat)
                    <x-beatcolumn :beat="$beat" colClass="col-6 col-lg-3 col-md-3" />
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No beats found. Please try different filters.
                        </div>
                    </div>
                @endforelse

            </div>
        </div>	
    </section>
    <!-- about section -->	
    <section class="content-inner-2 pt-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-12 p-lr10 m-b30">
                            <div class="dz-media wow fadeInUp split-box" data-wow-delay="0.2s">
                                <img src="assets/images/about/welcome.webp" alt="/">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 p-lg-l30" data-wow-delay="0.2s">
                    <div class="about-box style-3 wow fadeInUp">
                        <h6 class="sub-title" style="color: black">Welcome to Meekizmusic</h6>
                        <h5 class="title">Where Beats Come Alive!</h5>
                        <p class="text">At Meekizmusic, we don't just create beats — we craft experiences. Every sound is designed to spark inspiration, elevate your artistry, and amplify your unique sound. Whether you're a seasoned artist or just starting out, our exclusive catalog has the perfect rhythm for your next project. No middlemen, no recycled tracks — just original sounds made by passionate producers.</p>

                        <p> Find your sound. Make it yours.</p>
                        <a href="/marketplace" class="btn btn-dark btn-hover-1 rounded-0 m-b20"><span>Explore</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section -->	
    <!--countdown section-->
    <section class="section-wrapper-5 content-inner overflow-hidden bg-parallax" style="background-image:url('assets/images/background/pic1.png'); background-attachment: fixed;">
        <div class="container">
            <div class="section-head  text-center">
                <h3 class="sub-title text-white wow flipInX" data-wow-delay="0.2s">Next Vibe Drops In</h3>
                <h2 class="title text-white wow flipInX" data-wow-delay="0.4s">Counting down to the freshest sounds from Meekizmusic.</h2>
                <h3 class="text-white wow flipInX" data-wow-delay="0.2s">Stay Tuned!</h3>
            </div>	
            <div class="countdown-row">
                <div class="countdown style-1" data-launch-date="{{ \Carbon\Carbon::parse($adminSettings?->next_beat_release)->format('Y/m/d H:i:s') }}">
                    <div class="date">
                        <span class="time" id="day">00</span>
                        <span class="text"> Days</span>
                    </div>
                    <div class="date">
                        <span class="time" id="hour">00</span>
                        <span class="text">Hours</span>
                    </div>
                    <div class="date">
                        <span class="time" id="min">00</span>
                        <span class="text">Minutes</span>
                    </div>
                    <div class="date">
                        <div class="time lost" id="second">00</div>
                        <span class="text">Seconds</span>
                    </div>
                </div>
            </div>
            <div class="text-center"> 
                <a href="{{ route('marketplace.index') }}" class="btn btn-white btn-hover-1 rounded-0 text-center"><span>EXPLORE</span></a>
            </div>
        </div>
    </section>
    <!--countdown section-->
    
    @push('scripts')
    @endpush
		
        
</div>
@endsection
@section('footerscript')
@endsection