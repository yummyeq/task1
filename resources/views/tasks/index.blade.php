@extends('layouts.app')

@section('content')
    <h1 class="mt-4">Список задач</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Форма фильтрации задач -->
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
        <div class="form-row align-items-end">
            <div class="col-auto">
                <label for="due_date">Фильтр по сроку выполнения:</label>
                <input type="date" class="form-control" name="due_date" id="due_date" value="{{ request()->get('due_date') }}">
            </div>
            <div class="col-auto">
                <label for="sort">Сортировать по:</label>
                <select class="form-control" name="sort" id="sort">
                    <option value=""> Выберите </option>
                    <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected' : '' }}>По новизне</option>
                    <option value="oldest" {{ request()->get('sort') == 'oldest' ? 'selected' : '' }}>По старости</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Применить фильтр</button>
            </div>
        </div>
    </form>

    <a class="btn btn-primary mb-2" href="{{ route('tasks.create') }}">Добавить задачу</a>
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Срок выполнения</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr class="task-item">
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('tasks.edit', $task) }}">Редактировать</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
