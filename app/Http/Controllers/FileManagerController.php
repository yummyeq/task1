<?php

namespace App\Http\Controllers;



use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index(Request $request)
{
    $folders = Folder::where('user_id', Auth::id())->get();
    $filesQuery = File::where('user_id', Auth::id())->with('folder');

    // Проверка на наличие параметра поиска
    if ($request->has('search') && trim($request->input('search')) != '') {
        $search = $request->input('search');
        $filesQuery->where('name', 'LIKE', "%{$search}%");
    }

    $files = $filesQuery->get();

    return view('file-manager.index', compact('folders', 'files'));
}
public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file',
        'folder_id' => 'nullable|exists:folders,id'
    ]);

    $filePath = $request->file('file')->store('files');

    // Сохранение файла без тегов
    File::create([
        'name' => $request->file('file')->getClientOriginalName(),
        'path' => $filePath,
        'user_id' => Auth::id(),
        'folder_id' => $request->folder_id,
    ]);

    return redirect()->route('file-manager.index')->with('success', 'Файл загружен успешно!');
}

    public function delete($id)
    {
        $file = File::findOrFail($id);
        Storage::delete($file->path);
        $file->delete();
        return redirect()->route('file-manager.index');
    }

    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Валидация имени папки
        ]);
    
        // Создание новой папки
        Folder::create([
            'name' => $request->name,
            'user_id' => Auth::id(), // Предполагается, что вы сохраняете папку, принадлежащую текущему пользователю
        ]);
    
        return redirect()->route('file-manager.index')->with('success', 'Папка создана успешно!');
    }

    public function deleteFolder($id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();
        return redirect()->route('file-manager.index');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path('app/' . $file->path));
    }

    public function moveFile(Request $request, $id)
    {
        $request->validate(['folder_id' => 'required|exists:folders,id']);
        $file = File::findOrFail($id);
        $file->folder_id = $request->folder_id; // Устанавливаем новую папку
        $file->save(); // Сохраняем изменения

        return redirect()->route('file-manager.index')->with('success', 'Файл перемещен успешно!'); // Возврат на индекс с сообщением
    }

    
}
