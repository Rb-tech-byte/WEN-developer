<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mic Test Lab - Admin Panel | AK23 Studio Kits</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg-dark);
      color: var(--text-white);
      min-height: 100vh;
    }
    
    /* Sidebar */
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
    
    .sidebar-brand {
      padding: 0 20px 30px;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .sidebar-brand h3 {
      font-size: 1.5rem;
      color: var(--primary);
    }
    
    .sidebar-brand span {
      font-size: 0.75rem;
      color: var(--text-gray);
    }
    
    .sidebar-menu {
      padding: 20px 0;
    }
    
    .menu-section {
      padding: 0 20px;
      margin-bottom: 10px;
    }
    
    .menu-section-title {
      font-size: 0.75rem;
      color: var(--text-gray);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 10px;
    }
    
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
    
    .menu-item.active {
      border-left: 3px solid var(--primary);
    }
    
    .menu-item i {
      width: 20px;
    }
    
    /* Main Content */
    .main-content {
      margin-left: 260px;
      padding: 30px;
    }
    
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
    
    .page-header h1 {
      font-size: 1.75rem;
    }
    
    /* Cards */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      padding: 20px;
    }
    
    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .card-title {
      font-size: 1.125rem;
      font-weight: 600;
    }
    
    /* Table */
    .table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .table th, .table td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .table th {
      font-size: 0.75rem;
      color: var(--text-gray);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .table tr:hover td {
      background: rgba(168, 85, 247, 0.05);
    }
    
    /* Buttons */
    .btn {
      padding: 10px 20px;
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
    
    .btn-primary:hover {
      box-shadow: 0 0 20px rgba(168, 85, 247, 0.4);
    }
    
    .btn-secondary {
      background: transparent;
      border: 1px solid var(--primary);
      color: var(--text-white);
    }
    
    .btn-sm {
      padding: 6px 12px;
      font-size: 0.875rem;
    }
    
    .btn-danger {
      background: #EF4444;
      color: var(--text-white);
    }
    
    /* Form */
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-label {
      display: block;
      font-size: 0.875rem;
      color: var(--text-gray);
      margin-bottom: 8px;
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px;
      background: var(--bg-dark);
      border: 1px solid var(--glass-border);
      border-radius: 8px;
      color: var(--text-white);
      font-size: 1rem;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
    }
    
    .form-select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px;
      background-size: 16px;
      padding-right: 40px;
    }
    
    /* Badge */
    .badge {
      padding: 4px 12px;
      border-radius: 99px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .badge-success {
      background: rgba(34, 197, 94, 0.2);
      color: #22C55E;
    }
    
    .badge-warning {
      background: rgba(234, 179, 8, 0.2);
      color: #EAB308;
    }
    
    /* Stats */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 30px;
    }
    
    .stat-card {
      background: var(--bg-card);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      padding: 20px;
      text-align: center;
    }
    
    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
    }
    
    .stat-label {
      font-size: 0.875rem;
      color: var(--text-gray);
    }
    
    /* Pagination */
    .pagination {
      display: flex;
      gap: 8px;
      justify-content: center;
      margin-top: 20px;
    }
    
    .page-link {
      padding: 8px 16px;
      background: var(--bg-card);
      border: 1px solid var(--glass-border);
      border-radius: 8px;
      color: var(--text-gray);
      text-decoration: none;
    }
    
    .page-link.active {
      background: var(--primary);
      border-color: var(--primary);
      color: var(--text-white);
    }
    
    /* Modal */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }
    
    .modal.show {
      display: flex;
    }
    
    .modal-content {
      background: var(--bg-card);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      width: 100%;
      max-width: 800px;
      max-height: 90vh;
      overflow-y: auto;
    }
    
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .modal-body {
      padding: 20px;
    }
    
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding: 20px;
      border-top: 1px solid var(--glass-border);
    }
    
    .close-modal {
      background: none;
      border: none;
      color: var(--text-gray);
      font-size: 1.5rem;
      cursor: pointer;
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
        <a href="index.php" class="menu-item">
          <i class="fas fa-home"></i>
          Dashboard
        </a>
      </div>
      
      <div class="menu-section">
        <div class="menu-section-title">Sound Kits</div>
        <a href="#" class="menu-item">
          <i class="fas fa-music"></i>
          All Kits
        </a>
        <a href="#" class="menu-item">
          <i class="fas fa-plus"></i>
          Add New
        </a>
      </div>
      
      <div class="menu-section">
        <div class="menu-section-title">Mic Test Lab</div>
        <a href="mic-test/" class="menu-item active">
          <i class="fas fa-microphone"></i>
          All Mics
        </a>
        <a href="mic-test/add.php" class="menu-item">
          <i class="fas fa-plus"></i>
          Add New Mic
        </a>
        <a href="mic-test/audio.php" class="menu-item">
          <i class="fas fa-music"></i>
          Audio Tests
        </a>
        <a href="mic-test/media.php" class="menu-item">
          <i class="fas fa-image"></i>
          Media Uploads
        </a>
      </div>
      
      <div class="menu-section">
        <div class="menu-section-title">Settings</div>
        <a href="#" class="menu-item">
          <i class="fas fa-cog"></i>
          General
        </a>
      </div>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="page-header">
      <h1>Mic Test Lab - All Microphones</h1>
      <a href="add.php" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Add New Mic
      </a>
    </div>
    
    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-value">48</div>
        <div class="stat-label">Total Microphones</div>
      </div>
      <div class="stat-card">
        <div class="stat-value">250+</div>
        <div class="stat-label">Audio Tests</div>
      </div>
      <div class="stat-card">
        <div class="stat-value">12</div>
        <div class="stat-label">Featured</div>
      </div>
      <div class="stat-card">
        <div class="stat-value">48</div>
        <div class="stat-label">Active</div>
      </div>
    </div>
    
    <!-- Table -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">All Microphones (10)</span>
        <input type="text" class="form-control" style="max-width: 300px;" placeholder="Search...">
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>Name</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Price</th>
            <th>Audio Tests</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="micTableBody">
          <tr>
            <td><input type="checkbox"></td>
            <td>Shure SM7B</td>
            <td>Shure</td>
            <td>Dynamic</td>
            <td>$399</td>
            <td>5</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
              <button class="btn btn-sm btn-secondary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td>Rode NT1 5th Gen</td>
            <td>Rode</td>
            <td>Condenser</td>
            <td>$279</td>
            <td>5</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
              <button class="btn btn-sm btn-secondary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td>Audio-Technica AT2020</td>
            <td>Audio-Technica</td>
            <td>Condenser</td>
            <td>$149</td>
            <td>2</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
              <button class="btn btn-sm btn-secondary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td>AKG C414 XLII</td>
            <td>AKG</td>
            <td>Condenser</td>
            <td>$1,299</td>
            <td>2</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
              <button class="btn btn-sm btn-secondary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td>Neumann U87 Ai</td>
            <td>Neumann</td>
            <td>Condenser</td>
            <td>$3,990</td>
            <td>2</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
              <button class="btn btn-sm btn-secondary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      
      <div class="pagination">
        <a href="#" class="page-link">&laquo;</a>
        <a href="#" class="page-link active">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">&raquo;</a>
      </div>
    </div>
  </main>
</body>
</html>