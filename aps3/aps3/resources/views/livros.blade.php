<!DOCTYPE html>
<html>
<head>
    <title>Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Livros</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                Novo Livro
            </div>
            <div class="card-body">
                <form action="{{ route('livros.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sinopse</label>
                        <textarea name="sinopse" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ano de Publicação</label>
                        <input type="number" name="ano_publicacao" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <select name="autor_id" class="form-control" required>
                            @foreach($autores as $autor)
                                <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>

        <h2>Lista de Livros</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Sinopse</th>
                    <th>Ano</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livros as $livro)
                    <tr>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->sinopse }}</td>
                        <td>{{ $livro->ano_publicacao }}</td>
                        <td>{{ $livro->autor->nome }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>