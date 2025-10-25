<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:linear-gradient(135deg,#bdc3c7 0%,#2c3e50 100%);
            min-height:100vh; display:flex; justify-content:center; align-items:center; padding:20px;
        }
        .form-container {
            background:white; padding:30px; border-radius:16px;
            box-shadow:0 20px 40px rgba(0,0,0,0.2); max-width:450px; width:100%;
        }
        h1 { text-align:center; color:#2c3e50; margin-bottom:25px; }
        input {
            width:100%; padding:12px; margin-bottom:15px; border:2px solid #dfe6e9;
            border-radius:8px; font-size:16px; outline:none; background:#fafbfc;
        }
        input:focus { border-color:#7f8c8d; box-shadow:0 0 0 4px rgba(127,140,141,0.15); }
        .form-actions { display:flex; gap:10px; }
        button {
            flex:1; padding:12px; border:none; border-radius:8px; font-size:15px; font-weight:600;
            cursor:pointer; transition:all 0.3s ease; text-transform:uppercase;
        }
        .btn-save {
            background:linear-gradient(135deg,#7f8c8d,#95a5a6); color:white;
        }
        .btn-save:hover { transform:translateY(-2px); box-shadow:0 5px 15px rgba(127,140,141,0.4); }
        .btn-cancel {
            flex:1; display:flex; justify-content:center; align-items:center;
            padding:12px; border-radius:8px; font-size:15px; font-weight:600;
            text-transform:uppercase; text-decoration:none;
            background:#ecf0f1; color:#2c3e50;
            transition:all 0.3s ease;
        }
        .btn-cancel:hover { transform:translateY(-2px); }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Section</h1>
        <form action="{{ route('sections.store') }}" method="POST">
            @csrf
            <input type="text" name="course" placeholder="Course" required>
            <input type="text" name="section" placeholder="Section" required>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ route('sections.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
