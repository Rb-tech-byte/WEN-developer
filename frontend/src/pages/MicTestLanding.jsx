import React from 'react';
import HeroSection from '../components/HeroSection';
import MicCard from '../components/MicCard';
import { Link } from 'react-router-dom';
import './MicTestLanding.css';

const MicTestLanding = () => {
  const stats = [
    { value: '48+', label: 'Microphones' },
    { value: '250+', label: 'Sound Tests' },
    { value: '10K+', label: 'Users' },
    { value: '99%', label: 'Satisfaction' }
  ];

  const features = [
    {
      icon: (
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
          <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
          <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
        </svg>
      ),
      title: 'Real Studio Tests',
      description: 'Recordings from professional studios with consistent source audio'
    },
    {
      icon: (
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
          <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
        </svg>
      ),
      title: 'High Quality Audio',
      description: ' WAV & MP3 recordings at studio quality'
    },
    {
      icon: (
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
          <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm0 6h4v-4h-4v4zm6-6h4V4h-4v4z"/>
        </svg>
      ),
      title: 'Compare Side by Side',
      description: 'Up to 4 microphones synchronized playback'
    },
    {
      icon: (
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
          <path d="M20 8.69V4h-4.69L12 .69 8.69 4H4v4.69L.69 12 4 15.31V20h4.69L12 23.31 15.31 20H20v-4.69L23.31 12 20 8.69zM12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"/>
        </svg>
      ),
      title: 'Use Headphones',
      description: 'Premium audio for best listening experience'
    }
  ];

  return (
    <div className="mic-test-landing">
      <HeroSection 
        title="MIC TEST LAB"
        subtitle="Listen to recorded sound tests and compare microphones side by side to find your perfect mic."
        stats={stats}
        features={features}
      />

      {/* CTA Section */}
      <section className="section">
        <div className="container">
          <div className="cta-section">
            <h2>Ready to find your perfect mic?</h2>
            <p className="text-gray">
              Browse our collection of professional microphones with real studio recordings.
            </p>
            <div className="cta-actions">
              <Link to="/mic-test/all" className="btn btn-primary btn-lg">
                Browse All Mics
              </Link>
              <Link to="/mic-test/compare" className="btn btn-secondary btn-lg">
                Compare Mics
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Headphones Warning */}
      <div className="container" style={{ marginBottom: '2rem' }}>
        <div className="headphones-warning">
          <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
            <path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-3v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/>
            <path d="M11 7h2v6h-2z"/>
            <path d="M11 15h2v2h-2z"/>
          </svg>
          <span>Use headphones for the best audio comparison experience</span>
        </div>
      </div>
    </div>
  );
};

export default MicTestLanding;