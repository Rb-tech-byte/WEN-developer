import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MicWavePlayer from '../components/MicWavePlayer';
import './MicDetails.css';

const demoMicDetails = {
  'shure-sm7b': {
    id: 1,
    name: 'Shure SM7B',
    slug: 'shure-sm7b',
    brand: 'Shure',
    mic_type: 'Dynamic',
    price: 399,
    short_description: 'The industry standard for broadcast and podcasting',
    full_description: 'The Shure SM7B is a legendary microphone that has been the go-to choice for professional broadcasters, podcasters, and voice-over artists for decades. Its smooth, flat, wide-range frequency response accommodates both music and speech, and includes a bass rolloff and presence boost controls. The cardioid pickup pattern isolates the sound source while minimizing background noise, making it ideal for untreated rooms.',
    frequency_response: '50Hz - 20kHz',
    polar_pattern: 'Cardioid',
    connectivity: 'XLR',
    impedance: '310 ohms',
    external_url: 'https://www.shure.com/en-US/products/microphones/sm7b',
    thumbnail: '',
    audio_tests: [
      { id: 1, test_type: 'male_voice', label: 'Male Voice Test', file: '/uploads/mic-tests/audio/shure-sm7b-male.mp3', duration: 15.0 },
      { id: 2, test_type: 'female_voice', label: 'Female Voice Test', file: '/uploads/mic-tests/audio/shure-sm7b-female.mp3', duration: 15.0 },
      { id: 3, test_type: 'podcast', label: 'Podcast Test', file: '/uploads/mic-tests/audio/shure-sm7b-podcast.mp3', duration: 20.0 },
      { id: 4, test_type: 'guitar', label: 'Acoustic Guitar', file: '/uploads/mic-tests/audio/shure-sm7b-guitar.mp3', duration: 10.0 },
      { id: 5, test_type: 'drum', label: 'Drum Overhead', file: '/uploads/mic-tests/audio/shure-sm7b-drum.mp3', duration: 8.0 }
    ],
    featured: 1,
    status: 'active'
  },
  'rode-nt1-5th-gen': {
    id: 2,
    name: 'Rode NT1 5th Gen',
    slug: 'rode-nt1-5th-gen',
    brand: 'Rode',
    mic_type: 'Condenser',
    price: 279,
    short_description: 'Ultra-quiet cardioid condenser microphone',
    full_description: 'The Rode NT1 5th Gen is the latest iteration of Rode\'s iconic NT1 studio microphone. It features a revolutionary new capsule design with a gold-sputtered diaphragm, incredibly low self-noise of just 4dBA, and premium build quality. Perfect for professional studio recording.',
    frequency_response: '20Hz - 20kHz',
    polar_pattern: 'Cardioid',
    connectivity: 'XLR',
    impedance: '10 ohms',
    external_url: 'https://rode.com/microphones/nt1',
    thumbnail: '',
    audio_tests: [
      { id: 6, test_type: 'male_voice', label: 'Male Voice Test', file: '/uploads/mic-tests/audio/rode-nt1-male.mp3', duration: 15.0 },
      { id: 7, test_type: 'female_voice', label: 'Female Voice Test', file: '/uploads/mic-tests/audio/rode-nt1-female.mp3', duration: 15.0 },
      { id: 8, test_type: 'podcast', label: 'Podcast Test', file: '/uploads/mic-tests/audio/rode-nt1-podcast.mp3', duration: 20.0 },
      { id: 9, test_type: 'guitar', label: 'Acoustic Guitar', file: '/uploads/mic-tests/audio/rode-nt1-guitar.mp3', duration: 10.0 },
      { id: 10, test_type: 'drum', label: 'Drum Overhead', file: '/uploads/mic-tests/audio/rode-nt1-drum.mp3', duration: 8.0 }
    ],
    featured: 1,
    status: 'active'
  }
};

