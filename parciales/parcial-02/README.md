# Examen Parcial #2

Valor total: 100 puntos.

### Asignación

Crear una aplicación web en php, para el personal de Recursos Humanos (RH) que desea
automatizar el registro de aspirantes que buscan laborar en la compañía.  
El aspirante puede crear una cuenta con usuario y contraseña. Luego de iniciar sesión le
aparecerá un formulario donde debe llenar los datos que requiere el personal de recursos
humanos que son: Cédula o pasaporte(obiligatorio), nombre(obiligatorio), apellido
(obiligatorio), estado civil, género (obiligatorio), tipo de sangre, fecha de nacimiento
(obiligatorio), nacionalidad (obiligatorio), teléfono (obiligatorio), residencia (obiligatorio),
correo electrónico (obiligatorio). El aspirante puede acceder a su cuenta para poder
actualizar su información. Y el personal de RH debe poder ver las solicitudes de empleo y
decidir cambiar el estado de una solicitud “no considerado”, “no revisado” y “considerado”.
El estado del registro nuevo guardado por el aspirante por defecto es “no revisado”.

### Indicaciones

- Validar que el usuario introduzca adecuadamente sus datos en los distintos
  campos.
- Validar que el usuario no esté repetido.
- Las contraseñas utilizadas deben ser seguras por ejemplo: uso de cifrado,
  15 caracteres mínimo, combinación de números, letras y caracteres
  especiales.
- Protección contra XSS, SQLi, IDOR, Fuerza Bruta, y no mostrar errores que
  expongan información sobre el entorno de la aplicación.

### Evaluación

- Durante la clase, se llamarán a los grupos de 2 en 2 aleatoriamente, Un grupo
  presentará su aplicación y el otro grupo hará las pruebas de la aplicación
  presentada. Cada grupo tendrá un turno para presentar la aplicación desarrollada y
  un turno para realizar pruebas.
- Serán evaluados de forma grupal.
- Presentar la aplicación y que la misma responda adecuadamente a las distintas
  pruebas. 50 pts
- Poner a prueba la aplicación en presentación para hallar fallas ya sean de seguridad
  o de introducción de datos, cada grupo contará con un máximo de 15 minutos para
  realizar sus pruebas. Las pruebas ya deben estar previamente listadas y
  programadas por el grupo; no se permite improvisar en las pruebas. Entregar un
  informe de las pruebas realizadas y el resultado. 50 pts.
