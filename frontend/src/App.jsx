import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import MicTestLanding from './pages/MicTestLanding';
import AllMics from './pages/AllMics';
import MicDetails from './pages/MicDetails';
import Compare from './pages/Compare';
import './styles/global.css';
import './styles/layout.css';

const App = () => {
  return (
    <Router>
      <div className="app">
        {/* Header Navigation */}
        <header className="main-header">
          <div className="container header-content">
            <Link to="/" className="logo">
              <span className="logo-text">AK23</span>
              <span className="logo-sub">Studio Kits</span>
            </Link>
            
            <nav className="desktop-nav">
              <Link to="/">Home</Link>
              <Link to="/sound-kits">Sound Kits</Link>
              <Link to="/mic-test" className="nav-active">Mic Test Lab</Link>
              <Link to="/blog">Blog</Link>
              <Link to="/about">About</Link>
              <Link to="/contact">Contact</Link>
            </nav>

            <button className="mobile-menu-btn">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
              </svg>
            </button>
          </div>
        </header>

        {/* Main Content */}
        <main className="main-content">
          <Routes>
            <Route path="/mic-test" element={<MicTestLanding />} />
            <Route path="/mic-test/all" element={<AllMics />} />
            <Route path="/mic-test/:slug" element={<MicDetails />} />
            <Route path="/mic-test/compare" element={<Compare />} />
            
            {/* Default route - redirect to mic test */}
            <Route path="/" element={
              <div className="home-redirect">
                <div className="container text-center" style={{ padding: '4rem 0' }}>
                  <h1 style={{ marginBottom: '1rem' }}>AK23 Studio Kits</h1>
                  <p style={{ marginBottom: '2rem', color: 'var(--text-gray)' }}>
                    Your source for professional studio microphones and sound kits
                  </p>
                  <Link to="/mic-test" className="btn btn-primary btn-lg">
                    Go to Mic Test Lab
                  </Link>
                </div>
              </div>
            } />
          </Routes>
        </main>

        {/* Footer */}
        <footer className="main-footer">
          <div className="container">
            <div className="footer-content">
              <div className="footer-brand">
                <span className="logo-text">AK23</span>
                <span className="logo-sub">Studio Kits</span>
                <p>Professional audio solutions for creators</p>
              </div>
              <div className="footer-links">
                <h4>Quick Links</h4>
                <Link to="/mic-test">Mic Test Lab</Link>
                <Link to="/mic-test/all">All Microphones</Link>
                <Link to="/mic-test/compare">Compare</Link>
                <Link to="/blog">Blog</Link>
              </div>
              <div className="footer-links">
                <h4>Support</h4>
                <Link to="/contact">Contact</Link>
                <Link to="/about">About</Link>
                <Link to="/faq">FAQ</Link>
              </div>
            </div>
            <div className="footer-bottom">
              <p>© 2024 AK23 Studio Kits. All rights reserved.</p>
            </div>
          </div>
        </footer>
      </div>
    </Router>
  );
};

export default App;