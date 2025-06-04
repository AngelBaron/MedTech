# Medtech

**Medtech** es un proyecto desarrollado en Laravel que gestiona funcionalidades relacionadas con el entorno médico/tecnológico.

## 🚀 Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Laravel 10+

## ⚙️ Instalación

Sigue estos pasos para poner en marcha el proyecto localmente:


1. bash git clone https://github.com/tuusuario/medtech.git
2. cd medtech  si ya estas en la carpera desde tu terminal no es necesario este comando
3. cp .env.example .env
4. composer install
5. npm install
6. php artisan key:generate


Configura tu base de datos en el archivo `.env`:

- env
- DB_DATABASE=medtech
- DB_USERNAME=root
- DB_PASSWORD=tu_contraseña


Luego, crea la base de datos (si no existe) y corre las migraciones:

- php artisan migrate


## ▶️ Uso

Para levantar el servidor local de desarrollo:

- php artisan serve
- npm run dev


Y accede a: [http://localhost:8000](http://localhost:8000)

## 🛡️ Seguridad del `.env`

Este proyecto utiliza variables de entorno. **El archivo \`.env\` no se debe compartir ni subir a GitHub.**  
Solo se incluye `.env.example` para que otros puedan crear su propia versión local.

## 👥 Autor

- Angel Barón García  


---

💬 Si necesitas ayuda adicional o tienes dudas, no dudes en abrir un issue o contactarnos.
