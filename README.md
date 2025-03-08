# Guía de Uso: Reconocimiento de Matrículas con Laravel y Google Cloud Vision

# Requisitos Previos

PHP 8.1 o superior
Composer
Cuenta en Google Cloud Platform
Laravel 10
Extensiones PHP: gd, fileinfo, curl

# Documentación Google Cloud Vision

https://cloud.google.com/php/docs/reference/cloud-vision/latest

https://github.com/googleapis/google-cloud-php/tree/main/Vision

https://cloud.google.com/vision/docs?hl=es-419

https://cloud.google.com/php/docs/reference (librerías PHP)

# Crear el Proyecto

composer create-project --prefer-dist laravel/laravel reconocimiento-matriculas "10.0"

# Pasos para configurar Google Cloud Vision API

1. **Crear una cuenta de Google Cloud Platform** (si aún no tienes una)
   - Visita https://cloud.google.com/ y regístrate

2. **Crear un nuevo proyecto en Google Cloud**
   - Ve a la consola de Google Cloud: https://console.cloud.google.com/
   - Crea un nuevo proyecto con un nombre descriptivo (ej. "reconocimiento-matriculas")

3. **Habilitar Cloud Vision API**
   - En la consola de Google Cloud, ve a "APIs y servicios" > "Biblioteca"
   - Busca "Cloud Vision API" y habilítala para tu proyecto

4. **Crear credenciales de servicio**
   - Ve a "APIs y servicios" > "Credenciales"
   - Haz clic en "Crear credenciales" > "Cuenta de servicio"
   - Completa los detalles de la cuenta de servicio y otorga el rol "Cloud Vision User"
   - Crea una clave para esta cuenta de servicio en formato JSON

5. **Guardar el archivo de credenciales**
   - Descarga el archivo JSON de credenciales
   - Guárdalo en la carpeta de tu proyecto Laravel (puedes nombrarlo como `google-credentials.json`)
   - Por seguridad, añade este archivo a tu `.gitignore`


# Arrancar el proyecto

1. Iniciar el Servidor de Desarrollo
php artisan serve

2. Acceder a la Aplicación
Abre tu navegador y visita: http://localhost:8000

# Cómo Usar la Aplicación

Subir una Imagen:

Haz clic en el botón "Seleccionar archivo" para elegir una foto de un vehículo donde se vea claramente la matrícula.
La imagen debe ser clara y la matrícula debe ser visible.
Formatos admitidos: JPG, PNG
Tamaño máximo: 2MB


Procesar la Imagen:

Después de seleccionar la imagen, haz clic en "Reconocer Matrícula"
La aplicación procesará la imagen, que puede tardar unos segundos


Ver Resultados:

El sistema mostrará la imagen procesada
Mostrará la matrícula detectada en un recuadro destacado
También mostrará todo el texto detectado en la imagen

# Consideraciones Técnicas

Ajuste del Patrón de Matrículas
El sistema está configurado para detectar matrículas en formato español. Si necesitas otros formatos, puedes modificar el método extractLicensePlate() en el controlador LicensePlateController.php. Actualmente soporta:

0000 AAA (cuatro números seguidos de tres letras)
AA 0000 AA (dos letras, cuatro números, dos letras)

# Mejoras Posibles

Filtrado de Imágenes: Añadir preprocesamiento de imágenes para mejorar la detección.
Validación Adicional: Añadir validaciones específicas para el país.
Histórico de Búsquedas: Guardar un registro de las búsquedas realizadas.
API REST: Exponer la funcionalidad como una API para integrarla con otras aplicaciones.

# Solución de Problemas
La Matrícula No Se Detecta Correctamente

Asegúrate de que la imagen sea clara y la matrícula esté bien visible
Prueba con una iluminación diferente o un ángulo distinto
Verifica que el formato de matrícula coincida con los patrones configurados

# Error de Autenticación con Google Cloud

Verifica que la ruta a tu archivo de credenciales en .env sea correcta
Asegúrate de que la API esté habilitada en tu proyecto de Google Cloud
Comprueba que la cuenta de servicio tenga los permisos necesarios


# Autor

Asier Martín

Puedes contactarme para cualquier duda al correo asiermgonzalez@gmail.com