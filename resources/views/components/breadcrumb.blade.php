@props(['title', 'content'])
<div class="dz-bnr-inr style-1 dz-bnr-inr-sm" style="background:black">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h2 style="color:white;">{{ strtoupper($title ?? 'Default Title') }}</h2>
            <p>{{ $content }}</p>
        </div>
    </div>
</div>
