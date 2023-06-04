# Stockage-TPV
Este es el repositorio del proyecto TPV llamado "Stockage-TPV"

Para descargar el proyecto Stockage-TPV ejecuta este comando en tu terminal:

git clone https://github.com/Vicent-C/Stockage-TPV.git

Una vez tengas el repositorio descargado ejecuta el siguiente comando

docker-compose -f .\LAMP-compose.yml up -d

Con el comando harás que los contenedores arranquen, ahora solo tienes que dirigirte a la siguiente ruta en tu navegador:

http:localhost:8000

Te pedirá usuario y contraseña, son los que aparecen en el LAMP-compose.yml, pero, si no lo has visto aquí lo tienes:

Usuario: root
Contraseña: Proj#2023

Una vez accedas a phpMyAdmin deberás importar la copia de seguridad que puedes encontrar en "/Stockage-TPV/BBDD/Backup_BBDD_SQL/03062023_frutería_save.sql"

Ahora para comprobar que ha funcionado solamente debes de ir a:

http://localhost:80

Para iniciar sesión en el TPV necesitarás usuario y contraseña. Puedes crear uno para ti en la tabla "empleado" dentro de "frutería". La contraseña de tu usuario debe estar encriptada con un hash MD5.

Para hacer el hash de la contraseña puedes visitar la siguiente página:

https://www.md5hashgenerator.com/

Otra alternativa es acceder al TPV con las credenciales existentes:

Usuario: vicent
Contraseña: Qwer123

Ahora ya estás dentro del TPV, prueba todas las funcionalidades.
