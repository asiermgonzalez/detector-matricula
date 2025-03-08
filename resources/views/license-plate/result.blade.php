<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Reconocimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 2rem;
        }
        .highlight {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0">Resultado del Reconocimiento</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Imagen Analizada</h4>
                                <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid border rounded" alt="Imagen analizada">
                            </div>
                            <div class="col-md-6">
                                <h4>Matrícula Detectada</h4>
                                <div class="highlight">
                                    {{ $licensePlate }}
                                </div>

                                <h5>Texto Completo Detectado</h5>
                                <div class="border p-3 bg-light">
                                    <pre style="white-space: pre-wrap;">{{ $detectedText }}</pre>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('license-plate.index') }}" class="btn btn-primary">
                                Analizar otra imagen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>