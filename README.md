<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/images/logo-blanco.png?raw=true" height="100" />
</p>


# filmxtra

Proyecto propio sin ánimo de lucro y puramente didáctico de una web de cine responsiva con diferentes funcionalidades basada en laravel 11, vue 3 e inertia: 

- Responsividad global para todos los tamaños de pantalla y estilos basada en tailwind y su sistema de clases.
- Login y registro de usuarios basado en breeze de laravel: contraseñas hasheadas, recuperación y modificación de contraseñas, envio de email de validación de cuenta...
- Sistema de control de eventos de laravel aplicado para envío de emails al: registrarse, validar cuenta o borrar cuenta.
- Uso de librerías Node variadas para diferentes funcionalidades: 
  - jquery
  - axios: usuado en varias peticiones como por ejemplo para el sistema de páginación por scrolling con vue useintersectionobserver... 
  - sweetalert2: para embellecer los alerts informativos que usa la web con gifs... 
  - flowbite: componente slider del index 
  - dayjs: para el uso de fechas relativas en la criticas de las películas
- Control vía middleware de las posibilidades de accion de los usuarios: acceso a contenidos que requieren login o validación de email, límite de peticiones por minuto...
- Uso de librerias variadas de composer: 
  - o'auth para el acceso mediante Google/Github...
  - eloquent/sluggable para urls más legibles
- Paginación por scrolling infinita con cursor de laravel en sección top pero también paginación tradicional...
- Elementos reactivos vue3...

Testeada y funcionando

Veamos algunas capturas:

<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/01.png?raw=true" height="400" />
    <br>Pantalla de bienvenida (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/02.png?raw=true" height="400" />
    <br>Pantalla de bienvenida con menú login desplegado (movil)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/03.png?raw=true" height="400" />
    <br>Pantalla de login (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/04.png?raw=true" height="400" />
    <br>Pantalla de registro (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/04b.png?raw=true" height="400" />
    <br>Pantalla de login via google (tablet)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/05.png?raw=true" height="400" />
    <br>Mensaje confirmación registro y email validación enviado
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/06.png?raw=true" height="400" />
    <br>Email validación en bandeja correo 
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/07.png?raw=true" height="400" />
    <br>Email validado, mensaje sweetalert2 de vuelta al index (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/08.png?raw=true" height="400" />
    <br>Seccion top filmxtra, ordenadas por evaluación media y con paginación por scrolling (móvil)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/09.png?raw=true" height="400" />
    <br>Sección valoraciones, con orden por numero de valoraciones y paginación tradicional numeros(escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/10.png?raw=true" height="400" />
    <br>Ficha de película (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/11.png?raw=true" height="400" />
    <br>Ficha de críticas/evaluaciones de película (escritorio)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/12.png?raw=true" height="400" />
    <br>Modal de búsqueda desplegado y mostrando resultados (tablet) 
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/13.png?raw=true" height="400" />
    <br>Ficha críticas película (tablet)
</p>
<br>
<p align="center">
    <img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/screenshots/14.png?raw=true" height="50" />
    <br>Urls SEO friendly 
</p>
<br>




## instalación 
### tienes que tener php, composer, npm y mysql 
#### también puedes hacerlo mediante sail la solución basada en docker de laravel

1. Clona el proyecto (también puedes via ssh dada una configuración adecuada)
```
git clone https://github.com/victorFernandez173/filmXtra-vue.git
cd filmXtra-vue
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
  source /home/TUDIRECTORIODEUSUARIO/RUTADELPROYECTO/public/inserts.sql
 ```
12. Ya puedes probar el proyecto. Pero aun te faltarían cosas por hacer para que todas las funcionalidades vayan bien (te dejo tutoriales ejemplo):
+ Tendrías que configurar la cuenta de email, por ejemplo con gmail (en el código ya estaría todo configurado salvo la variables de entorno correspondientes, por lo que solo tendrías que hacer las gestiones pertienentes con google gmail y configurar dichas variables)
  * Variables a configurar en el .env: MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME.
  
  * Tutorial ejemplo de configuración: https://medium.com/@akhmadshaleh/sending-email-with-laravel-10-and-gmail-49be01c2bc8f



+ También tendrías que configurar o'auth/socialite para que el login se pueda hacer con github o google (+ de lo mismo: las rutas y configuración necesaria ya estarían en el código, solo tendrías que tocar las variables de entorno clave en función de los datos que te den en GitHub):  
  + Variables a configurar: GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET, GITHUB_REDIRECT, GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT.
  + Tutorial de ejemplo: https://dev.to/ashrakt_amin/social-login-with-laravel-socialite-google-and-facebook-37eg
