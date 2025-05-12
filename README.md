# YoPrint Laravel Coding Assignment

<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 15px; color: white; margin-bottom: 30px;">
  <h2 style="margin: 0; font-size: 24px;">🏆 YoPrint Backend Engineer Assignment</h2>
  <p style="margin: 10px 0 0; opacity: 0.9;">A sophisticated Laravel project with asynchronous CSV processing capabilities</p>
</div>

## ✨ Features

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 20px 0;">
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border-left: 4px solid #28a745;">
    <h3 style="margin-top: 0; color: #28a745;">📤 CSV Upload</h3>
    <p style="color: #6c757d;">Upload CSV files directly through the browser interface</p>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border-left: 4px solid #ffc107;">
    <h3 style="margin-top: 0; color: #ffc107;">⚡ Async Processing</h3>
    <p style="color: #6c757d;">Efficient background processing using Laravel Queue with Redis</p>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border-left: 4px solid #17a2b8;">
    <h3 style="margin-top: 0; color: #17a2b8;">💾 Database Integration</h3>
    <p style="color: #6c757d;">Seamlessly save products from CSV into database</p>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border-left: 4px solid #6f42c1;">
    <h3 style="margin-top: 0; color: #6f42c1;">📊 Status Tracking</h3>
    <p style="color: #6c757d;">Real-time status monitoring: pending, processing, completed</p>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border-left: 4px solid #fd7e14;">
    <h3 style="margin-top: 0; color: #fd7e14;">🔄 Auto-refresh UI</h3>
    <p style="color: #6c757d;">Dynamic UI updates via polling every 5 seconds</p>
  </div>
</div>

---

## 🚀 How to Run Locally

<div style="background: #f8f9fa; padding: 30px; border-radius: 15px; margin: 20px 0;">

### 1. Clone the Repository
```bash
git clone <repo-url>
cd yoprint-assignment
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database (SQLite)
Add the following to your `.env` file:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

### 5. Create SQLite Database
```bash
touch database/database.sqlite
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Start Redis & Queue Worker
```bash
# In one terminal
redis-server

# In another terminal
php artisan queue:work
```

### 8. Serve the Application
```bash
php artisan serve
```

</div>

---

## 📝 Sample CSV Format

<div style="background: #212529; padding: 25px; border-radius: 12px; overflow-x: auto; margin: 20px 0;">
<pre style="color: #e83e8c; margin: 0; font-family: 'Courier New', monospace; font-size: 14px;"><code>UNIQUE_KEY,PRODUCT_TITLE,PRODUCT_DESCRIPTION,STYLE#,SANMAR_MAINFRAME_COLOR,SIZE,COLOR_NAME,PIECE_PRICE</code></pre>
</div>

---

<div style="text-align: center; margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 15px;">
  <p style="color: #6c757d; margin-bottom: 10px;">Built with ❤️ using Laravel</p>
  <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
    <span style="background: #e3f2fd; color: #1976d2; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Laravel Framework</span>
    <span style="background: #fff3e0; color: #f57c00; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Redis Queue</span>
    <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px;">SQLite Database</span>
    <span style="background: #fce4ec; color: #c2185b; padding: 5px 12px; border-radius: 20px; font-size: 12px;">CSV Processing</span>
  </div>
</div>