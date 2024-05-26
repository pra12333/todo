<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .header .logout {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .task-list {
            list-style-type: none;
            padding: 0;
        }
        .task-item {
            display: flex;
            align-items: center;
            padding: 5px 0;
        }
        .task-item input[type="checkbox"] {
            margin-right: 10px;
        }
        .task-item .delete {
            margin-left: auto;
            background-color: transparent;
            border: none;
            color: #999;
            cursor: pointer;
        }
        .new-task {
            display: flex;
            margin-bottom: 10px;
        }
        .new-task input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            margin-right: 10px;
        }
        .new-task button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        .task-item.completed span {
            color: gray;
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Todo List</h1>
        <div>
            <span>{{ Auth::user()->name }}</span>
            <a href='logout' class="logout">Log out</a>
        </div>
    </div>
    <form action="/savetask" method="post">
        @csrf
        <div class="new-task">
            <input type="text" name="task" placeholder="New task">
            <button type="submit">Add Task</button>
        </div>
    </form>
    
    <ul class="task-list">
        @foreach ($tasks as $task)
            <li class="task-item {{ $task->status == 'completed' ? 'completed' : '' }}">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="status" {{ $task->status == 'completed' ? 'checked' : '' }} onChange="this.form.submit()">
                    <span>{{ $task->task }}</span>
                </form>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    &nbsp;&nbsp;<button type="submit" class="delete">✖</button>
                </form>
            </li>
        @endforeach
    </ul>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "{{ session('success') }}",
              showConfirmButton: false,
              timer: 1500
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "{{ session('error') }}",
              showConfirmButton: false,
              timer: 1500
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const taskItems = document.querySelectorAll('.task-item');

            taskItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const taskText = item.querySelector('span');

                // Initial check for already checked items
                if (checkbox.checked) {
                    item.classList.add('completed');
                }

                // Add event listener for checkbox change
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        item.classList.add('completed');
                    } else {
                        item.classList.remove('completed');
                    }
                });
            });
        });
    </script>
    
</body>
</html>
