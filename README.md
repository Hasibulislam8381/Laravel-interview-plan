# 📘 Laravel Study - Day 1: Basics & Routing

## ✅ Topics Covered

- Laravel directory structure
- `web.php` vs `api.php`
- Basic route definitions (`get`, `post`, `any`)
- Route parameters (required and optional)
- Named routes
- Route groups with middleware and prefix

---

## 🧠 Key Concepts

### ➤ Basic Route

```php
Route::get('/hello', function () {
    return 'Hello, Laravel!';
});
```

### ➤ Route With Parameter

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
});

```

### ➤ Optional Parameter Parameter

```php
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello, $name";
});

```

### ➤ Route group with Prefix and middleware

```php
Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/users',[Usercontroller::class,index]);
});
```

# 📘 Laravel Study - Day 2: Controllers & Views

## ✅ Topics Covered

- Creating controllers with Artisan
- Defining controller methods
- Routing to controllers
- Returning views from controllers
- Passing data to views
- Using the `compact()` helper
- Blade basics: displaying variables, loops

---

## 🧠 Key Concepts

### ➤ Create Controller

```bash
php artisan make:controller ProductController

```

### ➤ Define Methods in Controller

```bash
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
        return view('products.index');
    }

    public function show($id) {
        return "Product ID: " . $id;
    }
}
```

### ➤ Routing to Controller Methods

```bash
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

```

# 📘 Laravel Study - Day 3: Models, Migrations & Eloquent Relationships

1.Create Model with Migration

```bash
php artisan make:model Product -m
```

2.Eloquent Relationships
(One to One)

```bash
// User.php
public function profile() {
    return $this->hasOne(Profile::class);
}

// Profile.php
public function user() {
    return $this->belongsTo(User::class);
}
```

(One to Many)

```bash
// Category.php
public function products() {
    return $this->hasMany(Product::class);
}

// Product.php
public function category() {
    return $this->belongsTo(Category::class);
}

```

(Many to Many)

```bash
// Product.php
public function tags() {
    return $this->belongsToMany(Tag::class);
}

// Tag.php
public function products() {
    return $this->belongsToMany(Product::class);
}

```
