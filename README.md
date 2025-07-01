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

# 📘 Laravel Interview Prep – Day 4: Forms, Validation & Request Handling

Welcome to **Day 4** of the 7-day Laravel interview prep plan! Today focuses on one of the most common real-world tasks: working with forms, validating data, and handling requests securely and efficiently.

---

## ✅ Topics Covered

- Creating Forms in Blade
- CSRF Protection
- Handling Form Submissions
- Request Object Usage
- Data Validation (Inline & Manual)
- Redirects with Old Input
- Showing Validation Errors
- Flash Messages (Success/Error)

---

## 🧠 Key Concepts

### ➤ 1. Creating a Form in Blade

In Laravel Blade, HTML forms should always include the CSRF token using `@csrf` to prevent Cross-Site Request Forgery attacks.

```blade
<!-- resources/views/product/create.blade.php -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('store.product') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Product Name" value="{{ old('name') }}">
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    <input type="number" name="price" placeholder="Price" value="{{ old('price') }}">
    @error('price')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    <textarea name="description" placeholder="Description">{{ old('description') }}</textarea>

    <button type="submit">Save</button>
</form>

**route**
use App\Http\Controllers\ProductController;

Route::get('/product/create', [ProductController::class, 'create'])->name('create.product');
Route::post('/product/store', [ProductController::class, 'store'])->name('store.product');

**Controller**
public function store(Request $request)
{
    $request->validate([
        'name'->'required',
        'price->'required',
        'description->'required',
    ])

}

```
