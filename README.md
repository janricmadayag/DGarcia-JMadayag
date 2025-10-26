# 🧾 Student List Management System — Midterm Project

## 🧠 About the Project
This project was created as part of the **Midterm Examination** for *Web Systems and Technologies*.  
It is a **Laravel-based Student List Management System** designed to demonstrate CRUD functionality — *Create, Read, Update, Delete* — using the Laravel MVC structure and Eloquent ORM.

The system allows users to manage **students** and **sections**, including features for adding, editing, and deleting records, with data stored in a MySQL database.

---

## 🎯 Objectives
- Apply the **Laravel MVC architecture** for structured web development.  
- Implement **CRUD operations** using Eloquent ORM.  
- Use **Blade templates** for a responsive and maintainable UI.  
- Integrate **MySQL** for persistent data storage.  
- Utilize **Git & GitHub** for version control and documentation.

---

## ⚙️ Features / Functionality
- ➕ **Add Students / Sections** — Create new student or section records.  
- ✏️ **Edit Records** — Modify student or section details.  
- ❌ **Delete Records** — Remove existing students or sections.  
- 📋 **View All Data** — Display a list of students and sections dynamically.  
- 🔄 **Data Sync** — Automatically updates and reflects in the database.  
- 🎨 **Blade Templates** — Reusable and responsive UI.

---

## 🧰 Technologies Used

| Technology | Description |
|-------------|-------------|
| **Laravel 11** | PHP framework for MVC structure |
| **PHP 8.x** | Backend scripting language |
| **MySQL** | Relational database for data storage |
| **Blade** | Laravel’s templating engine |
| **Bootstrap 5** | Frontend styling and responsive layout |
| **Composer** | PHP dependency manager |


---

## 💻 Installation Instructions

Follow these steps to set up and run the project locally:

```bash
# 1️⃣ Clone the repository
git clone https://github.com/janricmadayag/DGarcia-JMadayag.git

# 2️⃣ Navigate into the project directory
cd DGarcia-JMadayag

# 3️⃣ Install dependencies
composer install

# 4️⃣ Copy the example environment file
cp .env.example .env

# 5️⃣ Configure your database credentials in the .env file

# 6️⃣ Generate an application key
php artisan key:generate

# 7️⃣ Run database migrations
php artisan migrate

# 8️⃣ Start the development server
php artisan serve

---

## 🚀 Usage

- Open the system in your browser after running `php artisan serve`.  
- Click **“Add New Student”** to create a new student entry.  
- Use **“Edit”** to modify details of an existing student.  
- Use **“Delete”** to remove a student from the list.  
- Navigate between pages using the Laravel routes and Blade templates.  
- All updates automatically reflect in the MySQL database.  

---

## 💻 Screenshots / Code Snippets

- **This is from a Controller**
```php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required']);
        Student::create($request->all());
        return redirect()->route('students.index');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->route('students.index');
    }
}

- **This is from the Migration (Database)**
```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('section')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

- **This is from the Blade View**
```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Add New Student</h1>
    <p>Fill out the form below to add a new student record to the database.</p>

    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="section" placeholder="Section">
        <button type="submit">Save</button>
    </form>

    <a href="{{ route('students.index') }}">Back to Student List</a>
</body>
</html>

---

## 👥 Contributors

| Name | Role | GitHub Branch |
|------|------|----------------|
| Janric Madayag | Developer / Documentation | `feature-branch` |
| D. Garcia | Partner / Repository Owner | `main` |
