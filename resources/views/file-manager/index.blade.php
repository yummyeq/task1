<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Файловый Менеджер</title>
</head>
<body>

    <div class="container mt-5">    <h1>Поиск</h1>
        <form action="{{ route('file-manager.index') }}" method="GET" class="mb-4">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Поиск файлов..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Найти</button>
        </form>
        
        <h2>Результаты поиска</h2>
        @if(request('search'))
            <h5>Файл найден: <strong>{{ request('search') }}</strong></h5>
        @endif
        <br>
        <br>
        <br>
        <br>
        <br>

        <form action="{{ route('file-manager.create-folder') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group mb-2">
                <input type="text" name="name" class="form-control" placeholder="Имя папки" required>
            </div>
            <button type="submit" class="btn btn-success">Создать папку</button>
        </form>
        

        <ul class="list-group">
            @if($files->isEmpty() && request('search'))
                <li class="list-group-item">Файлы не найдены.</li>
            @else
                @foreach($files as $file)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $file->name }}
                        @if($file->folder)
                            <span class="text-muted" style="margin-left: 10px;">(в папке: {{ $file->folder->name }})</span>
                        @else
                            <span class="text-muted" style="margin-left: 10px;">(без папки)</span>
                        @endif
                        <div>
                            <a href="{{ route('file-manager.download', $file->id) }}" class="btn btn-info btn-sm">Скачать</a>
                            <form action="{{ route('file-manager.delete', $file->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
        <br>
        <br>
        <br>
        <br>
        <br>

        <h2>Папки</h2>
        <ul class="list-group mb-4">
            @foreach($folders as $folder)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $folder->name }}
                    <form action="{{ route('file-manager.delete-folder', $folder->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <br>
        <br>
        <br>
        <br>


        <h2>Загрузка файла</h2>
<form action="{{ route('file-manager.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="file" name="file" class="form-control" required>
        <select name="folder_id" class="form-control mt-2">
            <option value="">Без папки</option>
            @foreach($folders as $folder)
                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Загрузить файл</button>
</form>

        

        <br>
        <br>
        <br>
        <br>

        <ul class="list-group">
            @foreach($files as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $file->name }}
                    @if($file->folder)
                        <span class="text-muted" style="margin-left: 10px;">(в папке: {{ $file->folder->name }})</span>
                    @else
                        <span class="text-muted" style="margin-left: 10px;">(без папки)</span>
                    @endif
        
                    <div>
                        <a href="{{ route('file-manager.download', $file->id) }}" class="btn btn-info btn-sm">Скачать</a>
                        <form action="{{ route('file-manager.delete', $file->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Удалить</button>
                        </form>
        
                        <!-- Форма для перемещения файла -->
                        <form action="{{ route('file-manager.move', $file->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <select name="folder_id" class="form-control mt-2" onchange="this.form.submit();">
                                <option value="">Переместить в папку</option>
                                @foreach($folders as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>