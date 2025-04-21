# Medtech

**Medtech** es un proyecto desarrollado en Laravel que gestiona funcionalidades relacionadas con el entorno médico/tecnológico.

## 🚀 Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Laravel 10+

## ⚙️ Instalación

Sigue estos pasos para poner en marcha el proyecto localmente:

\`\`\`bash
git clone https://github.com/tuusuario/medtech.git
cd medtech
cp .env.example .env
composer install
php artisan key:generate
\`\`\`

Configura tu base de datos en el archivo `.env`:

\`\`\`env
DB_DATABASE=medtech
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
\`\`\`

Luego, crea la base de datos (si no existe) y corre las migraciones:

\`\`\`bash
php artisan migrate
\`\`\`

## ▶️ Uso

Para levantar el servidor local de desarrollo:

\`\`\`bash
php artisan serve
\`\`\`

Y accede a: [http://localhost:8000](http://localhost:8000)

## 🛡️ Seguridad del `.env`

Este proyecto utiliza variables de entorno. **El archivo \`.env\` no se debe compartir ni subir a GitHub.**  
Solo se incluye `.env.example` para que otros puedan crear su propia versión local.

## 👥 Autores

- Angel Barón García  
- Yorne Alejandrina Santos Bobadilla  
- Selene Nicole Vázquez Castrejón  
- Luis N

---

💬 Si necesitas ayuda adicional o tienes dudas, no dudes en abrir un issue o contactarnos.
