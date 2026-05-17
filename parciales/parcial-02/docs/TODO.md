## TODO

### Seguridad

- [ ] Login rate limiting (proteger endpoint de login contra brute force)
- [ ] Protección IDOR
- [ ] Suprimir errores PHP en producción (`display_errors = Off` en php.ini)
- [ ] Validar que usuario no esté repetido al registrar (error amigable, no excepción PDO)
- [ ] Mínimo 15 caracteres en contraseña, combinación de letras, números y caracteres especiales
- [ ] Sesion y cookie

### Diseño
- [ ] formulario.php asterisco en rojo a todos los campos requeridos del formulario(CSS)
- [ ] modo oscuro




### Jonathan
### Validaciones frontend

- [ ] Validación de cédula panameña con regex `"^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\\d{1,4})-(\\d{1,6})$"`
- [ ] Validación de edad mínima 18 años y máxima 100 años en `fecha_nacimiento`
- [ ] Bloquear caracteres especiales en campos de texto (nombre, apellido, residencia)

### Validaciones backend

- [ ] Revalidar todos los campos en el servidor (no confiar solo en HTML `required`)
- [ ] Sanitizar salidas con `htmlspecialchars()` en vistas de RH (detalle del aspirante)
- [ ] Verificar que `estado` solo acepte valores permitidos: `no_revisado`, `considerado`, `no_considerado`

### Módulo RH (incompleto)

- [✅ ] Vista `rh/home.php` — tabla con lista de todos los aspirantes
- [✅] Vista `rh/detalle.php` — ver datos del aspirante y cambiar estado
- [✅ ] `RhController` — agregar guard de autenticación RH
- [✅] Login de RH con cuentas pre-creadas en BD (so no registro público)
### /Jonathan


### Pruebas (entregar informe)

- [ ] Intentar acceder a `/home` sin sesión → debe redirigir a `/login`
- [ ] Intentar acceder a `/rh/home` sin sesión RH → debe denegar
- [ ] Intentar acceder a `/rh/detalle/{id_ajeno}` con sesión de aspirante → IDOR
- [ ] SQLi en campos de login (`' OR '1'='1`)
- [ ] XSS en campos de texto (`<script>alert(1)</script>` en nombre/apellido)
- [ ] Brute force en login — ¿bloquea después de N intentos?
- [ ] Registrar usuario duplicado — ¿muestra error o explota?
- [ ] Enviar formulario con edad menor de 18 años
- [ ] Enviar formulario con cédula con formato inválido
- [ ] Cambiar `estado` desde el cliente con valor no permitido (`?estado=admin`)

