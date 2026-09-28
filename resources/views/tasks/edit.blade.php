<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task | Personal Task Manager</title>

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
            max-width: 750px;
            margin: 40px auto;
        }

        .back-link {
            display: inline-block;
            color: #6d28d9;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(76, 29, 149, 0.1);
        }

        .card-header {
            margin-bottom: 28px;
        }

        .card-header h1 {
            margin: 0 0 8px;
            color: #4c1d95;
            font-size: 28px;
        }

        .card-header p {
            margin: 0;
            color: #766b89;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4c1d95;
            font-weight: bold;
        }

        .required {
            color: #dc2626;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d8d1e5;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            color: #29213d;
            background: #fff;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px #ede9fe;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .hint {
            display: block;
            margin-top: 6px;
            color: #8b8199;
            font-size: 13px;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 22px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
        }

        .btn-primary:hover {
            background: #6d28d9;
        }

        .btn-secondary {
            background: #ede9fe;
            color: #6d28d9;
        }

        .btn-secondary:hover {
            background: #ddd6fe;
        }

        @media (max-width: 600px) {
            .card {
                padding: 25px 20px;
            }

            .nav-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                text-align: center;
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

    <a href="{{ route('tasks.index') }}" class="back-link">
        ← Back to Tasks
    </a>

    <div class="card">

        <div class="card-header">
            <h1>✏️ Edit Task</h1>
            <p>Update your task information and save your changes.</p>
        </div>

        @if($errors->any())
            <div class="error-box">
                <strong>Please fix the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('tasks.update', $task) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="task_name">
                    Task Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ old('task_name', $task->task_name) }}"
                    placeholder="e.g. Finish Laravel project"
                    required
                >

                @error('task_name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Add some details about your task..."
                >{{ old('description', $task->description) }}</textarea>

                <span class="hint">
                    Optional — add additional information about this task.
                </span>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select id="status" name="status">

                    <option value="Pending"
                        {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>
                        🟡 Pending
                    </option>

                    <option value="Completed"
                        {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>
                        🟢 Completed
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date) }}"
                >

                <span class="hint">
                    Optional — choose a deadline for this task.
                </span>

                @error('due_date')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="buttons">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    ✓ Update Task
                </button>

                <a
                    href="{{ route('tasks.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>