<?php ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="/assets/css/base.css" />
    <link rel="stylesheet" href="/assets/css/home.css" />
    <link rel="icon" type="image/svg+xml" href="/assets/favicons/aspirante.svg" />
    <style>
        /* ══ DIALOG SHELL ══════════════════════════════════════ */
        dialog {
            border: none;
            border-radius: 20px;
            padding: 0;
            width: min(820px, 96vw);
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: 0 28px 70px rgba(0,0,0,.4);
            background: #fff;
        }
        dialog::backdrop {
            background: rgba(0,0,0,.6);
            backdrop-filter: blur(4px);
        }

        /* ══ HEADER ══════════════════════════════════════════== */
        .dlg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 32px 0;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1;
        }
        .dlg-header h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .dlg-close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            background: none;
            font-size: 1rem;
            color: #6b7280;
            cursor: pointer;
            flex-shrink: 0;
            padding: 0;
            margin: 0;
            line-height: 1;
            /* reset button global que lo hace grid-column:span2 */
            grid-column: unset !important;
            margin-top: 0 !important;
        }
        .dlg-close:hover { background: #f3f4f6; color: #111827; }

        /* ══ FORM GRID ═════════════════════════════════════════
           Replica el grid de formulario.css pero SIN tocar body
        ════════════════════════════════════════════════════════ */
        #form-perfil {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 24px;
            padding: 24px 32px 32px;
            width: 100%;
            /* reset de los estilos globales de form en formulario.css */
            box-shadow: none;
            border-radius: 0 0 20px 20px;
            background: #fff;
        }

        #form-perfil label {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        /* asterisco en required (igual que formulario.css) */
        #form-perfil label:has(input[required])::after,
        #form-perfil label:has(select[required])::after {
            content: " *";
            color: #ef4444;
            font-size: 16px;
            font-weight: 800;
            order: -1;
        }
        #form-perfil label input,
        #form-perfil label select { order: 1; }

        #form-perfil input,
        #form-perfil select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            outline: none;
            background: #fff;
            box-sizing: border-box;
        }
        #form-perfil input:focus,
        #form-perfil select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.2);
        }

        /* ══ FULL-WIDTH ELEMENTOS ══════════════════════════════ */
        #form-perfil #legend,
        #form-perfil .dlg-msg,
        #form-perfil .dlg-actions { grid-column: span 2; }

        #form-perfil #legend {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }
        #form-perfil #legend::before { content: "* "; color: #ef0606; font-weight: 800; }

        /* ══ FEEDBACK MSG ══════════════════════════════════════ */
        .dlg-msg {
            font-size: 13px;
            padding: 10px 14px;
            border-radius: 8px;
            display: none;
        }
        .dlg-msg.ok  { background: #dcfce7; color: #166534; display: block; }
        .dlg-msg.err { background: #fee2e2; color: #991b1b; display: block; }

        /* ══ ACTIONS ═══════════════════════════════════════════ */
        .dlg-actions {
            display: flex;
            gap: 10px;
            margin-top: 4px;
        }
        .dlg-actions button {
            flex: 1;
            padding: 13px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: background .2s;
            /* reset grid-column del global */
            grid-column: unset;
            margin-top: 0;
        }
        .btn-guardar { background: #111827; color: #fff; }
        .btn-guardar:hover { background: #000; }
        .btn-cancelar { background: #f3f4f6; color: #111827; }
        .btn-cancelar:hover { background: #e5e7eb; }

        /* ══ RESPONSIVE ════════════════════════════════════════ */
        @media (max-width: 600px) {
            #form-perfil { grid-template-columns: 1fr; }
            #form-perfil #legend,
            #form-perfil .dlg-msg,
            #form-perfil .dlg-actions { grid-column: span 1; }
        }
    </style>
</head>
<body>
    <?php require BASE_PATH . 'view/partials/navbar.php'; ?>

    <main>
        <h2 class="page-title">Mi solicitud</h2>

        <?php if (!$perfil): ?>
            <div class="card">
                <p style="color:#6b7280;margin:0 0 16px;">Sin información registrada.</p>
                <a href="/formulario">Completar formulario</a>
            </div>

        <?php else:
            $estado = $perfil['estado'] ?? 'no_revisado';
            $label  = match($estado) {
                'considerado'    => 'CONSIDERADO',
                'no_considerado' => 'NO CONSIDERADO',
                default          => 'NO REVISADO'
            };
        ?>

            <div class="card">
                <h3>Estado de tu solicitud</h3>
                <div class="estado <?= htmlspecialchars($estado) ?>">
                    <?= htmlspecialchars($label) ?>
                </div>
            </div>

            <div class="card">
                <h3>Datos personales</h3>
                <ul>
                    <li><b>Cédula</b><?= htmlspecialchars($perfil['cedula'])       ?></li>
                    <li><b>Nombre</b><?= htmlspecialchars($perfil['nombre'])       ?></li>
                    <li><b>Apellido</b><?= htmlspecialchars($perfil['apellido'])   ?></li>
                    <li><b>Género</b><?= htmlspecialchars($perfil['genero'])       ?></li>
                    <li><b>Nacionalidad</b><?= htmlspecialchars($perfil['nacionalidad']) ?></li>
                    <li><b>Teléfono</b><?= htmlspecialchars($perfil['telefono'])   ?></li>
                    <li><b>Correo</b><?= htmlspecialchars($perfil['correo'])       ?></li>
                </ul>
                <button type="button" onclick="document.getElementById('dialog-perfil').showModal()">
                    ✏️ Editar perfil
                </button>
            </div>

        <?php endif; ?>
    </main>

    <?php if ($perfil): ?>
    <dialog id="dialog-perfil">

        <div class="dlg-header">
            <h3>Editar perfil</h3>
            <button class="dlg-close" type="button"
                    onclick="document.getElementById('dialog-perfil').close()"
                    title="Cerrar">✕</button>
        </div>

        <form method="POST" action="/perfil" id="form-perfil" autocomplete="on"
              onsubmit="return validarFormulario()">
            <input type="hidden" name="csrf_token" value="<?= Security::generarCsrfToken() ?>">

            <!-- Tipo documento -->
            <label>Tipo de documento
                <select name="tipo_doc" id="tipo_doc" required>
                    <option value="cedula"    <?= ($perfil['tipo_doc'] ?? 'cedula') === 'cedula'    ? 'selected' : '' ?>>Cédula</option>
                    <option value="pasaporte" <?= ($perfil['tipo_doc'] ?? '') === 'pasaporte' ? 'selected' : '' ?>>Pasaporte</option>
                </select>
            </label>

            <!-- Documento -->
            <label>Número de documento
                <input type="text" name="documento" id="documento"
                       value="<?= htmlspecialchars($perfil['cedula']) ?>"
                       autocomplete="off" spellcheck="false" required
                       placeholder="Cédula o pasaporte" />
            </label>

            <!-- Nombre -->
            <label>Nombre
                <input type="text" name="nombre" id="nombre"
                       value="<?= htmlspecialchars($perfil['nombre']) ?>"
                       autocomplete="given-name" spellcheck="false" required
                       placeholder="Miguel" />
            </label>

            <!-- Apellido -->
            <label>Apellido
                <input type="text" name="apellido" id="apellido"
                       value="<?= htmlspecialchars($perfil['apellido']) ?>"
                       autocomplete="family-name" spellcheck="false" required
                       placeholder="Caballero" />
            </label>

            <!-- Estado civil -->
            <label>Estado civil
                <select name="estado_civil">
                    <?php
                    $ec = $perfil['estado_civil'] ?? '';
                    foreach ([''=>'Seleccione','soltero'=>'Soltero(a)','casado'=>'Casado(a)',
                              'divorciado'=>'Divorciado(a)','viudo'=>'Viudo(a)',
                              'union_libre'=>'Unión libre'] as $v => $t):
                    ?>
                        <option value="<?= $v ?>" <?= $ec === $v ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <!-- Género -->
            <label>Género
                <select name="genero" required>
                    <option value="" disabled>Seleccione</option>
                    <option value="masculino" <?= ($perfil['genero'] ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="femenino"  <?= ($perfil['genero'] ?? '') === 'femenino'  ? 'selected' : '' ?>>Femenino</option>
                </select>
            </label>

            <!-- Tipo sangre -->
            <label>Tipo de sangre
                <select name="sangre">
                    <?php
                    $sg = $perfil['tipo_sangre'] ?? '';
                    foreach ([''=>'Seleccione','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-',
                              'AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'] as $v => $t):
                    ?>
                        <option value="<?= $v ?>" <?= $sg === $v ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <!-- Fecha nacimiento -->
            <label>Fecha de nacimiento
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                       autocomplete="bday" required
                       value="<?= htmlspecialchars($perfil['fecha_nacimiento']) ?>" />
            </label>

            <!-- Nacionalidad -->
            <label>Nacionalidad
                <select name="nacionalidad" required>
                    <option value="" disabled>Seleccione país</option>
                    <?php
                    $nac = htmlspecialchars($perfil['nacionalidad']);
                    $paisesHtml = file_get_contents(BASE_PATH . 'view/partials/form/paises.php');
                    echo str_replace("value=\"$nac\">", "value=\"$nac\" selected>", $paisesHtml);
                    ?>
                </select>
            </label>

            <!-- Teléfono -->
            <label>Teléfono
                <input type="tel" inputmode="tel" name="telefono" id="telefono"
                       pattern="[0-9+\-\s]{7,15}" placeholder="1234-1234" required
                       value="<?= htmlspecialchars($perfil['telefono']) ?>" />
            </label>

            <!-- Residencia -->
            <label>Residencia
                <input type="text" name="residencia" id="residencia"
                       spellcheck="true" placeholder="Ciudad, Provincia" required
                       value="<?= htmlspecialchars($perfil['residencia']) ?>" />
            </label>

            <!-- Correo -->
            <label>Correo electrónico
                <input type="email" name="correo" inputmode="email"
                       autocomplete="email" required
                       pattern="^[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$"
                       placeholder="correo@ejemplo.com"
                       value="<?= htmlspecialchars($perfil['correo']) ?>" />
            </label>

            <div id="legend">campos obligatorios</div>

            <div class="dlg-msg" id="dlg-msg"></div>

            <div class="dlg-actions">
                <button type="button" class="btn-cancelar"
                        onclick="document.getElementById('dialog-perfil').close()">
                    Cancelar
                </button>
                <button type="submit" class="btn-guardar">Guardar cambios</button>
            </div>
        </form>
    </dialog>

    <script>
        /* ── Validaciones client-side (mismo regex que PHP) ── */
        const tipoDoc        = document.getElementById('tipo_doc');
        const documento      = document.getElementById('documento');
        const nombre         = document.getElementById('nombre');
        const apellido       = document.getElementById('apellido');
        const residencia     = document.getElementById('residencia');
        const fechaNacimiento = document.getElementById('fecha_nacimiento');

        const regexCedula    = /^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/;
        const regexPasaporte = /^[A-Z0-9]{6,9}$/i;
        const regexTexto     = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

        function validarDocumento() {
            const tipo  = tipoDoc.value;
            const valor = documento.value.trim();
            if (tipo === 'cedula') {
                documento.setCustomValidity(
                    regexCedula.test(valor) ? '' : 'Cédula inválida. Ej: 8-123-456789'
                );
            } else {
                documento.setCustomValidity(
                    regexPasaporte.test(valor) ? '' : 'Pasaporte inválido. 6-9 caracteres alfanuméricos.'
                );
            }
        }

        function validarEdad() {
            const valor = fechaNacimiento.value;
            if (!valor) return;
            const hoy  = new Date();
            const nac  = new Date(valor);
            const diff = hoy.getMonth() - nac.getMonth();
            const edad = hoy.getFullYear() - nac.getFullYear()
                         - (diff < 0 || (diff === 0 && hoy.getDate() < nac.getDate()) ? 1 : 0);
            if (edad < 18)       fechaNacimiento.setCustomValidity('Debes tener al menos 18 años.');
            else if (edad > 100) fechaNacimiento.setCustomValidity('La edad máxima es 100 años.');
            else                 fechaNacimiento.setCustomValidity('');
        }

        function validarTexto(campo) {
            campo.setCustomValidity(
                regexTexto.test(campo.value)
                ? '' : 'No se permiten números ni caracteres especiales.'
            );
        }

        documento.addEventListener('input',  validarDocumento);
        tipoDoc.addEventListener('change',   validarDocumento);
        fechaNacimiento.addEventListener('change', validarEdad);
        nombre.addEventListener('input',     () => validarTexto(nombre));
        apellido.addEventListener('input',   () => validarTexto(apellido));
        residencia.addEventListener('input', () => validarTexto(residencia));

        function validarFormulario() {
            validarDocumento();
            validarEdad();
            validarTexto(nombre);
            validarTexto(apellido);
            validarTexto(residencia);
            return document.getElementById('form-perfil').checkValidity();
        }

        /* ── Feedback de vuelta desde servidor ── */
        (function () {
            const params = new URLSearchParams(window.location.search);
            const msg    = document.getElementById('dlg-msg');
            if (!msg) return;

            const errores = {
                empty:       'Faltan campos obligatorios.',
                cedula:      'Formato de cédula inválido.',
                pasaporte:   'Formato de pasaporte inválido.',
                tipo_doc:    'Tipo de documento no válido.',
                edad:        'Debes tener entre 18 y 100 años.',
                caracteres:  'Nombre o apellido con caracteres no permitidos.',
                correo:      'Correo electrónico inválido.',
                estado_civil:'Estado civil no válido.',
                genero:      'Género no válido.',
                sangre:      'Tipo de sangre no válido.',
            };

            if (params.get('updated') === 'ok') {
                msg.textContent = '✓ Perfil actualizado correctamente.';
                msg.className   = 'dlg-msg ok';
                document.getElementById('dialog-perfil').showModal();
            } else if (params.get('error')) {
                msg.textContent = errores[params.get('error')] ?? 'Error al actualizar.';
                msg.className   = 'dlg-msg err';
                document.getElementById('dialog-perfil').showModal();
            }

            history.replaceState({}, '', '/home');
        })();
    </script>
    <?php endif; ?>

</body>
</html>