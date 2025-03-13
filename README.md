# Proyecto Backend - Sistema de Gestión de Solicitudes

## Descripción
Este proyecto es un sistema de gestión de solicitudes que permite a los usuarios registrar y gestionar solicitudes con candidatos 
y tipos de estudios. Utiliza Laravel 11 como framework backend y SQLite como base de datos.

## Requisitos
- **Laravel 11.x.x**
- **PHP 8.0 o superior**
- **Composer**
- **SQLite3**: Asegúrate de tener SQLite3 instalado en tu sistema. Puedes verificar la instalación ejecutando el siguiente 
comando en tu terminal:

```bash
sqlite3 --version
```

## Instalación

1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/ValeriaAlarcon119/Backend.git
   cd Backend
   ```

2. **Instalar Dependencias**:
   Asegúrate de tener Composer instalado y ejecuta:
   ```bash
   composer install
   ```

3. **Instalar SQLite3**:
(esto teniendo en cuenta la configuracion en .env)
   Si aún no tienes SQLite3 instalado, puedes instalarlo siguiendo las instrucciones específicas para tu sistema operativo:

   - **Para Windows**: Puedes descargar el archivo binario de SQLite desde [sqlite.org](https://www.sqlite.org/download.html) y seguir las instrucciones de instalación.
   - **Para macOS**: Puedes instalar SQLite3 usando Homebrew:
     ```bash
     brew install sqlite
     ```
   - **Para Linux**: Puedes instalar SQLite3 usando el gestor de paquetes de tu distribución. Por ejemplo, en Ubuntu:
     ```bash
     sudo apt-get install sqlite3
     ```

4. **Configurar el Archivo `.env`**:
   Copia el archivo `.env.example` a `.env` y configura la conexión a la base de datos:
   ```bash
   cp .env.example .env
   ```

5. **Configurar CORS y Sanctum**:
   Asegúrate de que el middleware de CORS esté habilitado en `app/Http/Kernel.php` y que Sanctum esté configurado en tu archivo `.env`:
   ```env
   SANCTUM_STATEFUL_DOMAINS=localhost:4200
   SESSION_DRIVER=cookie
   ```

6. **Migrar la Base de Datos**:
   Ejecuta las migraciones para crear las tablas necesarias:
   ```bash
   php artisan migrate --seed
   ```

   Esto también ejecutará el seeder `UserSeeder`, que creará un usuario admin con las siguientes credenciales:
   - **Nombre**: admin
   - **Correo**: admin@gmail.com
   - **Contraseña**: admin123

7. **Iniciar el Servidor**:
   ```bash
   php artisan serve
   ```

   El backend estará disponible en `http://localhost:8000`.

## Rutas y Endpoints

### Registro de Usuario
- **Método**: `POST`
- **Ruta**: `/api/auth/register`
- **Body**:
  ```json
  {
    "name": "Nombre del Usuario",
    "email": "correo@ejemplo.com",
    "password": "contraseña"
  }
  ```

### Inicio de Sesión
- **Método**: `POST`
- **Ruta**: `/api/auth/login`
- **Body**:
  ```json
  {
    "email": "admin@gmail.com",
    "password": "admin123",
    "name": "admin"
  }
  ```
- **Respuesta**: Devuelve un token de acceso que se debe usar para proteger las rutas.

### CRUD Completo de Candidatos
- **Listar Todos los Candidatos**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/candidatos`
  - **Descripción**: Obtiene una lista de todos los candidatos.

- **Crear un Nuevo Candidato**:
  - **Método**: `POST`
  - **Ruta**: `http://localhost:8000/api/candidatos`
  - **Body**:
  ```json
  {
    "nombre": "Nombre",
    "apellido": "Apellido",
    "documento_identidad": "12345678",
    "correo": "correo@ejemplo.com",
    "telefono": "123456789"
  }
  ```

