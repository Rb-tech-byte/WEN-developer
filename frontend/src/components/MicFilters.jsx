import React from 'react';
import './MicFilters.css';

const MicFilters = ({ 
  filters, 
  onFilterChange, 
  onSearchChange,
  minPrice,
  maxPrice,
  onMinPriceChange,
  onMaxPriceChange
}) => {
  const { brands = [], types = [] } = filters;

  return (
    <div className="mic-filters">
      <div className="filter-group">
        <h4 className="filter-title">Search</h4>
        <input
          type="text"
          className="input input-search"
          placeholder="Search microphones..."
          onChange={(e) => onSearchChange && onSearchChange(e.target.value)}
        />
      </div>

      <div className="filter-group">
        <h4 className="filter-title">Brand</h4>
        <div className="filter-options">
          {brands.map((brand) => (
            <label key={brand.slug || brand} className="filter-checkbox">
              <input
                type="checkbox"
                onChange={(e) => onFilterChange && onFilterChange('brand', brand.name || brand, e.target.checked)}
              />
              <span>{brand.name || brand}</span>
              {brand.count && <span className="filter-count">({brand.count})</span>}
            </label>
          ))}
        </div>
      </div>

      <div className="filter-group">
        <h4 className="filter-title">Type</h4>
        <div className="filter-options">
          {types.map((type) => (
            <label key={type.slug || type} className="filter-checkbox">
              <input
                type="checkbox"
                onChange={(e) => onFilterChange && onFilterChange('type', type.name || type, e.target.checked)}
              />
              <span>{type.name || type}</span>
              {type.count && <span className="filter-count">({type.count})</span>}
            </label>
          ))}
        </div>
      </div>

      <div className="filter-group">
        <h4 className="filter-title">Price Range</h4>
        <div className="price-range">
          <input
            type="number"
            className="input price-input"
            placeholder="Min"
            value={minPrice || ''}
            onChange={(e) => onMinPriceChange && onMinPriceChange(e.target.value)}
          />
          <span className="price-separator">-</span>
          <input
            type="number"
            className="input price-input"
            placeholder="Max"
            value={maxPrice || ''}
            onChange={(e) => onMaxPriceChange && onMaxPriceChange(e.target.value)}
          />
        </div>
      </div>
    </div>
  );
};

export default MicFilters;