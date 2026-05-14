<?php
/**
 * Add New Microphone - Admin Form
 * Mic Test Lab Admin Panel
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Mic - Admin | AK23 Studio Kits</title>
  <style>
    :root {
      --primary: #A855F7;
      --primary-dark: #7C3AED;
      --bg-dark: #0F0F13;
      --bg-card: #1A1A22;
      --text-white: #FFFFFF;
      --text-gray: #9CA3AF;
      --glass-border: rgba(168, 85, 247, 0.2);
    }
    
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg-dark);
      color: var(--text-white);
      min-height: 100vh;
    }
    
    /* Sidebar - Same as index */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      width: 260px;
      background: var(--bg-card);
      border-right: 1px solid var(--glass-border);
      padding: 20px 0;
      z-index: 100;
    }
    
    .sidebar-brand { padding: 0 20px 30px; border-bottom: 1px solid var(--glass-border); }
    .sidebar-brand h3 { font-size: 1.5rem; color: var(--primary); }
    .sidebar-brand span { font-size: 0.75rem; color: var(--text-gray); }
    
    .sidebar-menu { padding: 20px 0; }
    .menu-section { padding: 0 20px; margin-bottom: 10px; }
    .menu-section-title { font-size: 0.75rem; color: var(--text-gray); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
    
    .menu-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px;
      color: var(--text-gray);
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.2s;
      margin: 0 10px;
    }
    
    .menu-item:hover, .menu-item.active {
      background: rgba(168, 85, 247, 0.1);
      color: var(--text-white);
    }
    
    .menu-item.active { border-left: 3px solid var(--primary); }
    .menu-item i { width: 20px; }
    
    /* Main Content */
    .main-content { margin-left: 260px; padding: 30px; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .page-header h1 { font-size: 1.75rem; }
    
    /* Form Layout */
    .form-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
    }
    
    .card {
      background: var(--bg-card);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 25px;
    }
    
    .card-title {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 0.875rem; color: var(--text-gray); margin-bottom: 8px; }
    .form-control {
      width: 100%;
      padding: 12px 15px;
      background: var(--bg-dark);
      border: 1px solid var(--glass-border);
      border-radius: 8px;
      color: var(--text-white);
      font-size: 1rem;
    }
    
    .form-control:focus { outline: none; border-color: var(--primary); }
    textarea.form-control { min-height: 120px; resize: vertical; }
    
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    
    /* Buttons */
    .btn {
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: var(--text-white);
    }
    
    .btn-primary:hover { box-shadow: 0 0 20px rgba(168, 85, 247, 0.4); }
    
    .btn-secondary {
      background: transparent;
      border: 1px solid var(--glass-border);
      color: var(--text-gray);
    }
    
    .btn-ghost { background: transparent; color: var(--text-gray); }
    .btn-ghost:hover { color: var(--text-white); }
    
    /* File Upload */
    .file-upload {
      border: 2px dashed var(--glass-border);
      border-radius: 12px;
      padding: 40px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .file-upload:hover { border-color: var(--primary); background: rgba(168, 85, 247, 0.05); }
    .file-upload i { font-size: 2rem; color: var(--text-gray); margin-bottom: 10px; }
    .file-upload p { color: var(--text-gray); }
    
    /* Toggle Switch */
    .toggle-switch {
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: pointer;
    }
    
    .toggle-switch input { display: none; }
    
    .toggle-slider {
      width: 48px;
      height: 24px;
      background: var(--bg-dark);
      border-radius: 24px;
      position: relative;
      transition: all 0.2s;
    }
    
    .toggle-slider::after {
      content: '';
      position: absolute;
      left: 2px;
      top: 2px;
      width: 20px;
      height: 20px;
      background: var(--text-gray);
      border-radius: 50%;
      transition: all 0.2s;
    }
    
    .toggle-switch input:checked + .toggle-slider { background: var(--primary); }
    .toggle-switch input:checked + .toggle-slider::after { left: 26px; background: var(--text-white); }
    
    .form-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      padding-top: 20px;
      border-top: 1px solid var(--glass-border);
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <h3>AK23</h3>
      <span>Admin Panel</span>
    </div>
    
    <nav class="sidebar-menu">
      <div class="menu-section">
        <div class="menu-section-title">Main</div>
        <a href="../index.php" class="menu-item">
          <i class="fas fa-home"></i> Dashboard
        </a>
      </div>
      
      <div class="menu-section">
        <div class="menu-section-title">Mic Test Lab</div>
        <a href="index.php" class="menu-item">
          <i class="fas fa-microphone"></i> All Mics
        </a>
        <a href="add.php" class="menu-item active">
          <i class="fas fa-plus"></i> Add New Mic
        </a>
        <a href="audio.php" class="menu-item">
          <i class="fas fa-music"></i> Audio Tests
        </a>
      </div>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="page-header">
      <h1>Add New Microphone</h1>
      <a href="index.php" class="btn btn-ghost">
        <i class="fas fa-arrow-left"></i> Back to Mics
      </a>
    </div>
    
    <form action="save.php" method="POST" enctype="multipart/form-data">
      <div class="form-grid">
        <!-- Main Form -->
        <div>
          <div class="card">
            <h3 class="card-title">Basic Information</h3>
            
            <div class="form-group">
              <label class="form-label">Microphone Name *</label>
              <input type="text" name="name" class="form-control" required placeholder="e.g., Shure SM7B">
            </div>
            
            <div class="form-group">
              <label class="form-label">Slug *</label>
              <input type="text" name="slug" class="form-control" required placeholder="e.g., shure-sm7b">
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Brand *</label>
                <select name="brand" class="form-control" required>
                  <option value="">Select Brand</option>
                  <option value="Shure">Shure</option>
                  <option value="Rode">Rode</option>
                  <option value="Audio-Technica">Audio-Technica</option>
                  <option value="AKG">AKG</option>
                  <option value="Neumann">Neumann</option>
                  <option value="Sennheiser">Sennheiser</option>
                  <option value="Blue">Blue</option>
                  <option value="Warm Audio">Warm Audio</option>
                  <option value="Lewitt">Lewitt</option>
                </select>
              </div>
              
              <div class="form-group">
                <label class="form-label">Microphone Type *</label>
                <select name="mic_type" class="form-control" required>
                  <option value="">Select Type</option>
                  <option value="Dynamic">Dynamic</option>
                  <option value="Condenser">Condenser</option>
                  <option value="USB">USB</option>
                  <option value="Ribbon">Ribbon</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="form-label">Price ($) *</label>
              <input type="number" name="price" class="form-control" required min="0" step="0.01" placeholder="399.00">
            </div>
            
            <div class="form-group">
              <label class="form-label">Short Description</label>
              <input type="text" name="short_description" class="form-control" maxlength="200" placeholder="Brief description for listings">
            </div>
            
            <div class="form-group">
              <label class="form-label">Full Description</label>
              <textarea name="full_description" class="form-control" rows="5" placeholder="Detailed description"></textarea>
            </div>
          </div>
          
          <div class="card">
            <h3 class="card-title">Technical Specifications</h3>
            
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Frequency Response</label>
                <input type="text" name="frequency_response" class="form-control" placeholder="e.g., 50Hz - 20kHz">
              </div>
              
              <div class="form-group">
                <label class="form-label">Polar Pattern</label>
                <input type="text" name="polar_pattern" class="form-control" placeholder="e.g., Cardioid">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Connectivity</label>
                <input type="text" name="connectivity" class="form-control" placeholder="e.g., XLR">
              </div>
              
              <div class="form-group">
                <label class="form-label">Impedance</label>
                <input type="text" name="impedance" class="form-control" placeholder="e.g., 310 ohms">
              </div>
            </div>
            
            <div class="form-group">
              <label class="form-label">External URL</label>
              <input type="url" name="external_url" class="form-control" placeholder="https://...">
            </div>
          </div>
        </div>
        
        <!-- Sidebar Options -->
        <div>
          <div class="card">
            <h3 class="card-title">Thumbnail Image</h3>
            
            <div class="file-upload" onclick="document.getElementById('thumbnail').click()">
              <i class="fas fa-cloud-upload-alt"></i>
              <p>Click to upload thumbnail</p>
              <p style="font-size: 0.75rem;">JPG, PNG, WebP - Max 5MB</p>
              <input type="file" id="thumbnail" name="thumbnail" style="display: none;" accept="image/*">
            </div>
          </div>
          
          <div class="card">
            <h3 class="card-title">Gallery Images</h3>
            
            <div class="file-upload" onclick="document.getElementById('gallery').click()">
              <i class="fas fa-images"></i>
              <p>Click to upload gallery</p>
              <p style="font-size: 0.75rem;">Multiple images allowed</p>
              <input type="file" id="gallery" name="gallery[]" style="display: none;" accept="image/*" multiple>
            </div>
          </div>
          
          <div class="card">
            <h3 class="card-title">Status</h3>
            
            <label class="toggle-switch">
              <input type="checkbox" name="featured" value="1">
              <span class="toggle-slider"></span>
              <span>Featured</span>
            </label>
            
            <div style="margin-top: 20px;">
              <label class="form-label">Status</label>
              <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
          
          <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Save Microphone
            </button>
          </div>
        </div>
      </div>
    </form>
  </main>
</body>
</html>