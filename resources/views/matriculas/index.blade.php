<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconocimiento de Matrículas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 2rem;
        }
        .custom-file-input:lang(es)~.custom-file-label::after {
            content: "Buscar";
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Reconocimiento de Matrículas</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('matricula.procesar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="image" class="form-label">Selecciona una imagen de un vehículo</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                <div class="form-text">Formatos admitidos: JPG, PNG. Tamaño máximo: 2MB</div>
                            </div>

                            <div class="mb-3">
                                <div id="imagePreview" class="mt-3 d-none">
                                    <h5>Vista previa:</h5>
                                    <img id="preview" class="img-fluid" style="max-height: 300px;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Reconocer Matrícula</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar vista previa de la imagen
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            
            if (e.target.files.length > 0) {
                preview.src = URL.createObjectURL(e.target.files[0]);
                previewDiv.classList.remove('d-none');
            } else {
                previewDiv.classList.add('d-none');
            }
        });
    </script>
</body>
</html>