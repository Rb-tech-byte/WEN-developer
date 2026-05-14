import React, { useState, useEffect } from 'react';
import MicCard from '../components/MicCard';
import MicFilters from '../components/MicFilters';
import './AllMics.css';

// Demo data - in production, this would come from the API
const demoMics = [
  { id: 1, name: 'Shure SM7B', slug: 'shure-sm7b', brand: 'Shure', mic_type: 'Dynamic', price: 399, short_description: 'The industry standard for broadcast', thumbnail: '', featured: 1 },
  { id: 2, name: 'Rode NT1 5th Gen', slug: 'rode-nt1-5th-gen', brand: 'Rode', mic_type: 'Condenser', price: 279, short_description: 'Ultra-quiet cardioid condenser', thumbnail: '', featured: 1 },
  { id: 3, name: 'Audio-Technica AT2020', slug: 'audio-technica-at2020', brand: 'Audio-Technica', mic_type: 'Condenser', price: 149, short_description: 'Professional side-address condenser', thumbnail: '', featured: 0 },
  { id: 4, name: 'AKG C414 XLII', slug: 'akg-c414-xlii', brand: 'AKG', mic_type: 'Condenser', price: 1299, short_description: 'Legendary multipattern condenser', thumbnail: '', featured: 1 },
  { id: 5, name: 'Neumann U87 Ai', slug: 'neumann-u87-ai', brand: 'Neumann', mic_type: 'Condenser', price: 3990, short_description: 'The classic studio condenser', thumbnail: '', featured: 1 },
  { id: 6, name: 'Sennheiser MD 421', slug: 'sennheiser-md-421', brand: 'Sennheiser', mic_type: 'Dynamic', price: 399, short_description: 'Classic broadcast and recording mic', thumbnail: '', featured: 0 },
  { id: 7, name: 'Blue Ember', slug: 'blue-ember', brand: 'Blue', mic_type: 'Condenser', price: 169, short_description: 'Professional compact condenser', thumbnail: '', featured: 0 },
  { id: 8, name: 'Warm Audio WA-47jr', slug: 'warm-audio-wa-47jr', brand: 'Warm Audio', mic_type: 'Condenser', price: 299, short_description: 'Faithful reproduction of classic 47', thumbnail: '', featured: 0 },
  { id: 9, name: 'Lewitt MTP 550 DM', slug: 'lewitt-mtp-550-dm', brand: 'Lewitt', mic_type: 'Dynamic', price: 259, short_description: 'Compact handheld dynamic', thumbnail: '', featured: 0 },
  { id: 10, name: 'Shure SM58', slug: 'shure-sm58', brand: 'Shure', mic_type: 'Dynamic', price: 99, short_description: 'Industry standard live vocal', thumbnail: '', featured: 0 }
];

const AllMics = () => {
  const [mics, setMics] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filters, setFilters] = useState({
    brands: ['Shure', 'Rode', 'Audio-Technica', 'AKG', 'Neumann', 'Sennheiser', 'Blue', 'Warm Audio', 'Lewitt'],
    types: ['Dynamic', 'Condenser']
  });
  const [selectedBrands, setSelectedBrands] = useState([]);
  const [selectedTypes, setSelectedTypes] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [minPrice, setMinPrice] = useState('');
  const [maxPrice, setMaxPrice] = useState('');
  const [page, setPage] = useState(1);
  const [compareList, setCompareList] = useState([]);

  useEffect(() => {
    // Simulate API fetch
    setTimeout(() => {
      setMics(demoMics);
      setLoading(false);
    }, 500);
  }, []);

  const handleFilterChange = (type, value, checked) => {
    if (type === 'brand') {
      if (checked) {
        setSelectedBrands([...selectedBrands, value]);
      } else {
        setSelectedBrands(selectedBrands.filter(b => b !== value));
      }
    } else if (type === 'type') {
      if (checked) {
        setSelectedTypes([...selectedTypes, value]);
      } else {
        setSelectedTypes(selectedTypes.filter(t => t !== value));
      }
    }
  };

  const filteredMics = mics.filter(mic => {
    if (selectedBrands.length > 0 && !selectedBrands.includes(mic.brand)) return false;
    if (selectedTypes.length > 0 && !selectedTypes.includes(mic.mic_type)) return false;
    if (searchTerm && !mic.name.toLowerCase().includes(searchTerm.toLowerCase()) && 
        !mic.brand.toLowerCase().includes(searchTerm.toLowerCase())) return false;
    if (minPrice && mic.price < parseFloat(minPrice)) return false;
    if (maxPrice && mic.price > parseFloat(maxPrice)) return false;
    return true;
  });

  const handleCompare = (id) => {
    if (compareList.includes(id)) {
      setCompareList(compareList.filter(c => c !== id));
    } else if (compareList.length < 4) {
      setCompareList([...compareList, id]);
    }
  };

  return (
    <div className="all-mics-page">
      <div className="container">
        <header className="page-header">
          <h1>All Microphones</h1>
          <p className="text-gray">Browse and compare professional studio microphones</p>
        </header>

        {compareList.length > 0 && (
          <div className="compare-bar">
            <span>{compareList.length} microphone{compareList.length > 1 ? 's' : ''} selected</span>
            <button 
              className="btn btn-primary btn-sm"
              onClick={() => window.location.href = `/mic-test/compare?ids=${compareList.join(',')}`}
            >
              Compare Now
            </button>
          </div>
        )}

        <div className="all-mics-layout">
          <aside className="all-mics-sidebar">
            <MicFilters 
              filters={filters}
              onFilterChange={handleFilterChange}
              onSearchChange={setSearchTerm}
              minPrice={minPrice}
              maxPrice={maxPrice}
              onMinPriceChange={setMinPrice}
              onMaxPriceChange={setMaxPrice}
            />
          </aside>

          <main className="all-mics-main">
            <div className="all-mics-toolbar">
              <span className="results-count">{filteredMics.length} microphones</span>
            </div>

            {loading ? (
              <div className="mics-grid">
                {[...Array(6)].map((_, i) => (
                  <div key={i} className="mic-card-skeleton skeleton" />
                ))}
              </div>
            ) : filteredMics.length > 0 ? (
              <div className="mics-grid">
                {filteredMics.map(mic => (
                  <MicCard 
                    key={mic.id}
                    mic={mic}
                    onCompare={handleCompare}
                    isComparing={compareList.includes(mic.id)}
                  />
                ))}
              </div>
            ) : (
              <div className="no-results">
                <h3>No microphones found</h3>
                <p>Try adjusting your filters or search term</p>
              </div>
            )}
          </main>
        </div>
      </div>
    </div>
  );
};

export default AllMics;