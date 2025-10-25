<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #bdc3c7 0%, #2c3e50 100%);
            min-height: 100vh; padding: 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 40px; }
        h1 {
            color: white; font-size: 2.5rem; font-weight: 300; margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .add-student-btn {
            display: inline-block; background: linear-gradient(135deg,#7f8c8d 0%,#95a5a6 100%);
            color: white; padding: 15px 30px; text-decoration: none; border-radius: 12px;
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
            transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(127,140,141,0.3);
        }
        .add-student-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(127,140,141,0.4); }
        .students-container {
            background: white; border-radius: 20px; padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .search-container { margin-bottom: 30px; position: relative; }
        .search-input {
            width: 100%; padding: 15px 50px 15px 20px; border: 2px solid #dfe6e9;
            border-radius: 12px; font-size: 16px; outline: none; transition: all 0.3s ease;
            background: #fafbfc;
        }
        .search-input:focus { border-color: #7f8c8d; box-shadow: 0 0 0 4px rgba(127,140,141,0.15); }
        .search-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color:#7f8c8d; font-size:18px; }
        .students-grid { display: grid; gap: 20px; grid-template-columns: repeat(auto-fill,minmax(350px,1fr)); }
        .student-card {
            background: linear-gradient(135deg,#f8f9fa 0%,#ffffff 100%);
            border: 2px solid #e0e0e0; border-radius: 16px; padding: 25px;
            transition: all 0.3s ease; position: relative; overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }
        .student-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-color: #7f8c8d; }
        .student-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background: linear-gradient(135deg,#95a5a6,#7f8c8d);
        }
        .student-number { font-size:14px; color:#7f8c8d; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:10px; }
        .student-name { font-size:20px; color:#2c3e50; font-weight:600; margin-bottom:15px; line-height:1.4; }
        .student-actions { display:flex; gap:10px; margin-top:20px; }
        .btn {
            padding:10px 20px; border:none; border-radius:8px; font-size:14px; font-weight:600;
            cursor:pointer; transition:all 0.3s ease; text-decoration:none; text-align:center;
            flex:1; text-transform:uppercase; letter-spacing:0.5px;
        }
        .btn-edit { background: linear-gradient(135deg,#95a5a6 0%,#7f8c8d 100%); color:white; }
        .btn-edit:hover { transform: translateY(-2px); box-shadow:0 5px 15px rgba(127,140,141,0.4); }
        .btn-delete { background: linear-gradient(135deg,#b33939 0%,#6e2c2c 100%); color:white; }
        .btn-delete:hover { transform: translateY(-2px); box-shadow:0 5px 15px rgba(178,57,57,0.4); }
        .delete-form { flex:1; }
        .empty-state { text-align:center; padding:60px 20px; color:#7f8c8d; }
        .empty-icon { font-size:64px; margin-bottom:20px; opacity:0.5; }
        .empty-message { font-size:18px; margin-bottom:30px; }
        .stats-container { display:flex; justify-content:center; gap:30px; margin-bottom:30px; flex-wrap:wrap; }
        .stat-card {
            background:rgba(255,255,255,0.2); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.3);
            border-radius:12px; padding:20px 30px; text-align:center; color:white;
        }
        .stat-number { font-size:2rem; font-weight:700; margin-bottom:5px; }
        .stat-label { font-size:14px; opacity:0.9; text-transform:uppercase; letter-spacing:0.5px; }
        @keyframes slideUp { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
        .modal-overlay {
            display:none; position:fixed; top:0; left:0; right:0; bottom:0;
            background:rgba(0,0,0,0.5); z-index:1000; backdrop-filter:blur(5px);
        }
        .modal {
            position:fixed; top:50%; left:50%; transform:translate(-50%,-50%);
            background:white; border-radius:16px; padding:30px; box-shadow:0 20px 40px rgba(0,0,0,0.3);
            z-index:1001; max-width:400px; width:90%;
        }
        .modal h3 { color:#2c3e50; margin-bottom:15px; font-size:1.5rem; }
        .modal p { color:#7f8c8d; margin-bottom:25px; line-height:1.6; }
        .modal-actions { display:flex; gap:15px; }
        .modal-btn { flex:1; padding:12px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer; transition:all 0.3s ease; }
        .modal-btn-danger { background:linear-gradient(135deg,#b33939 0%,#6e2c2c 100%); color:white; }
        .modal-btn-cancel { background:#ecf0f1; color:#2c3e50; }
        .modal-btn-danger:hover { transform:translateY(-2px); box-shadow:0 5px 15px rgba(178,57,57,0.4); }
        .modal-btn-cancel:hover { transform:translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Students Dashboard</h1>
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number" id="totalStudents">0</div>
                    <div class="stat-label">Total Students</div>
                </div>
            </div>
            <a href="{{ route('students.create') }}" class="add-student-btn">Add New Student</a>
            <a href="{{ route('sections.index') }}" class="add-student-btn" style="margin-left:10px;">Sections List</a>
        </div>

        <div class="students-container">
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search students by name or student number...">
                <span class="search-icon">🔍</span>
            </div>

            <div class="students-grid" id="studentsGrid">
                @forelse($students as $student)
                <div class="student-card" data-student-name="{{ strtolower($student->name) }}" data-student-number="{{ strtolower($student->studentNumber) }}">
                    <div class="student-number">{{ $student->studentNumber }}</div>
                    <div class="student-name">{{ $student->name }}</div>
                    <div class="student-details" style="color:#7f8c8d; font-size:14px;">
                        Year {{ $student->year }} | {{ $student->section->course }} - {{ $student->section->year_level }} - {{ $student->section->section }}
                    </div>
                    <div class="student-actions">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-edit">✏️ Edit</a>
                        <form class="delete-form" action="{{ route('students.destroy', $student->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-delete" onclick="showDeleteModal('{{ $student->name }}', this)">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">👥</div>
                    <div class="empty-message">No students found</div>
                    <a href="{{ route('students.create') }}" class="add-student-btn">Add Your First Student</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete <strong id="studentToDelete"></strong>? This action cannot be undone.</p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="hideDeleteModal()">Cancel</button>
                <button class="modal-btn modal-btn-danger" onclick="confirmDelete()">Delete Student</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', updateStudentCount);
        const searchInput=document.getElementById('searchInput');
        const studentsGrid=document.getElementById('studentsGrid');
        searchInput.addEventListener('input',function(){
            const term=this.value.toLowerCase();
            const cards=document.querySelectorAll('.student-card');
            cards.forEach(c=>{
                const name=c.getAttribute('data-student-name');
                const num=c.getAttribute('data-student-number');
                if(name.includes(term)||num.includes(term)){c.style.display='block';c.style.animation='slideUp 0.3s ease-out';}
                else{c.style.display='none';}
            });
            const visible=[...cards].filter(c=>c.style.display!=='none');
            if(visible.length===0&&term!==''){
                if(!document.getElementById('noResults')){
                    const n=document.createElement('div');
                    n.id='noResults';n.className='empty-state';
                    n.innerHTML=`<div class="empty-icon">🔍</div><div class="empty-message">No students match your search</div>`;
                    studentsGrid.appendChild(n);
                }
            }else{
                const n=document.getElementById('noResults'); if(n) n.remove();
            }
        });
        function updateStudentCount(){document.getElementById('totalStudents').textContent=document.querySelectorAll('.student-card').length;}
        let deleteForm=null;
        function showDeleteModal(name,btn){document.getElementById('studentToDelete').textContent=name;document.getElementById('deleteModal').style.display='block';deleteForm=btn.closest('form');}
        function hideDeleteModal(){document.getElementById('deleteModal').style.display='none';deleteForm=null;}
        function confirmDelete(){ if(deleteForm){ deleteForm.submit(); } hideDeleteModal(); }
        document.getElementById('deleteModal').addEventListener('click',e=>{if(e.target===e.currentTarget) hideDeleteModal();});
        document.addEventListener('keydown',e=>{if(e.key==='Escape') hideDeleteModal();});
    </script>
</body>
</html>
