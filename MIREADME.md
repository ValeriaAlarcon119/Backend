# Backend - Laravel 11

## Descripción
Este es el backend de un sistema de gestión de solicitudes de estudios de seguridad desarrollado en Laravel 11. Proporciona una API RESTful para interactuar con el frontend.

## Requerimientos
- PHP 8.0 o superior
- Composer
- MySQL o cualquier base de datos compatible

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu_usuario/backend.git
   cd backend
   ```

2. Instala las dependencias:
   ```bash
   composer install
   ```

3. Configura el archivo `.env`:
   - Copia el archivo de ejemplo:
     ```bash
     cp .env.example .env
     ```
   - Configura la conexión a la base de datos en el archivo `.env`.

4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

5. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```

6. Inicia el servidor:
   ```bash
   php artisan serve
   ```

## Endpoints

- **Candidatos**
  - `GET /api/candidatos`: Listar todos los candidatos.
  - `POST /api/candidatos`: Crear un nuevo candidato.
  - `PUT /api/candidatos/{id}`: Actualizar un candidato existente.
  - `DELETE /api/candidatos/{id}`: Eliminar un candidato.

- **Tipos de Estudio**
  - `GET /api/tipos-estudio`: Listar todos los tipos de estudio.

- **Solicitudes**
  - `GET /api/solicitudes`: Listar todas las solicitudes.
  - `POST /api/solicitudes`: Crear una nueva solicitud.
  - `PUT /api/solicitudes/{id}`: Cambiar el estado de una solicitud.

## Autenticación
- Implementa autenticación mediante Laravel Sanctum. Puedes iniciar sesión con el usuario `admin/admin`.

## Pruebas
Puedes probar los endpoints utilizando Postman. Asegúrate de enviar el token de autenticación en los encabezados de las solicitudes.

## Tecnologías Utilizadas
- Laravel 11
- Sanctum para autenticación
- MySQL

## Credenciales de Prueba
- Usuario: `admin`
- Contraseña: `admin`
