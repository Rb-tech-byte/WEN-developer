import React from 'react';
import { Link } from 'react-router-dom';
import './MicCard.css';

const MicCard = ({ mic, onCompare, isComparing = false }) => {
  const {
    id,
    name,
    slug,
    brand,
    mic_type,
    price,
    short_description,
    thumbnail,
    featured
  } = mic;

  const formatPrice = (price) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 0
    }).format(price);
  };

  return (
    <div className="mic-card">
      <div className="mic-card-image-wrapper">
        {thumbnail ? (
          <img 
            src={thumbnail} 
            alt={name}
            className="mic-card-image"
            loading="lazy"
          />
        ) : (
          <div className="mic-card-placeholder">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s1-.45 1-1V5z"/>
              <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
            </svg>
          </div>
        )}
        {featured === 1 && (
          <span className="mic-card-badge">Featured</span>
        )}
      </div>
      
      <div className="mic-card-body">
        <div className="mic-card-meta">
          <span className="mic-card-brand">{brand}</span>
          <span className="mic-card-type">{mic_type}</span>
        </div>
        
        <Link to={`/mic-test/${slug}`} className="mic-card-title">
          {name}
        </Link>
        
        <p className="mic-card-description">
          {short_description}
        </p>
        
        <div className="mic-card-price">
          {formatPrice(price)}
        </div>
        
        <div className="mic-card-actions">
          <Link to={`/mic-test/${slug}`} className="btn btn-primary btn-sm">
            View Details
          </Link>
          <button 
            className={`btn btn-secondary btn-sm ${isComparing ? 'active' : ''}`}
            onClick={() => onCompare && onCompare(id)}
          >
            {isComparing ? 'Added' : 'Compare'}
          </button>
        </div>
      </div>
    </div>
  );
};

export default MicCard;