import React, { useEffect, useRef, useState } from 'react';
import WaveSurfer from 'wavesurfer.js';
import './MicWavePlayer.css';

const MicWavePlayer = ({ 
  audioFile, 
  label, 
  testType,
  color = '#7C3AED',
  progressColor = '#C084FC',
  height = 80,
  waveRadius = 2
}) => {
  const containerRef = useRef(null);
  const wavesurferRef = useRef(null);
  const [isPlaying, setIsPlaying] = useState(false);
  const [isReady, setIsReady] = useState(false);
  const [currentTime, setCurrentTime] = useState(0);
  const [duration, setDuration] = useState(0);

  useEffect(() => {
    if (!containerRef.current || !audioFile) return;

    // Destroy previous instance
    if (wavesurferRef.current) {
      wavesurferRef.current.destroy();
    }

    const wavesurfer = WaveSurfer.create({
      container: containerRef.current,
      waveColor: color,
      progressColor: progressColor,
      cursorColor: 'transparent',
      barWidth: 2,
      barGap: 1,
      barRadius: waveRadius,
      height: height,
      normalize: true,
      backend: 'WebAudio',
      mediaControls: false,
      interact: true,
      hideScrollbar: true,
    });

    // For demo, we'll use a placeholder since real audio files aren't available
    // In production, you would load the actual audio file
    const demoOptions = {
      url: audioFile,
      waveColor: color,
      progressColor: progressColor,
      height: height,
    };

    wavesurfer.load(audioFile);

    wavesurfer.on('ready', () => {
      setIsReady(true);
      setDuration(wavesurfer.getDuration());
    });

    wavesurfer.on('audioprocess', () => {
      setCurrentTime(wavesurfer.getCurrentTime());
    });

    wavesurfer.on('seeking', () => {
      setCurrentTime(wavesurfer.getCurrentTime());
    });

    wavesurfer.on('finish', () => {
      setIsPlaying(false);
      setCurrentTime(0);
    });

    wavesurfer.on('play', () => {
      setIsPlaying(true);
    });

    wavesurfer.on('pause', () => {
      setIsPlaying(false);
    });

    wavesurferRef.current = wavesurfer;

    return () => {
      if (wavesurferRef.current) {
        wavesurferRef.current.destroy();
      }
    };
  }, [audioFile, color, progressColor, height, waveRadius]);

  const togglePlay = () => {
    if (wavesurferRef.current) {
      wavesurferRef.current.playPause();
    }
  };

  const formatTime = (time) => {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
  };

  return (
    <div className="mic-wave-player">
      <div className="mic-wave-player-header">
        <span className="mic-wave-player-label">{label}</span>
        <span className="mic-wave-player-type">{testType}</span>
      </div>
      
      <div className="mic-wave-player-waveform">
        <div 
          ref={containerRef} 
          className="mic-wave-player-container"
        />
        
        {!isReady && audioFile && (
          <div className="mic-wave-player-loading">
            <div className="waveform-bars">
              {[...Array(20)].map((_, i) => (
                <span 
                  key={i} 
                  style={{ 
                    animationDelay: `${i * 0.1}s`,
                    background: color
                  }} 
                />
              ))}
            </div>
          </div>
        )}
      </div>
      
      <div className="mic-wave-player-controls">
        <button 
          className="mic-wave-player-play-btn"
          onClick={togglePlay}
          disabled={!isReady}
        >
          {isPlaying ? (
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
            </svg>
          ) : (
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M8 5v14l11-7z"/>
            </svg>
          )}
        </button>
        
        <div className="mic-wave-player-time">
          <span className="mic-wave-player-current">{formatTime(currentTime)}</span>
          <span className="mic-wave-player-separator">/</span>
          <span className="mic-wave-player-duration">{formatTime(duration)}</span>
        </div>
      </div>
    </div>
  );
};

export default MicWavePlayer;