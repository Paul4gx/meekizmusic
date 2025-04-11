class AudioPlayer {
    constructor() {
        this.sounds = {};
        this.currentSound = null;
        this.currentBeatId = null;
        this.isPlaying = false;
        this.initializeUI();
    }

    initializeUI() {
        // Create floating player container
        const playerContainer = document.createElement('div');
        playerContainer.id = 'global-audio-player';
        playerContainer.innerHTML = `
            <div class="player-content">
                <div class="player-info">
                    <img id="current-beat-cover" src="" alt="Beat Cover" class="beat-cover">
                    <div class="beat-details">
                        <div id="current-beat-title" class="beat-title"></div>
                        <div id="current-beat-artist" class="beat-artist"></div>
                    </div>
                </div>
                <div class="player-controls">
                    <button id="play-pause-btn" class="btn btn-primary">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress"></div>
                        </div>
                        <div class="time-display">
                            <span id="current-time">0:00</span> / <span id="total-time">0:30</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(playerContainer);

        // Add styles
        const styles = document.createElement('style');
        styles.textContent = `
            #global-audio-player {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                padding: 15px;
                width: 300px;
                z-index: 1000;
            }

            .player-content {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .player-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .beat-cover {
                width: 50px;
                height: 50px;
                border-radius: 5px;
                object-fit: cover;
            }

            .beat-details {
                flex: 1;
            }

            .beat-title {
                font-weight: bold;
                margin-bottom: 2px;
            }

            .beat-artist {
                font-size: 0.9em;
                color: #666;
            }

            .player-controls {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .progress-container {
                flex: 1;
            }

            .progress-bar {
                height: 4px;
                background: #eee;
                border-radius: 2px;
                cursor: pointer;
                position: relative;
            }

            .progress {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                background: #007bff;
                border-radius: 2px;
                width: 0%;
            }

            .time-display {
                font-size: 0.8em;
                color: #666;
                margin-top: 2px;
            }
        `;
        document.head.appendChild(styles);

        // Initialize event listeners
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        const playPauseBtn = document.getElementById('play-pause-btn');
        const progressBar = document.querySelector('.progress-bar');

        playPauseBtn.addEventListener('click', () => this.togglePlayPause());
        progressBar.addEventListener('click', (e) => this.seekTo(e));
    }

    loadBeat(beatId, previewUrl, title, artist, coverUrl) {
        // Stop current beat if playing
        if (this.currentSound) {
            this.currentSound.stop();
            this.isPlaying = false;
        }

        // Update UI with new beat info
        document.getElementById('current-beat-title').textContent = title;
        document.getElementById('current-beat-artist').textContent = artist;
        document.getElementById('current-beat-cover').src = coverUrl;
        document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-play"></i>';

        // Create new Howler instance
        this.currentSound = new Howl({
            src: [previewUrl],
            html5: true,
            onload: () => {
                this.currentBeatId = beatId;
                this.updateProgress();
            },
            onend: () => {
                this.isPlaying = false;
                document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-play"></i>';
            }
        });
    }

    togglePlayPause() {
        if (!this.currentSound) return;

        if (this.isPlaying) {
            this.currentSound.pause();
            document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-play"></i>';
        } else {
            this.currentSound.play();
            document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-pause"></i>';
        }

        this.isPlaying = !this.isPlaying;
    }

    seekTo(e) {
        if (!this.currentSound) return;

        const progressBar = document.querySelector('.progress-bar');
        const rect = progressBar.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const percentage = x / rect.width;
        const seekTime = percentage * 30; // 30 seconds total

        this.currentSound.seek(seekTime);
    }

    updateProgress() {
        if (!this.currentSound || !this.isPlaying) return;

        const currentTime = this.currentSound.seek();
        const percentage = (currentTime / 30) * 100; // 30 seconds total

        document.querySelector('.progress').style.width = `${percentage}%`;
        document.getElementById('current-time').textContent = this.formatTime(currentTime);

        requestAnimationFrame(() => this.updateProgress());
    }

    formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }
}

// Initialize the audio player
const audioPlayer = new AudioPlayer();

// Make it globally available
window.audioPlayer = audioPlayer; 