- **Obtener Detalles de un Candidato**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/candidatos/{id}`
  - **Descripción**: Obtiene los detalles de un candidato específico.

- **Actualizar un Candidato**:
  - **Método**: `PUT`
  - **Ruta**: `http://localhost:8000/api/candidatos/{id}`
  - **Body**:
  ```json
  {
    "nombre": "Nuevo Nombre",
    "apellido": "Nuevo Apellido",
    "documento_identidad": "87654321",
    "correo": "nuevo.correo@ejemplo.com",
    "telefono": "987654321"
  }
  ```

- **Eliminar un Candidato**:
  - **Método**: `DELETE`
  - **Ruta**: `http://localhost:8000/api/candidatos/{id}`
  - **Descripción**: Elimina un candidato. Si el candidato está asociado a alguna solicitud, se devuelve un mensaje de error indicando que no se puede eliminar porque está en uso.

### Listado y Detalle de Tipos de Estudio
- **Listar Todos los Tipos de Estudio**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/tipos-estudio`
  - **Descripción**: Obtiene una lista de todos los tipos de estudio.

- **Obtener Detalles de un Tipo de Estudio**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/tipos-estudio/{id}`
  - **Descripción**: Obtiene los detalles de un tipo de estudio específico.

### CRUD de Solicitudes con Filtrado por Estado y Tipo de Estudio
- **Listar Todas las Solicitudes**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/solicitudes?estado=pendiente`
  - **Descripción**: Obtiene una lista de solicitudes filtradas por estado "pendiente".

  - **Ruta**: `http://localhost:8000/api/solicitudes?estado=completado`
  - **Descripción**: Obtiene una lista de solicitudes filtradas por estado "completado".

  - **Ruta**: `http://localhost:8000/api/solicitudes?estado=en_proceso`
  - **Descripción**: Obtiene una lista de solicitudes filtradas por estado "en proceso".

- **Crear una Nueva Solicitud**:
  - **Método**: `POST`
  - **Ruta**: `http://localhost:8000/api/solicitudes`
  - **Body**:
  ```json
  {
    "candidato_id": 1,
    "tipo_estudio_id": 1,
    "estado": "pendiente",
    "fecha_solicitud": "2023-01-01",
    "fecha_completado": null
  }
  ```

- **Obtener Detalles de una Solicitud**:
  - **Método**: `GET`
  - **Ruta**: `http://localhost:8000/api/solicitudes/{id}`
  - **Descripción**: Obtiene los detalles de una solicitud específica.

- **Actualizar una Solicitud**:
  - **Método**: `PUT`
  - **Ruta**: `http://localhost:8000/api/solicitudes/{id}`
  - **Body**:
  ```json
  {
    "estado": "completado" // Cambia el estado de la solicitud
  }
  ```

- **Eliminar una Solicitud**:
  - **Método**: `DELETE`
  - **Ruta**: `http://localhost:8000/api/solicitudes/{id}`
  - **Descripción**: Elimina una solicitud específica.

### Notas Adicionales
- Asegúrate de que las migraciones se hayan ejecutado correctamente para que las tablas existan en la base de datos.
- Puedes utilizar herramientas como **Postman** para probar las consultas y operaciones de inserción a través de la API.

## Ejemplos de Uso con cURL

### Registro de Usuario
```bash
curl -X POST http://localhost:8000/api/auth/register \
-H "Content-Type: application/json" \
-d '{"name": "Nombre del Usuario", "email": "correo@ejemplo.com", "password": "contraseña"}'
```

### Inicio de Sesión
```bash
curl -X POST http://localhost:8000/api/auth/login \
-H "Content-Type: application/json" \
-d '{"email": "admin@gmail.com", "password": "admin123", "name": "admin"}'
en postman, se obtiene un token ejmplo: xDEbYhM8iNzxCXMs1TXiHvfooDUavMHc51WhD9mpf942da29
```

