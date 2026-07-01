# Sistema de Gestión de Perfiles

Sistema web administrativo para la gestión de perfiles de usuarios. Desarrollado con PHP 8, MySQL y Bootstrap 5. Implementa un CRUD completo con búsqueda, paginación, validación tanto del lado del cliente como del servidor, y protección CSRF.

## Tecnologías

| Tecnología | Versión | Propósito |
|---|---|---|
| PHP | ^8.0 | Backend y lógica de negocio |
| MySQL | ^8.0 | Base de datos relacional |
| Bootstrap | 5.3.3 | Framework de interfaz de usuario |
| Bootstrap Icons | 1.x | Librería de iconos SVG |
| PDO | — | Capa de abstracción de base de datos |

## Arquitectura

```
php-crud-system/
├── index.php                # Punto de entrada, listado con paginación y búsqueda
├── .env.example             # Plantilla de configuración de entorno
├── config/
│   └── database.php         # Conexión PDO con variables de entorno
├── controllers/
│   ├── guardar.php          # Crear perfil (INSERT)
│   ├── editar.php           # Actualizar perfil (UPDATE)
│   └── eliminar.php         # Eliminar perfil (DELETE)
├── includes/
│   └── functions.php        # Helpers: CSRF, flash messages, validación, saneamiento
├── views/
│   ├── header.php           # Apertura HTML, navbar
│   ├── footer.php           # Scripts, cierre HTML
│   ├── modal_Nuevo.php      # Modal de creación
│   └── modal_Empleado.php   # Modal de edición
├── assets/
│   ├── css/
│   │   └── styles.css       # Estilos personalizados
│   └── js/
│       └── app.js           # Validación Bootstrap + auto-dismiss de alertas
├── sql/
│   └── schema.sql           # Esquema de base de datos con índices
└── README.md
```

### Flujo de trabajo

1. `index.php` lista los perfiles con paginación (10 por página) y búsqueda por nombre, email o documento.
2. Los formularios de creación y edición se renderizan en modales Bootstrap con validación HTML5.
3. Las peticiones POST pasan por `controllers/` donde se validan los datos, se verifica el token CSRF y se ejecuta la consulta parametrizada.
4. Los mensajes de retroalimentación (éxito/error) se muestran mediante sesión flash.

## Instalación

### Requisitos

- PHP >= 8.0 con extensiones `pdo_mysql` y `mbstring`
- MySQL >= 8.0
- Servidor web (Apache / Nginx / PHP Artisan)

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/tuusuario/php-crud-system.git
cd php-crud-system

# 2. Configurar variables de entorno
cp .env.example .env
# Editar .env con las credenciales de tu base de datos

# 3. Importar la base de datos
mysql -u root -p < sql/schema.sql

# 4. Iniciar el servidor de desarrollo
php -S localhost:8000
```

Abrir en el navegador: `http://localhost:8000`

## Base de datos

La tabla `perfiles` almacena la siguiente información:

| Columna | Tipo | Descripción |
|---|---|---|
| id | INT UNSIGNED (PK, AUTO_INCREMENT) | Identificador único |
| nombre_completo | VARCHAR(150) | Nombre completo del perfil |
| documento | VARCHAR(20) | Número de documento |
| email | VARCHAR(100) | Correo electrónico |
| telefono | VARCHAR(20) | Número de teléfono |
| direccion | VARCHAR(255) | Dirección física |
| rol | VARCHAR(50) | Rol (Administrador / Usuario) |
| estado | VARCHAR(20) | Estado (Activo / Inactivo) |
| created_at | TIMESTAMP | Fecha de creación |
| updated_at | TIMESTAMP | Fecha de última actualización |

### Índices

- `idx_email` — búsqueda por correo
- `idx_estado` — filtrado por estado
- `idx_rol` — filtrado por rol

## Variables de Entorno

Crear un archivo `.env` en la raíz con las siguientes variables:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=crud_php
DB_USER=root
DB_PASS=
```

## Capturas

_(Agregar capturas de pantalla aquí)_

| Listado de perfiles | Modal de creación |
|---|---|
| ![Listado](screenshots/listado.png) | ![Crear](screenshots/crear.png) |

| Modal de edición | Búsqueda y paginación |
|---|---|
| ![Editar](screenshots/editar.png) | ![Buscar](screenshots/buscar.png) |

## Mejoras Futuras

- [ ] Autenticación y autorización (login/register con JWT o sesión)
- [ ] Exportación a PDF/Excel
- [ ] Carga de foto de perfil
- [ ] Historial de cambios (auditoría)
- [ ] API REST con endpoints JSON
- [ ] Pruebas unitarias con PHPUnit
- [ ] Roles dinámicos (CRUD de roles desde el panel)
- [ ] Notificaciones por correo electrónico
- [ ] Dashboard con estadísticas y gráficos
- [ ] Modo oscuro

## Autor

**Yennifer Padilla** — [@anomalyco](https://github.com/anomalyco)

---

*Proyecto de portafolio — Junio 2026*
