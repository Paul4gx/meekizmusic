<!-- Audio Player Modal -->
<div class="modal fade" id="audioPlayerModal" tabindex="-1" aria-labelledby="audioPlayerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="audioPlayerModalLabel">Beat Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="previewCover" src="" alt="Beat Cover" class="img-fluid rounded" style="max-height: 200px;">
                    <h6 id="previewTitle" class="mt-2"></h6>
                    <p id="previewArtist" class="text-muted"></p>
                </div>
                <div class="audio-player">
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div class="time">
                            <span class="current">0:00</span>
                            <span class="duration">0:00</span>
                        </div>
                    </div>
                    <div class="controls">
                        <button class="btn btn-link" id="playPauseBtn">
                            <i class="fas fa-play"></i>
                        </button>
                        <div class="volume-container">
                            <button class="btn btn-link" id="muteBtn">
                                <i class="fas fa-volume-up"></i>
                            </button>
                            <div class="volume-slider">
                                <input type="range" id="volumeSlider" min="0" max="1" step="0.1" value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.audio-player {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.progress-container {
    margin-bottom: 15px;
}

.progress {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    cursor: pointer;
    margin-bottom: 5px;
}

.progress-bar {
    background: #0d6efd;
    border-radius: 3px;
}

.time {
    display: flex;
    justify-content: space-between;
    font-size: 0.875rem;
    color: #6c757d;
}

.controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.controls .btn-link {
    color: #0d6efd;
    text-decoration: none;
    font-size: 1.25rem;
}

.volume-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.volume-slider {
    width: 100px;
}

.volume-slider input[type="range"] {
    width: 100%;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    let sound = null;
    let isPlaying = false;
    let progressInterval = null;

    const modal = new bootstrap.Modal(document.getElementById('audioPlayerModal'));
    const playPauseBtn = $('#playPauseBtn');
    const muteBtn = $('#muteBtn');
    const volumeSlider = $('#volumeSlider');
    const progressBar = $('.progress-bar');
    const progressContainer = $('.progress');
    const currentTime = $('.current');
    const durationTime = $('.duration');
    const previewCover = $('#previewCover');
    const previewTitle = $('#previewTitle');
    const previewArtist = $('#previewArtist');

    // Add click event listeners to all preview buttons
    $('.preview-btn').on('click', function() {
        const previewUrl = $(this).data('preview-url');
        const title = $(this).data('title');
        const artist = $(this).data('artist');
        const cover = $(this).data('cover');

        // Stop any currently playing sound
        if (sound) {
            sound.stop();
            sound.unload();
            clearInterval(progressInterval);
        }

        // Create new Howler sound
        sound = new Howl({
            src: [previewUrl],
            html5: true,
            onload: function() {
                durationTime.text(formatTime(sound.duration()));
            },
            onplay: function() {
                isPlaying = true;
                playPauseBtn.html('<i class="fas fa-pause"></i>');
                startProgressUpdate();
            },
            onpause: function() {
                isPlaying = false;
                playPauseBtn.html('<i class="fas fa-play"></i>');
                clearInterval(progressInterval);
            },
            onend: function() {
                isPlaying = false;
                playPauseBtn.html('<i class="fas fa-play"></i>');
                clearInterval(progressInterval);
                progressBar.css('width', '0%');
                currentTime.text('0:00');
            }
        });

        // Update UI
        previewCover.attr('src', cover);
        previewTitle.text(title);
        previewArtist.text(artist);

        // Show modal and start playing
        modal.show();
        sound.play();
    });

    // Play/Pause button
    playPauseBtn.on('click', function() {
        if (sound) {
            if (isPlaying) {
                sound.pause();
            } else {
                sound.play();
            }
        }
    });

    // Mute button
    muteBtn.on('click', function() {
        if (sound) {
            sound.mute(!sound.mute());
            muteBtn.html(sound.mute() ? 
                '<i class="fas fa-volume-mute"></i>' : 
                '<i class="fas fa-volume-up"></i>');
        }
    });

    // Volume slider
    volumeSlider.on('input', function() {
        if (sound) {
            sound.volume(this.value);
        }
    });

    // Progress bar
    progressContainer.on('click', function(e) {
        if (sound) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const width = rect.width;
            const percentage = x / width;
            sound.seek(percentage * sound.duration());
        }
    });

    // Update progress bar and time
    function startProgressUpdate() {
        progressInterval = setInterval(function() {
            if (sound && isPlaying) {
                const progress = (sound.seek() / sound.duration()) * 100;
                progressBar.css('width', progress + '%');
                currentTime.text(formatTime(sound.seek()));
            }
        }, 100);
    }

    // Format time
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        seconds = Math.floor(seconds % 60);
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    // Stop audio when modal is closed
    $('#audioPlayerModal').on('hidden.bs.modal', function() {
        if (sound) {
            sound.stop();
            sound.unload();
            sound = null;
            isPlaying = false;
            clearInterval(progressInterval);
            playPauseBtn.html('<i class="fas fa-play"></i>');
            progressBar.css('width', '0%');
            currentTime.text('0:00');
        }
    });
});
</script>
@endpush 