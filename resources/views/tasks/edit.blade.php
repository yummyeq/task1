<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Редактировать задачу</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название задачи</label>
            <input type="text" class="form-control" name="name" value="{{ $task->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" required>{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Срок выполнения</label>
            <input type="date" class="form-control" name="due_date" value="{{ $task->due_date }}" required>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status">
                <option value="not_completed" {{ $task->status == 'not_completed' ? 'selected' : '' }}>Не выполнена</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>Выполняется</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Выполнена</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Обновить задачу</button>
        <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Назад</a>
    </form>
</div>
</body>
</html>
