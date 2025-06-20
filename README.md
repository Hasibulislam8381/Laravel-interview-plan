# 📘 Laravel Interview Plan

This repository contains a 15-day structured Laravel interview preparation plan.

---

## 📅 Day 1 - Laravel Request Lifecycle & Route Types

### 🔁 Laravel Request Lifecycle (Overview)

When a user visits your Laravel application in the browser, here’s what happens step-by-step:

1. **🔗 Browser Sends Request**  
   The user opens a URL, and the browser sends a request to your Laravel app.

2. **🚪 Entry Point – `public/index.php`**  
   This is the front controller — every request starts here.

3. **⚙️ HTTP Kernel – `App\Http\Kernel.php`**  
   The kernel:

   - Registers global and route middleware.
   - Sends the request through middleware.

4. **🛡 Middleware**  
   Middleware filters the request (authentication, CSRF, etc.).

5. **🧭 Routes**  
   Laravel matches the request to a route in `routes/web.php` or `routes/api.php`.

6. **📦 Controller Method**  
   The matched controller method executes the application logic.

7. **📨 Response**  
   The response is sent back through middleware and kernel, then to the browser.

---

### 2. Route Types in Laravel

Laravel organizes routes into two main files to separate web UI and API logic:

#### a) `web.php` Routes

- Used for **web interface** routes.
- Supports **sessions**, **cookies**, and **CSRF protection**.
- Middleware like `web` and `auth` typically applied.

Example:

```php
// routes/web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
```

#### b) `api.php` Routes

- Used for API endpoints only
- Routes are stateless (no sessions or cookies).
- Usually return JSON.
- Middleware like api applied, includes throttling.

Example:

```php
// routes/api.php
Route::get('/products', [Api\ProductController::class, 'index']);

```
