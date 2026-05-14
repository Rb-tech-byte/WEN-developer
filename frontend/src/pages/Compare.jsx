import React, { useState, useEffect } from 'react';
import { useSearchParams } from 'react-router-dom';
import MicWavePlayer from '../components/MicWavePlayer';
import './Compare.css';

const demoMics = [
  { id: 1, name: 'Shure SM7B', slug: 'shure-sm7b', brand: 'Shure', mic_type: 'Dynamic', price: 399, thumbnail: '' },
  { id: 2, name: 'Rode NT1 5th Gen', slug: 'rode-nt1-5th-gen', brand: 'Rode', mic_type: 'Condenser', price: 279, thumbnail: '' },
  { id: 3, name: 'Audio-Technica AT2020', slug: 'audio-technica-at2020', brand: 'Audio-Technica', mic_type: 'Condenser', price: 149, thumbnail: '' },
  { id: 4, name: 'AKG C414 XLII', slug: 'akg-c414-xlii', brand: 'AKG', mic_type: 'Condenser', price: 1299, thumbnail: '' },
  { id: 5, name: 'Neumann U87 Ai', slug: 'neumann-u87-ai', brand: 'Neumann', mic_type: 'Condenser', price: 3990, thumbnail: '' },
  { id: 6, name: 'Sennheiser MD 421', slug: 'sennheiser-md-421', brand: 'Sennheiser', mic_type: 'Dynamic', price: 399, thumbnail: '' },
  { id: 7, name: 'Blue Ember', slug: 'blue-ember', brand: 'Blue', mic_type: 'Condenser', price: 169, thumbnail: '' },
  { id: 8, name: 'Warm Audio WA-47jr', slug: 'warm-audio-wa-47jr', brand: 'Warm Audio', mic_type: 'Condenser', price: 299, thumbnail: '' },
  { id: 9, name: 'Lewitt MTP 550 DM', slug: 'lewitt-mtp-550-dm', brand: 'Lewitt', mic_type: 'Dynamic', price: 259, thumbnail: '' },
  { id: 10, name: 'Shure SM58', slug: 'shure-sm58', brand: 'Shure', mic_type: 'Dynamic', price: 99, thumbnail: '' }
];

const audioTests = [
  { test_type: 'male_voice', label: 'Male Voice' },
  { test_type: 'female_voice', label: 'Female Voice' },
  { test_type: 'podcast', label: 'Podcast' },
  { test_type: 'guitar', label: 'Guitar' },
  { test_type: 'drum', label: 'Drums' }
];

const Compare = () => {
  const [searchParams] = useSearchParams();
  const [selectedMics, setSelectedMics] = useState([]);
  const [syncPlay, setSyncPlay] = useState(false);
  const [isPlaying, setIsPlaying] = useState(false);

  useEffect(() => {
    const ids = searchParams.get('ids');
    if (ids) {
      const idArray = ids.split(',').map(Number);
      const selected = demoMics.filter(m => idArray.includes(m.id));
      setSelectedMics(selected);
    }
  }, [searchParams]);

  const handleMicSelect = (index, micId) => {
    const mic = demoMics.find(m => m.id === parseInt(micId));
    const newSelected = [...selectedMics];
    
    if (mic) {
      newSelected[index] = mic;
      setSelectedMics(newSelected.filter(Boolean));
    }
  };

  const removeMic = (index) => {
    const newSelected = [...selectedMics];
    newSelected.splice(index, 1);
    setSelectedMics(newSelected.filter(Boolean));
  };

  const formatPrice = (price) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 0
    }).format(price);
  };

  return (
    <div className="compare-page">
      <div className="container">
        <header className="page-header">
          <h1>Compare Microphones</h1>
          <p className="text-gray">Select up to 4 microphones to compare side by side</p>
        </header>

        {/* Mic Selectors */}
        <div className="compare-selectors">
          {[0, 1, 2, 3].map((index) => (
            <div key={index} className="compare-selector">
              <label>Mic {String.fromCharCode(65 + index)}</label>
              <select 
                className="select"
                value={selectedMics[index]?.id || ''}
                onChange={(e) => handleMicSelect(index, e.target.value)}
              >
                <option value="">Select a microphone</option>
                {demoMics.map(mic => (
                  <option 
                    key={mic.id} 
                    value={mic.id}
                    disabled={selectedMics.some(s => s.id === mic.id) && selectedMics[index]?.id !== mic.id}
                  >
                    {mic.name}
                  </option>
                ))}
              </select>
            </div>
          ))}
        </div>

        {/* Compare Cards */}
        {selectedMics.length > 0 && (
          <>
            <div className="compare-cards">
              {selectedMics.map((mic, index) => (
                <div key={index} className="compare-card">
                  <button 
                    className="remove-mic-btn"
                    onClick={() => removeMic(index)}
                  >
                    ×
                  </button>
                  
                  <div className="compare-card-image">
                    <div className="mic-image-placeholder">
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
                        <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
                      </svg>
                    </div>
                  </div>
                  
                  <div className="compare-card-info">
                    <span className="compare-card-brand">{mic.brand}</span>
                    <h3>{mic.name}</h3>
                    <div className="compare-card-price">{formatPrice(mic.price)}</div>
                  </div>

                  {/* Audio Tests for Comparison */}
                  <div className="compare-audio-tests">
                    {audioTests.map((test) => (
                      <MicWavePlayer 
                        key={test.test_type}
                        audioFile={`/uploads/mic-tests/audio/${mic.slug}-${test.test_type}.mp3`}
                        label={test.label}
                        testType={test.test_type}
                        height={60}
                      />
                    ))}
                  </div>
                </div>
              ))}
            </div>

            {/* Playback Controls */}
            <div className="playback-controls">
              <button 
                className="btn btn-primary"
                onClick={() => setIsPlaying(!isPlaying)}
              >
                {isPlaying ? 'Pause All' : 'Play All'}
              </button>
              
              <label className="sync-toggle">
                <input 
                  type="checkbox"
                  checked={syncPlay}
                  onChange={(e) => setSyncPlay(e.target.checked)}
                />
                <span>Sync Play</span>
                <span className="sync-hint">All audio starts simultaneously</span>
              </label>
            </div>
          </>
        )}

        {selectedMics.length === 0 && (
          <div className="empty-compare">
            <h3>Select microphones to compare</h3>
            <p>Use the dropdowns above to select up to 4 microphones</p>
          </div>
        )}

        {/* Headphones Warning */}
        <div className="headphones-warning">
          <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
            <path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-3v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/>
          </svg>
          <span>Use headphones for best comparison experience</span>
        </div>
      </div>
    </div>
  );
};

export default Compare;