### Crear Solicitud
```bash
curl -X POST http://localhost:8000/api/solicitudes \
-H "Authorization: Bearer xDEbYhM8iNzxCXMs1TXiHvfooDUavMHc51WhD9mpf942da29" \
-H "Content-Type: application/json" \
-d '{"candidato_id": 1, "tipo_estudio_id": 1, "estado": "pendiente", "fecha_solicitud": "2023-01-01", "fecha_completado": null}'
teniendo en cuenta el ejemplo anterior seria: 
```bash /Backend:
curl -X POST http://localhost:8000/api/solicitudes \
-H "Authorization: Bearer xDEbYhM8iNzxCXMs1TXiHvfooDUavMHc51WhD9mpf942da29" \
-H "Content-Type: application/json" \
-d '{"candidato_id": 1, "tipo_estudio_id": 1, "estado": "pendiente", "fecha_solicitud": "2023-01-01", "fecha_completado": null}'
```

## Funcionalidades
- Registro y autenticación de usuarios.
- Gestión de solicitudes con opciones para crear, editar y eliminar.
- Filtrado de solicitudes por estado y tipo de estudio.

## Herramientas Utilizadas
- **Laravel**: Framework PHP para el desarrollo del backend.
- **SQLite**: Base de datos ligera utilizada para el almacenamiento de datos.
- **Bootstrap**: Framework CSS para el diseño de la interfaz.

## Validaciones
- Al intentar eliminar un candidato o un tipo de estudio, se verifica si están asociados a alguna solicitud. 
Si es así, se devuelve un mensaje de error y no se permite la eliminación.

## Configuración de la Base de Datos


#### Versión de SQLite

Asegúrate de tener instalada la versión de **SQLite3** en tu sistema. Puedes verificar la versión instalada ejecutando el siguiente comando en tu terminal:

```bash
sqlite3 --version
```

#### Conexión a la Base de Datos

1. **Archivo de Configuración**:
   - El archivo de configuración de la base de datos se encuentra en el archivo `.env` en la raíz del proyecto. Asegúrate de que las siguientes líneas estén configuradas correctamente:

   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=UbicacionRepositorioClonado\Backend\database\database.sqlite
   ```

   - `DB_CONNECTION`: Debe estar configurado como `sqlite`.
   - `DB_DATABASE`: Especifica la ruta al archivo de la base de datos SQLite. Asegúrate de que la ruta sea correcta y que el archivo `database.sqlite` exista en la ubicación especificada.

2. **Creación de la Base de Datos**:
   - Si el archivo `database.sqlite` no existe, Laravel lo creará automáticamente cuando ejecutes las migraciones. Asegúrate de ejecutar el siguiente comando para crear las tablas necesarias:

   ```bash
   php artisan migrate --seed
   ```

   Esto también ejecutará el seeder `UserSeeder`, que creará un usuario admin con las credenciales predeterminadas.

3. **Verificación de la Conexión**:
   - Una vez que hayas configurado el archivo `.env` y ejecutado las migraciones, puedes verificar que la conexión a la base de datos esté funcionando correctamente al iniciar el servidor de Laravel:

   ```bash
   php artisan serve
   ```

   - El backend estará disponible en `http://localhost:8000`, y podrás interactuar con la base de datos a través de las rutas API definidas.

### Notas Adicionales

- Asegúrate de que el archivo de la base de datos tenga los permisos adecuados para que Laravel pueda leer y escribir en él.
- Si experimentas problemas de conexión, verifica que la ruta al archivo de la base de datos sea correcta y que no haya errores tipográficos en el archivo `.env`.
- Asegúrate de que las migraciones se hayan ejecutado correctamente para que las tablas existan en la base de datos.
- Puedes utilizar herramientas como **Postman** para probar las consultas y operaciones de inserción a través de la API.
- Recuerda salir de la consola de SQLite escribiendo `.exit` o `CTRL + D` cuando hayas terminado.


## Decisiones Técnicas Tomadas

### 1. Elección de SQLite como Base de Datos
- **Razón**: Inicialmente consideré usar MySQL como base de datos, pero opté por SQLite debido a su simplicidad y ligereza. SQLite no requiere la creación de un usuario y contraseña, lo que facilita la configuración y el desarrollo local. Esto permite un ciclo de desarrollo más rápido sin la necesidad de gestionar credenciales de base de datos.





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