const MicDetails = () => {
  const { slug } = useParams();
  const [mic, setMic] = useState(null);
  const [loading, setLoading] = useState(true);
  const [compareList, setCompareList] = useState([]);

  useEffect(() => {
    // Simulate API fetch
    setTimeout(() => {
      const micData = demoMicDetails[slug] || demoMicDetails['shure-sm7b'];
      setMic(micData);
      setLoading(false);
    }, 300);
  }, [slug]);

  const formatPrice = (price) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 0
    }).format(price);
  };

  const handleCompare = () => {
    if (compareList.includes(mic.id)) {
      setCompareList(compareList.filter(c => c !== mic.id));
    } else if (compareList.length < 4) {
      setCompareList([...compareList, mic.id]);
    }
  };

  if (loading) {
    return (
      <div className="mic-details-page">
        <div className="container">
          <div className="mic-details-skeleton skeleton" />
        </div>
      </div>
    );
  }

  if (!mic) {
    return (
      <div className="mic-details-page">
        <div className="container">
          <div className="not-found">
            <h2>Microphone not found</h2>
            <Link to="/mic-test/all" className="btn btn-primary">Browse All Mics</Link>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="mic-details-page">
      <div className="container container-sm">
        <nav className="breadcrumb">
          <Link to="/mic-test">Mic Test Lab</Link>
          <span>/</span>
          <Link to="/mic-test/all">All Mics</Link>
          <span>/</span>
          <span>{mic.name}</span>
        </nav>

        <div className="mic-details-grid">
          <div className="mic-details-image">
            <div className="mic-image-placeholder">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
                <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
              </svg>
            </div>
            {mic.featured === 1 && <span className="featured-badge">Featured</span>}
          </div>

          <div className="mic-details-info">
            <div className="mic-info-header">
              <span className="mic-brand">{mic.brand}</span>
              <span className="mic-type">{mic.mic_type}</span>
            </div>
            
            <h1>{mic.name}</h1>
            
            <div className="mic-price">{formatPrice(mic.price)}</div>
            
            <p className="mic-short-description">{mic.short_description}</p>
            
            <p className="mic-full-description">{mic.full_description}</p>

            <div className="mic-specs">
              <h3>Specifications</h3>
              <div className="specs-grid">
                <div className="spec-item">
                  <span className="spec-label">Frequency Response</span>
                  <span className="spec-value">{mic.frequency_response}</span>
                </div>
                <div className="spec-item">
                  <span className="spec-label">Polar Pattern</span>
                  <span className="spec-value">{mic.polar_pattern}</span>
                </div>
                <div className="spec-item">
                  <span className="spec-label">Connectivity</span>
                  <span className="spec-value">{mic.connectivity}</span>
                </div>
                <div className="spec-item">
                  <span className="spec-label">Impedance</span>
                  <span className="spec-value">{mic.impedance}</span>
                </div>
              </div>
            </div>

            <div className="mic-actions">
              <button 
                className={`btn btn-secondary ${compareList.includes(mic.id) ? 'active' : ''}`}
                onClick={handleCompare}
              >
                {compareList.includes(mic.id) ? 'Added to Compare' : 'Add to Compare'}
              </button>
              {mic.external_url && (
                <a 
                  href={mic.external_url} 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="btn btn-ghost"
                >
                  Visit Website
                </a>
              )}
            </div>
          </div>
        </div>

        {/* Audio Tests Section */}
        <section className="audio-tests-section">
          <h2>Audio Tests</h2>
          <p className="section-description">
            Listen to recordings from the same source material to hear the microphone's true character
          </p>
          
          <div className="headphones-warning">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
              <path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-3v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/>
            </svg>
            <span>Use headphones for best listening experience</span>
          </div>

          <div className="audio-tests-list">
            {mic.audio_tests?.map((test) => (
              <MicWavePlayer 
                key={test.id}
                audioFile={test.file}
                label={test.label}
                testType={test.test_type}
                color="#7C3AED"
                progressColor="#C084FC"
              />
            ))}
          </div>
        </section>

        <div className="page-footer">
          <Link to="/mic-test/all" className="btn btn-ghost">
            ← Back to All Mics
          </Link>
        </div>
      </div>
    </div>
  );
};

export default MicDetails;