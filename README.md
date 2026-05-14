# AK23 Studio Kits - Mic Test Lab Feature

## Project Overview

This is the "Mic Test Lab" feature for AK23 Studio Kits - a professional microphone comparison platform that allows users to:
1. Browse microphones
2. View microphone details
3. Listen to professional audio test recordings
4. Compare microphones side-by-side with synchronized playback

## Project Structure

```
/workspace/project
├── database.sql                  # MySQL database schema + seed data
├── api/mic-test/
│   ├── database.php           # Database connection
│   ├── get-mics.php         # Get all microphones (with filters)
│   ├── get-mic.php         # Get single microphone by ID
│   ├── get-mic-by-slug.php  # Get single microphone by slug
│   ├── compare-mics.php     # Get microphones for comparison
│   ├── get-brands.php      # Get microphone brands
│   ├── get-types.php       # Get microphone types
│   ├── create-mic.php     # Create new microphone
│   ├── update-mic.php     # Update microphone
│   ├── delete-mic.php     # Delete microphone
│   ├── upload-audio.php   # Upload audio test
│   └── upload-image.php   # Upload image
├── frontend/src/
│   ├── index.jsx         # React entry point
│   ├── App.jsx          # Main App with routing
│   ├── components/
│   │   ├── MicCard.jsx           # Microphone card component
│   │   ├── MicCard.css
│   │   ├── MicWavePlayer.jsx      # WaveSurfer.js audio player
│   │   ├── MicWavePlayer.css
│   │   ├── HeroSection.jsx      # Hero section component
│   │   ├── HeroSection.css
│   │   ├── MicFilters.jsx       # Filter sidebar component
│   │   └── MicFilters.css
│   ├── pages/
│   │   ├── MicTestLanding.jsx   # /mic-test landing page
│   │   ├── MicTestLanding.css
│   │   ├── AllMics.jsx          # /mic-test/all page
│   │   ├── AllMics.css
│   │   ├── MicDetails.jsx        # /mic-test/:slug page
│   │   ├── MicDetails.css
│   │   ├── Compare.jsx           # /mic-test/compare page
│   │   └── Compare.css
│   └── styles/
│       ├── global.css   # Global theme styles
│       └── layout.css # Header/footer styles
├── admin/mic-test/
│   ├── index.php        # Admin all mics list
│   └── add.php        # Admin add new mic form
└── uploads/mic-tests/
    ├── audio/        # Audio files storage
    └── images/       # Image files storage
```

## Tech Stack

- **Frontend**: React 18 + React Router
- **Audio Visualization**: WaveSurfer.js
- **Animations**: Framer Motion (optional)
- **Backend**: Pure PHP (no frameworks)
- **Database**: MySQL

## Design Theme

Based on AK23 Studio Kits branding:
- Primary: `#A855F7` (Purple)
- Primary Dark: `#7C3AED`
- Background: `#0F0F13` (Dark Black)
- Card Background: `#1A1A22`
- Waveform: `#7C3AED` / `#C084FC`

## API Endpoints

### GET Endpoints
- `/api/mic-test/get-mics.php` - List all microphones
- `/api/mic-test/get-mic.php?id=` - Get microphone by ID
- `/api/mic-test/get-mic-by-slug.php?slug=` - Get microphone by slug
- `/api/mic-test/compare-mics.php?ids=1,2,3` - Get mics for comparison
- `/api/mic-test/get-brands.php` - List all brands
- `/api/mic-test/get-types.php` - List all types

### POST Endpoints
- `/api/mic-test/create-mic.php` - Create microphone
- `/api/mic-test/update-mic.php` - Update microphone
- `/api/mic-test/delete-mic.php` - Delete microphone
- `/api/mic-test/upload-audio.php` - Upload audio
- `/api/mic-test/upload-image.php` - Upload image

## React Routes

- `/mic-test` - Landing page with hero, stats, features
- `/mic-test/all` - All microphones with filters
- `/mic-test/:slug` - Microphone detail page
- `/mic-test/compare` - Compare page (select up to 4 mics)

## Demo Data

Included demo microphones:
1. Shure SM7B ($399)
2. Rode NT1 5th Gen ($279)
3. Audio-Technica AT2020 ($149)
4. AKG C414 XLII ($1,299)
5. Neumann U87 Ai ($3,990)
6. Sennheiser MD 421 ($399)
7. Blue Ember ($169)
8. Warm Audio WA-47jr ($299)
9. Lewitt MTP 550 DM ($259)
10. Shure SM58 ($99)

## Setup

1. Import `database.sql` to MySQL
2. Configure database in `api/mic-test/database.php`
3. Install dependencies:
   ```bash
   cd frontend
   npm install react react-dom react-router-dom axios wavesurfer.js
   ```
4. Start development server

## Features

- ✅ Glassmorphism UI cards
- ✅ WaveSurfer.js audio visualization
- ✅ Synchronized playback comparison (up to 4 mics)
- ✅ Filter by brand, type, price
- ✅ Search functionality
- ✅ Admin panel for adding/editing mics
- ✅ Image and audio upload
- ✅ Responsive design (mobile-first)
- ✅ Dark theme with purple neon accents

## Notes

- Audio files are placeholders - replace with real recordings in production
- Demo mode uses JavaScript arrays when database unavailable
- Admin panel uses Bootstrap 5 + custom CSS

## License

Proprietary - AK23 Studio Kits