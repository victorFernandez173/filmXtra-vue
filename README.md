<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/images/logo-blanco.png?raw=true" height="100" />
</p>


# filmxtra

Proyecto propio sin animo de lucro y puramente didáctico de una web de cine responsiva con diferentes funcionalidades basada en laravel 11, vue 3 e inertia: 

- Login y registro de usuarios con emails de verificacion, bienvenida, eliminación de cuenta...
- Uso de librerías Node variadas para diferentes funcionalidades: jquery, axios, sweetalert2, flowbite, dayjs...
- Responsividad global para todos los tamaños de pantalla
- Estilos con tailwind
- Control vía middleware de las posibilidades de accion de los usuarios
- Uso de librerias variadas de composer: o'auth para el acceso mediante Google/Git...
- Paginación por scrolling infinita con cursor de laravel en sección top pero también paginación tradicional...
- Elementos reactivos vue3...

Testeada y funcionando

Veamos algunas capturas:



## instalación 
### tienes que tener php, composer, npm y mysql 
#### también puedes hacerlo mediante sail la solución basada en docker de laravel

1. Clona el proyecto (también puedes via ssh dada una configuración adecuada)
```
git clone https://github.com/victorFernandez173/filmXtra-vue.git
```
2. Instalar composer dependencias
```
composer install
```
3. Instalar npm dependencias
```
npm install
```
4. Clona el .env.example
```
cp .env.example .env
```
5. Añade las variables necesarias para la configuración 
(te indico las más importantes para que la app funcione, puede que se me pase algo...):
   + DB_USERNAME para tu usuario de bbdd
   + DB_PASSWORD su clave
   + DB_DATABASE el nombre que quieras para la bbdd
6. Genera una clave de app
```
php artisan key:generate
``` 

7. Aplica los inserts (necesarios)
+ En el directorio /public encontraras inserts.sql 
8. Arranca el servidor de desarrollo
```
php artisan serve
```
9. Arranca vite para que los assets se compilen en tiempo real
```
npm run dev
```
10. Aplica las migraciones
```
php artisan migrate
```
11. Aplica los inserts (/public/inserts.sql)
+ Este es un fichero con inserts necesarios para toda la web, puedes por ejemplo aplicarlo desde mysql server:
```
  source /home/TUDIRECTORIODEUSUARIO/RUTADELPROYECTOP/public/inserts.sql
 ```
12. Aun te faltarían cosas por hacer para que todas las funcionalidades del proyecto vayan bien (te dejo tutoriales ejemplo):
+ Tendrías que configurar la cuenta de email, por ejemplo con gmail (en el código ya estaría todo configurado salvo la variables de entorno correspondientes, por lo que solo tendrías que hacer las gestiones pertienentes con google gmail y configurar dichas variables)
  * Variables a configurar en el .env: MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME.
  
  * Tutorial ejemplo de configuración: https://medium.com/@akhmadshaleh/sending-email-with-laravel-10-and-gmail-49be01c2bc8f



+ También tendrías que configurar o'auth/socialite para que el login se pueda hacer con github o google (+ de lo mismo: las rutas y configuración necesaria ya estarían en el código, solo tendrías que tocar las variables de entorno clave en función de los datos que te den en GitHub):  
  + Variables a configurar: GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET, GITHUB_REDIRECT, GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT.
  + Tutorial de ejemplo: https://dev.to/ashrakt_amin/social-login-with-laravel-socialite-google-and-facebook-37eg
