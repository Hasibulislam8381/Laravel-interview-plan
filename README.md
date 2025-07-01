# Laravel Interview Prep: Day 1 to Day 4 – 15 Key Interview Questions & Answers

---

## Questions & Answers

1. **What are Service Providers and the Service Container in Laravel?**  
   Service Container is like a warehouse that stores all the classes and their dependencies your app needs. Whenever your app requests a service, the container delivers it, assembling all required parts automatically.

   Service Providers are like the managers of this warehouse. They register and configure these services into the container, telling it what’s available and how to build them.

   Together, service providers prepare everything, and the service container delivers services when requested, enabling Laravel’s powerful dependency injection and bootstrapping system.

2. **How do you define a route that accepts parameters?**  
   `Route::get('/user/{id}', [UserController::class, 'show']);`

3. **What is middleware and how do you apply it to a route?**  
   Middleware filters HTTP requests; apply using `->middleware('auth')`.

4. **How do you pass data from a controller to a Blade view?**  
   Use `return view('view', ['data' => $data])` or `compact()` helper.

5. **What is the difference between `@include` and `@extends` in Blade?**  
   `@extends` sets a layout; `@include` embeds partial views.

6. **How does Laravel handle CSRF protection?**  
   Automatically via a CSRF token included with `@csrf` in forms.

7. **What is the difference between `validate()` and `Validator::make()`?**  
   `validate()` auto-redirects on fail; `Validator::make()` allows manual handling.

8. **How do you customize the error messages returned by validation?**  
   Pass a second argument array with custom messages to `validate()` or `Validator::make()`.

9. **How do you display validation errors for a specific input in Blade?**  
   Using `@error('field_name') {{ $message }} @enderror`.

10. **What helper function is used to retain old input data after validation fails?**  
    `old('input_name')`

11. **What command creates a controller in Laravel?**  
    `php artisan make:controller ControllerName`

12. **How can you group routes and apply middleware to all of them?**  
    Using `Route::middleware('auth')->group(function () { ... });`

13. **Explain the difference between `GET` and `POST` HTTP methods in routing.**  
    GET retrieves data; POST submits or changes data.

14. **What happens if you forget to add `@csrf` in a POST form?**  
    The request fails with a “419 Page Expired” CSRF token mismatch error.

15. **How do you redirect a user with flash session data?**  
    `return redirect()->route('home')->with('success', 'Message');`
16. **What is a Facade in Laravel**  
    A Facade in Laravel provides a "static" interface to classes that are available in the service container.
    In simple terms:
    It’s just a shortcut or alias to access underlying complex classes or services — without needing to resolve them manually from the container.
    Example:
    Cache::put('key', 'value', 3600);
    Log::info('Something happened');
    Config::get('app.name');

---

Good luck with your interviews! 🚀

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
