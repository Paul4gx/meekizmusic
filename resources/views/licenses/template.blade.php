@php
    $imagePath = public_path('assets/images/logo.png');
    $imageData = base64_encode(file_get_contents($imagePath));
@endphp
<center>
<img src="data:image/png;base64,{{ $imageData }}" 
     alt="Logo" 
     style="display: block; margin: 0 auto; width: 250px; height: auto;">
</center>

<h2 style="text-align: center">Exclusive License Agreement</h2>

<p><strong>Beat Title:</strong> {{ $beat->title }}</p>
<p><strong>Producer:</strong> MeekizMusic</p>
<p><strong>Licensee (Buyer):</strong> {{ auth()->user()->name ?? '____________' }}</p>
<p><strong>Effective Date:</strong> {{ now()->format('F j, Y') }}</p>

<hr>

<h3>Grant of Rights:</h3>
<p>The Producer hereby grants the Licensee an exclusive, non-transferable license to use the Beat titled "{{ $beat->title }}" for the purposes of creating, distributing, performing, and selling new musical recordings that incorporate the Beat, subject to the terms and conditions outlined below.</p>

<h3>Usage Rights:</h3>
<ul>
  <li>Licensee may distribute unlimited copies of the new recording (physical, digital, streaming, etc.).</li>
  <li>Licensee may perform the new recording publicly (live shows, radio, television, social media, etc.).</li>
  <li>Licensee may monetize the new recording through streaming platforms (Spotify, Apple Music, YouTube, etc.).</li>
  <li>Licensee may use the Beat in films, commercials, video games, and other multimedia projects.</li>
</ul>

<h3>Ownership:</h3>
<p>Upon purchase, the Licensee is granted exclusive usage rights; however, the Producer retains original authorship and ownership of the Beat as a composition and sound recording.</p>

<h3>Restrictions:</h3>
<ul>
  <li>The Licensee may not resell, redistribute, transfer, or sublicense the Beat as a standalone product or sample pack.</li>
  <li>The Beat cannot be claimed as the Licensee’s original composition.</li>
  <li>Unauthorized copying, sharing, uploading, or use outside the terms of this license is strictly prohibited and may result in legal action.</li>
</ul>

<h3>Credit:</h3>
<p>Licensee must provide visible and/or audible credit to the Producer in all distributed copies and public performances, as follows:<br>
<strong>Produced by MeekizMusic</strong></p>

<h3>Delivery:</h3>
<p>Upon completion of purchase, Licensee will receive the Beat in high-quality WAV/MP3 format, along with this license agreement.</p>

<h3>Termination:</h3>
<p>This license agreement shall remain in effect indefinitely unless terminated due to breach of the terms and conditions by the Licensee.</p>

<h3>Governing Law:</h3>
<p>This Agreement shall be governed and construed in accordance with the laws of Nigerian Copyright Act., without regard to its conflict of laws principles.</p>

<h3>Signatures:</h3>
<p>Both parties agree to the terms stated above by entering into this agreement through digital or physical signature.</p>

<hr>
<p style="text-align: center;">Digitally Signed by <strong>MeekizMusic Production </strong> — {{ now()->year }}</p>
