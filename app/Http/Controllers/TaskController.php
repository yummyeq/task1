<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Фильтрация по сроку выполнения
        if ($request->has('due_date') && $request->input('due_date') != '') {
            $dueDate = $request->input('due_date');
            $query->whereDate('due_date', $dueDate);
        }
    
        // Сортировка по новизне и старости
        if ($request->has('sort')) {
            if ($request->input('sort') == 'newest') {
                $query->orderBy('created_at', 'desc'); // По новизне
            } elseif ($request->input('sort') == 'oldest') {
                $query->orderBy('created_at', 'asc'); // По старости
            }
        }
    
        // Получить все задачи
        $tasks = $query->get();
    
        return view('tasks.index', compact('tasks'));
    }
    // Отображение формы для создания новой задачи
    public function create()
    {
        return view('tasks.create');
    }

    // Сохранение новой задачи
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'due_date' => 'required|date',
        'status' => 'required|string|in:not_completed,in_progress,completed',
    ]);

    // Используем except для исключения поля _token
    Task::create($request->except('_token'));

    Log::info('Task created:', $request->only(['name', 'description', 'due_date', 'status']));

    return redirect()->route('tasks.index')->with('success', 'Задача успешно добавлена.');
}

    // Показ конкретной задачи
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Форма для редактирования задачи
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Обновление задачи
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'due_date' => 'required|date',
            'status' => 'required|string|in:not_completed,in_progress,completed',
        ]);
    
        // Исключение поля _token из запроса
        $task->update($request->except('_token')); // Применяем исключение
    
        Log::info('Task updated:', $request->only(['name', 'description', 'due_date', 'status']));
    
        return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена.');
    }

    // Удаление задачи
    public function destroy(Task $task)
    {
        $task->delete();
        
        Log::info('Task deleted:', ['id' => $task->id]);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена.');
    }
}

