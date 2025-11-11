# Lab 7 - CRUD (Models, Controllers & Routes )

## Overview

In this session, we’ll explore how **Models**, **Controllers**, **Routes**, and **Views** work together in Laravel’s MVC (Model–View–Controller) architecture.

We’ll focus on building a simple **CRUD (Create, Read, Update, Delete)** for **Roles**.

---

### Roles Table

| Column        | Description                           |
| ------------- | ------------------------------------- |
| `id`          | Primary key                           |
| `name`        | Role name (e.g., Admin, Editor, User) |
| `description` | Description of the role               |

**Relationship:**

* Each **User** belongs to **one Role**.
* Each **Role** can have **many Users**.

---

## 1. MODELS & ELOQUENT ORM

---

### 🔹 What is a Model?

A **Model** is a PHP class that represents a **database table** and handles interaction with that table.
Models let us work with data using **objects** instead of SQL.

Example — `app/Models/Role.php`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];
}
```

The model above maps to the `roles` table.

---

### 🔹 What is an ORM?

An **ORM (Object Relational Mapper)** is a tool that allows developers to interact with the database using **objects** instead of raw SQL.

#### Without ORM (plain SQL):

```sql
SELECT * FROM roles WHERE id = 1;
```

#### ⚙️ With Eloquent ORM:

```php
$role = Role::find(1);
```

**Eloquent ORM** (Laravel’s ORM) automatically handles:

* SQL generation
* Data mapping
* Relationships between tables

It makes your database interaction **cleaner and faster**.

---

### 🔹 Common Eloquent Methods

| Method       | Description               | Example                               |
| ------------ | ------------------------- | ------------------------------------- |
| `all()`      | Retrieve all records      | `Role::all()`                         |
| `find($id)`  | Retrieve one record by ID | `Role::find(1)`                       |
| `create([])` | Insert new record         | `Role::create(['name' => 'Admin'])`   |
| `update([])` | Update existing record    | `$role->update(['name' => 'Editor'])` |
| `delete()`   | Delete a record           | `$role->delete()`                     |

---

### 🔹 Eloquent Relationships

We know:

* **One Role → Many Users**
* **One User → One Role**

In the **Role** model:

```php
public function users() : HasMany
{
    return $this->hasMany(User::class);
}
```

In the **User** model:

```php
public function role() : BelongsTo
{
    return $this->belongsTo(Role::class);
}
```

Now you can do:

```php
$role = Role::find(1);
$users = $role->users;  // Get all users assigned to this role
```

---

### Illustration: Model Concept

```
+--------------+       +------------------+
|   roles      | <---> |   Role Model     |
|--------------|       |------------------|
| id           |       | $fillable        |
| name         |       | relationships()  |
| description  |       |                  |
+--------------+       +------------------+
```

---

## 2. CONTROLLERS

---

### 🔹 What is a Controller?

A **Controller** handles the logic of your application — it **receives a request**, interacts with the **Model**, and returns a **response** (often a Blade view).

It acts as the **bridge** between Models and Views.

---

### 🔹 Creating a Controller with a Model

We created our model using:

```bash
php artisan make:model Role -a
```

The `-a` flag created:

* Model
* Migration
* Factory
* Seeder
* Policy
* Requests
* **Controller (`RoleController`)**

---

### 🔹 Example: RoleController

```php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully.');
    }
}
```

---

### 🔹 Resource Controller Methods

| Method         | HTTP Verb | URL                | Purpose                     |
| -------------- | --------- | ------------------ | --------------------------- |
| `index()`      | GET       | `/roles`           | Display all roles           |
| `create()`     | GET       | `/roles/create`    | Show form to add a new role |
| `store()`      | POST      | `/roles`           | Save a new role             |
| `show($id)`    | GET       | `/roles/{id}`      | Show one role               |
| `edit($id)`    | GET       | `/roles/{id}/edit` | Edit an existing role       |
| `update($id)`  | PUT/PATCH | `/roles/{id}`      | Update role data            |
| `destroy($id)` | DELETE    | `/roles/{id}`      | Delete a role               |

---

### Illustration: Controller’s Role

```
Request → Controller → Model → View → Response
          ^^^^^^^^^
          Business logic here
```

---

## 3. ROUTES

---

### 🔹 What is a Route?

A **Route** defines which **controller method** or **function** should handle a given URL request.

Example:

```php
Route::get('/roles', [RoleController::class, 'index']);
```

When the user visits `/roles`, the `index()` method in `RoleController` runs.

---

### 🔹 Basic Route Syntax

```php
Route::get('/path', [ControllerName::class, 'methodName']);
Route::post('/path', [ControllerName::class, 'methodName']);
Route::put('/path/{id}', [ControllerName::class, 'update']);
Route::delete('/path/{id}', [ControllerName::class, 'destroy']);
```

---

### 🔹 Resource Routes

Laravel provides a shortcut for CRUD routes:

```php
Route::resource('roles', RoleController::class);
```

This single line automatically generates **all** routes for:

* index
* create
* store
* show
* edit
* update
* destroy

You can view all registered routes using:

```bash
php artisan route:list
```

---

### Illustration: Routes → Controller Mapping

```
+-------------+        +-----------------------+
|  /roles     | -----> | RoleController@index  |
|  /roles/1   | -----> | RoleController@show   |
|  /roles/create | ---> | RoleController@create |
+-------------+        +-----------------------+
```

---

## 4. VIEWS (Blade Templates)

---

### 🔹 What is Blade?

**Blade** is Laravel’s powerful **template engine**.
It allows you to embed PHP logic directly in your HTML files, using simple directives like `@foreach` and `@if`.

Example — `resources/views/roles/index.blade.php`:

```blade
@extends('layouts.app')

@section('content')
<h2>All Roles</h2>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

---

### Illustration: The Full MVC Flow

```
      +-----------+
      |   Route   |
      +-----------+
             |
             v
      +-----------+
      | Controller|
      +-----------+
             |
             v
      +-----------+
      |   Model   |
      +-----------+
             |
             v
      +-----------+
      |   View    |
      +-----------+
```

---

## SUMMARY

| Concept          | Role in MVC                      | Key Example                                       |
| ---------------- | -------------------------------- | ------------------------------------------------- |
| **Model**        | Represents data (database table) | `Role::all()`                                     |
| **Controller**   | Handles logic and flow           | `RoleController@index()`                          |
| **Route**        | Directs HTTP requests            | `Route::resource('roles', RoleController::class)` |
| **View (Blade)** | Displays HTML to users           | `roles/index.blade.php`                           |

---

### 💡 Key Takeaways

✅ **Models** → Represent your data and relationships.
✅ **Controllers** → Contain logic for handling requests.
✅ **Routes** → Map URLs to controller methods.
✅ **Views** → Present data to users.
✅ Together, they form the **MVC pattern** that powers every Laravel app.

---
