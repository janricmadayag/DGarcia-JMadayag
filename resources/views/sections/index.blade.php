<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections List</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:linear-gradient(135deg,#bdc3c7 0%,#2c3e50 100%);
            min-height:100vh; padding:20px;
        }
        .container { max-width:1000px; margin:0 auto; }
        h1 {
            text-align:center; color:white; margin-bottom:30px;
            font-size:2.2rem; text-shadow:0 2px 10px rgba(0,0,0,0.3);
        }
        .top-actions {
            display:flex; justify-content:space-between; margin-bottom:20px;
        }
        .btn {
            display:inline-block; padding:10px 20px; border:none; border-radius:8px;
            font-weight:600; cursor:pointer; text-decoration:none; transition:all 0.3s ease;
            text-transform:uppercase; letter-spacing:0.5px;
        }
        .btn-add {
            background:linear-gradient(135deg,#7f8c8d 0%,#95a5a6 100%); color:white;
        }
        .btn-add:hover { transform:translateY(-2px); box-shadow:0 5px 15px rgba(127,140,141,0.4); }
        .btn-back {
            background:#ecf0f1; color:#2c3e50;
        }
        .btn-back:hover { transform:translateY(-2px); }
        table {
            width:100%; border-collapse:collapse; background:white; border-radius:12px; overflow:hidden;
            box-shadow:0 10px 20px rgba(0,0,0,0.15);
        }
        th, td {
            padding:15px; text-align:left; border-bottom:1px solid #e0e0e0;
        }
        th {
            background:linear-gradient(135deg,#95a5a6,#7f8c8d); color:white; font-size:15px; text-transform:uppercase;
        }
        tr:hover td { background:#f9f9f9; }
        .btn-edit {
            background:linear-gradient(135deg,#95a5a6,#7f8c8d); color:white;
            padding:6px 14px; border-radius:6px; font-size:14px;
        }
        .btn-edit:hover { transform:translateY(-2px); }
        .btn-delete {
            background:linear-gradient(135deg,#b33939,#6e2c2c); color:white;
            padding:6px 14px; border-radius:6px; font-size:14px; border:none; cursor:pointer;
        }
        .btn-delete:hover { transform:translateY(-2px); }
        .message {
            text-align:center; margin:20px 0; font-weight:600; color:#27ae60;
        }
        /* Empty state */
        .empty-state {
            background:white; border-radius:16px; padding:40px; text-align:center;
            box-shadow:0 10px 20px rgba(0,0,0,0.15); margin-top:30px;
        }
        .empty-state h2 { color:#2c3e50; margin-bottom:15px; }
        .empty-state p { color:#7f8c8d; margin-bottom:20px; }
        /* Modal styles */
        .modal {
            display:none; position:fixed; z-index:999; left:0; top:0; width:100%; height:100%;
            background:rgba(0,0,0,0.5); justify-content:center; align-items:center;
        }
        .modal-content {
            background:white; padding:25px; border-radius:12px; text-align:center;
            max-width:400px; width:90%; box-shadow:0 10px 25px rgba(0,0,0,0.3);
        }
        .modal-content p { margin-bottom:20px; font-size:16px; color:#2c3e50; }
        .modal-buttons { display:flex; justify-content:space-between; gap:10px; }
        .btn-cancel {
            background:#ecf0f1; color:#2c3e50; flex:1;
            padding:10px; border-radius:8px; border:none; font-weight:600; cursor:pointer;
        }
        .btn-cancel:hover { transform:translateY(-2px); }
        .btn-confirm {
            background:linear-gradient(135deg,#b33939,#6e2c2c); color:white; flex:1;
            padding:10px; border-radius:8px; border:none; font-weight:600; cursor:pointer;
        }
        .btn-confirm:hover { transform:translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sections List</h1>

        <div class="top-actions">
            <a href="{{ route('sections.create') }}" class="btn btn-add">+ Add Section</a>
            <a href="{{ route('students.index') }}" class="btn btn-back">← Students List</a>
        </div>

        @if(session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        @if($sections->count() > 0)
            <table>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
                @foreach($sections as $section)
                <tr>
                    <td>{{ $section->id }}</td>
                    <td>{{ $section->course }}</td>
                    <td>{{ $section->section }}</td>
                    <td>
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn-edit">✏️ Edit</a>
                        <button class="btn-delete" onclick="openModal({{ $section->id }})">🗑️ Delete</button>
                        <form id="delete-form-{{ $section->id }}" action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <div class="empty-state">
                <h2>No Sections Found</h2>
                <p>It looks like you haven’t added any sections yet.</p>
                <a href="{{ route('sections.create') }}" class="btn btn-add">+ Add Your First Section</a>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this section?</p>
            <div class="modal-buttons">
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn-confirm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>

    <script>
        let sectionIdToDelete = null;

        function openModal(sectionId) {
            sectionIdToDelete = sectionId;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeModal() {
            sectionIdToDelete = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        document.getElementById('confirmDelete').addEventListener('click', function () {
            if (sectionIdToDelete) {
                document.getElementById('delete-form-' + sectionIdToDelete).submit();
            }
        });

        window.onclick = function(event) {
            let modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
