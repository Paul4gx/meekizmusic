@props(['beat', 'colClass' => 'col-6 col-md-4 col-sm-6'])

<div class="{{ $colClass }} m-b30">
    <div class="music-box style-1 p-3" style="background:linear-gradient(180deg, {{$beat->color_accent}} 0%, #f8f9fa 100%)" data-image="{{ Storage::url($beat->cover_image) ?? asset('assets/images/shop/product/pic1.png') }}">
        <div class="dz-media">
            <img class="beat-cover" src="{{ Storage::url($beat->cover_image) ?? asset('assets/images/shop/product/pic1.png') }}" alt="{{ $beat->title }}">
        </div>
        <div class="dz-info">
            <h6 class="title"><a href="{{ route('beats.show', $beat) }}">{{ $beat->title }}</a></h6>
            <div class="d-flex align-items-center">
                <span>{{currency_symbol()}}{{ number_format($beat->price, 2) }}</span>
            </div>
            <div class="dz-meta">
                <ul>
                    @foreach($beat->genres as $genre)
                        <li><a href="#">{{ $genre->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="music-player">
            <div class="left-content">
                <span onclick="toggleWishlist(this,{{ $beat->id }})" style="cursor: pointer" class="{{ $beat->inWishlist ? 'heart heart-blast' : 'heart' ?? 'heart' }}"></span>
                @if($beat->is_sold === false)
                <a href="{{ route('beats.show', $beat) }}"><i class="flaticon flaticon-download-circular-button"></i> Buy Now</a>
                @endif
            </div>
            <div class="right-content">
                <div class="player-container">
                    <button class="play-pause play bg-transparent border-0" data-audio="{{$beat->preview_url}}">Play</button>
                </div>
            </div>
        </div>
    </div>
</div>
