Tus Mascotas
============

Servicio web que permite reemplazar el sistema de registro de mascotas actual por uno nuevo llamado **Tus mascotas**.

Requerimientos:
- PHP 7
- Symfony 3.4
- MySQL 5.7
- Composer

Pasos para ejecutar:

1. Clonar repositorio
2. Instalar dependencias ``composer install``
3. Configurar conexión con bd en **app/config/parameters.yml**
4. Crear bd ``php bin/console doctrine:database:create``
5. Actualizar schema ``php bin/console doctrine:schema:update --force``
6. Validar schema ``php bin/console doctrine:schema:validate``
7. Crear datos de prueba ``php bin/console doctrine:fixtures:load``
8. Ejecutar app ``php bin/console server:run``

Las credenciales para ingresar son:
- usuario: **admin**
- contraseña: **helloworld**

Se pueden consultar datos de mascota según su chip vía **GET** al endpoint:
- ``/api/1.0/mascota/{chip}``
No requiere autenticación
