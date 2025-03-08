<?php

namespace App\Http\Controllers;

use Exception;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\Feature\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LicensePlateController extends Controller
{
    /**
     * Mostrar formulario para subir imágenes
     */
    public function index()
    {
        return view('matriculas.index');
    }

    /**
     * Procesar la imagen subida para detectar la matrícula
     */
    public function processImage(Request $request)
    {
        // Validación de la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Guardar la imagen subida
            $imagePath = $request->file('image')->store('uploads', 'public');
            $fullPath = Storage::disk('public')->path($imagePath);

            // Inicializar el cliente de Vision API
            $imageAnnotator = new ImageAnnotatorClient([
                'credentials' => json_decode(file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS')), true)
            ]);

            // Leer el contenido de la imagen
            $imageContent = file_get_contents($fullPath);

            // Configurar la detección de texto
            $image = new \Google\Cloud\Vision\V1\Image();
            $image->setContent($imageContent);
            $feature = new \Google\Cloud\Vision\V1\Feature();
            $feature->setType(Type::TEXT_DETECTION);
            $request = new \Google\Cloud\Vision\V1\AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeatures([$feature]);

            // Crear el objeto BatchAnnotateImagesRequest
            $batchRequest = new \Google\Cloud\Vision\V1\BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$request]);

            // Detectar texto en la imagen
            $response = $imageAnnotator->batchAnnotateImages($batchRequest);
            $annotations = $response->getResponses()[0];
            $text = $annotations->getTextAnnotations();

            // Cerrar el cliente
            $imageAnnotator->close();

            // Extraer el texto detectado
            $detectedText = '';
            if (count($text) > 0) {
                $detectedText = $text[0]->getDescription();
            }

            // Extraer posible matrícula usando expresiones regulares
            $licensePlate = $this->extractLicensePlate($detectedText);

            return view('matriculas.resultado', [
                'imagePath' => $imagePath,
                'detectedText' => $detectedText,
                'licensePlate' => $licensePlate
            ]);
        } catch (Exception $e) {
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    /**
     * Extraer matrícula de texto usando patrones comunes
     */
    private function extractLicensePlate($text)
    {
        // Eliminar saltos de línea para procesamiento
        $text = str_replace(["\r", "\n"], ' ', $text);

        // Eliminar todos los espacios en blanco
        $text = str_replace(' ', '', $text);

        // Patrón para matrículas españolas
        // Formato: 0000 AAA o AA 0000 AA
        $patterns = [
            '/\b\d{4}\s*[A-Z]{3}\b/', // 0000 AAA
            '/\b[A-Z]{2}\s*\d{4}\s*[A-Z]{2}\b/', // AA 0000 AA
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                return $matches[0];
            }
        }

        return "No se ha detectado ninguna matrícula válida";
    }
}
