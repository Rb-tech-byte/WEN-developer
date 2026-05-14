import React from 'react';
import { Link } from 'react-router-dom';
import './HeroSection.css';

const HeroSection = ({ 
  title = "MIC TEST LAB",
  subtitle = "Listen to recorded sound tests and compare microphones.",
  stats = [],
  features = []
}) => {
  return (
    <section className="hero-section">
      <div className="hero-background">
        <div className="hero-waveform-bg">
          {[...Array(30)].map((_, i) => (
            <span 
              key={i} 
              className="waveform-bar"
              style={{
                left: `${i * 3.5}%`,
                animationDelay: `${i * 0.1}s`,
                height: `${20 + Math.random() * 60}%`
              }}
            />
          ))}
        </div>
      </div>
      
      <div className="hero-content container">
        <div className="hero-text">
          <h1 className="hero-title">{title}</h1>
          <p className="hero-subtitle">{subtitle}</p>
          
          <div className="hero-actions">
            <Link to="/mic-test/all" className="btn btn-primary btn-lg">
              Browse All Mics
            </Link>
            <Link to="/mic-test/compare" className="btn btn-secondary btn-lg">
              Compare Mics
            </Link>
          </div>
        </div>
        
        {stats.length > 0 && (
          <div className="hero-stats">
            {stats.map((stat, index) => (
              <div key={index} className="hero-stat">
                <div className="hero-stat-value">{stat.value}</div>
                <div className="hero-stat-label">{stat.label}</div>
              </div>
            ))}
          </div>
        )}
      </div>
      
      {features.length > 0 && (
        <div className="hero-features">
          <div className="container">
            <div className="features-grid">
              {features.map((feature, index) => (
                <div key={index} className="feature-card">
                  <div className="feature-icon">
                    {feature.icon}
                  </div>
                  <h3 className="feature-title">{feature.title}</h3>
                  <p className="feature-description">{feature.description}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      )}
    </section>
  );
};

export default HeroSection;