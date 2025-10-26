<!DOCTYPE html>S
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
        <p style="text-align:center; color:#555; font-size:14px; margin-bottom:20px;">
    Please fill out the form below to register a new student.</p>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:linear-gradient(135deg,#bdc3c7 0%,#2c3e50 100%);
            min-height:100vh; display:flex; justify-content:center; align-items:center; padding:20px;
        }
        .form-container {
            background:white; padding:30px; border-radius:16px;
            box-shadow:0 20px 40px rgba(0,0,0,0.2); max-width:500px; width:100%;
        }
        h1 { text-align:center; color:#2c3e50; margin-bottom:25px; }
        input, select {
            width:100%; padding:12px; margin-bottom:15px; border:2px solid #dfe6e9;
            border-radius:8px; font-size:16px; outline:none; transition:all 0.3s ease;
            background:#fafbfc;
        }
        input:focus, select:focus { border-color:#7f8c8d; box-shadow:0 0 0 4px rgba(127,140,141,0.15); }
        .form-actions { display:flex; gap:10px; }
        button, .btn-cancel {
            flex:1; padding:12px; border:none; border-radius:8px; font-size:15px; font-weight:600;
            cursor:pointer; transition:all 0.3s ease; text-transform:uppercase; letter-spacing:0.5px;
            text-align:center; text-decoration:none;
        }
        .btn-save {
            background:linear-gradient(135deg,#7f8c8d 0%,#95a5a6 100%); color:white;
        }
        .btn-save:hover { transform:translateY(-2px); box-shadow:0 5px 15px rgba(127,140,141,0.4); }
        .btn-cancel {
            background:#ecf0f1; color:#2c3e50; display:flex; justify-content:center; align-items:center;
        }
        .btn-cancel:hover { transform:translateY(-2px); }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <input type="text" name="studentNumber" placeholder="Student Number" required>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contactNumber" placeholder="Contact Number" required>

            <label for="year">Year Level:</label>
            <select name="year" required>
                <option value="">-- Select Year --</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <label for="section_id">Section:</label>
            <select name="section_id" required>
                <option value="">-- Select Section --</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->course }} - Year {{ $section->year_level }} - Section {{ $section->section }}</option>
                @endforeach
            </select>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ route('students.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
