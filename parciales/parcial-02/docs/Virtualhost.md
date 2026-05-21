# Configurar VirtualHost en XAMPP (Apache) para proyecto MVC local

**Objetivo:** acceder al proyecto con dominio local limpio  
**Resultado final:** http://parcial2.test/

---

## Paso 1 — Crear dominio local (archivo hosts)

Ruta del archivo:
C:\Windows\System32\drivers\etc\hosts

Abrir Bloc de notas como administrador → abrir el archivo → agregar al final:

127.0.0.1 parcial2.test

Guardar.

Esto crea resolución DNS local:
parcial2.test → 127.0.0.1 → tu PC

---

## Paso 2 — Activar VirtualHosts en Apache

Archivo:
C:\xampp\apache\conf\httpd.conf




Buscar:
#Include conf/extra/httpd-vhosts.conf

Quitar #:
Include conf/extra/httpd-vhosts.conf

Guardar.

---

## Paso 3 — Crear VirtualHost del proyecto

Archivo:
C:\xampp\apache\conf\extra\httpd-vhosts.conf

Agregar al final:

<VirtualHost \*:80>
ServerName parcial2.test
DocumentRoot "C:/xampp/htdocs/DS7/parciales/parcial-02/public"

    <Directory "C:/xampp/htdocs/DS7/parciales/parcial-02/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/parcial2-error.log"
    CustomLog "logs/parcial2-access.log" common

</VirtualHost>

Conceptos:
ServerName → dominio local  
DocumentRoot → carpeta pública del proyecto (public/)  
AllowOverride All → permite .htaccess  
VirtualHost → sitio independiente dentro de Apache

---

## Paso 4 — Reiniciar Apache

XAMPP Control Panel → Stop → Start Apache

---

## Paso 5 — Probar

Abrir navegador:
http://parcial2.test/

Debe cargar public/index.php.

---

## Arquitectura resultante

Antes:
http://localhost/DS7/parciales/parcial-02/public/

Después:
http://parcial2.test/

Apache ahora trata el proyecto como sitio real.  
Front-controller activo → rutas limpias MVC.
