<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f3ff;
            color: #29213d;
        }

        .navbar {
            background: #6d28d9;
            color: white;
            padding: 20px 0;
            box-shadow: 0 3px 10px rgba(76, 29, 149, 0.2);
        }

        .nav-content {
            width: 90%;
            max-width: 1150px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .nav-subtitle {
            font-size: 14px;
            opacity: 0.85;
        }

        .container {
            width: 90%;
            max-width: 1150px;
            margin: 35px auto;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin: 0 0 8px;
            color: #3b0764;
        }

        .welcome p {
            margin: 0;
            color: #6b6280;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .add-btn {
            background: #7c3aed;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #6d28d9;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(76, 29, 149, 0.08);
            border-left: 5px solid #7c3aed;
        }

        .stat-title {
            color: #766b89;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-number {
            color: #4c1d95;
            font-size: 28px;
            font-weight: bold;
        }

        .alert {
            background: #ede9fe;
            color: #5b21b6;
            border: 1px solid #ddd6fe;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 3px 15px rgba(76, 29, 149, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3e8ff;
            color: #4c1d95;
            padding: 16px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #eee8f5;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: #faf8ff;
        }

        .task-name {
            color: #3b0764;
            font-weight: bold;
        }

        .description {
            color: #6b6280;
            max-width: 250px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 11px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-edit {
            background: #ede9fe;
            color: #6d28d9;
        }

        .btn-edit:hover {
            background: #ddd6fe;
        }

        .btn-status {
            background: #7c3aed;
            color: white;
        }

        .btn-status:hover {
            background: #6d28d9;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .empty h2 {
            color: #4c1d95;
            margin-bottom: 8px;
        }

        .empty p {
            color: #766b89;
        }

        form {
            display: inline;
        }

        @media (max-width: 750px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .top-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="nav-content">
        <div class="logo">💜 Personal Task Manager</div>
        <div class="nav-subtitle">Stay organized. Get things done.</div>
    </div>
</nav>

<div class="container">

    <div class="top-section">
        <div class="welcome">
            <h1>My Tasks</h1>
            <p>Manage your tasks and keep track of your progress.</p>
        </div>

        <a href="{{ route('tasks.create') }}" class="add-btn">
            + Add Task
        </a>
    </div>

    @if(session('success'))
        <div class="alert">
            ✓ {{ session('success') }}
        </div>
    @endif

    @php
        $totalTasks = $tasks->count();
        $pendingTasks = $tasks->where('status', 'Pending')->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();
    @endphp

    <div class="stats">

        <div class="stat-card">
            <div class="stat-title">Total Tasks</div>
            <div class="stat-number">{{ $totalTasks }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Pending</div>
            <div class="stat-number">{{ $pendingTasks }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Completed</div>
            <div class="stat-number">{{ $completedTasks }}</div>
        </div>

    </div>

    <div class="table-container">

        @if($tasks->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>
                                {{ $task->id }}
                            </td>

                            <td>
                                <div class="task-name">
                                    {{ $task->task_name }}
                                </div>
                            </td>

                            <td>
                                <div class="description">
                                    {{ $task->description ?: 'No description' }}
                                </div>
                            </td>

                            <td>
                                @if($task->status === 'Completed')
                                    <span class="status completed">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="status pending">
                                        ● Pending
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $task->due_date ?: 'No due date' }}
                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('tasks.edit', $task) }}"
                                        class="btn btn-edit"
                                    >
                                        ✎ Edit
                                    </a>

                                    <form
                                        action="{{ route('tasks.toggleStatus', $task) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-status"
                                        >
                                            {{ $task->status === 'Pending' ? '✓ Complete' : '↩ Pending' }}
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('tasks.destroy', $task) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                        >
                                            🗑 Delete
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                <div class="empty-icon">📋</div>

                <h2>No tasks yet</h2>

                <p>
                    Start organizing your day by adding your first task.
                </p>

                <a href="{{ route('tasks.create') }}" class="add-btn">
                    + Add Your First Task
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>