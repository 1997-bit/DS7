<?php ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel RH</title>
    <link rel="stylesheet" href="/assets/css/base.css" />
    <link rel="stylesheet" href="/assets/css/home.css" />
    <link rel="icon" type="image/svg+xml" href="/assets/favicons/aspirante.svg" />
    <style>
        /* ══ TABLA DE ASPIRANTES ══════════════════════════════ */
        .tabla-wrapper {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        thead th {
            background: #111827;
            color: #fff;
            padding: 12px 14px;
            text-align: left;
            font-weight: 600;
        }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody tr:hover            { background: #eff6ff; }
        tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        /* ══ BADGE DE ESTADO ══════════════════════════════════ */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
        }
        .badge.no_revisado     { background: #fef3c7; color: #92400e; }
        .badge.considerado     { background: #dcfce7; color: #166534; }
        .badge.no_considerado  { background: #fee2e2; color: #991b1b; }

        /* ══ BOTÓN ACCIÓN ═════════════════════════════════════ */
        .btn-accion {
            padding: 6px 14px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            background: #111827;
            color: #fff;
            transition: background .2s;
        }
        .btn-accion:hover { background: #374151; }

        /* ══ DIALOG ═══════════════════════════════════════════ */
        dialog {
            border: none;
            border-radius: 20px;
            padding: 0;
            width: min(480px, 96vw);
            box-shadow: 0 28px 70px rgba(0,0,0,.4);
            background: #fff;
        }
        dialog::backdrop {
            background: rgba(0,0,0,.6);
            backdrop-filter: blur(4px);
        }
        .dlg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 28px 0;
        }
        .dlg-header h3 { margin: 0; font-size: 1.1rem; color: #111827; }
        .dlg-close {
            width: 32px; height: 32px;
            border: none; background: none;
            font-size: 1rem; color: #6b7280;
            cursor: pointer; border-radius: 8px;
            grid-column: unset !important;
            margin-top: 0 !important;
        }
        .dlg-close:hover { background: #f3f4f6; color: #111827; }
        .dlg-body {
            padding: 20px 28px 28px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .dlg-info p { margin: 4px 0; font-size: 14px; color: #374151; }
        .dlg-info b { color: #111827; }
        .dlg-sep { border: none; border-top: 1px solid #e5e7eb; margin: 0; }

        /* select de estado dentro del dialog */
        #modal-estado {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            outline: none;
            background: #fff;
            box-sizing: border-box;
        }
        #modal-estado:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.2);
        }
        .dlg-actions {
            display: flex;
            gap: 10px;
        }
        .dlg-actions button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            grid-column: unset;
            margin-top: 0;
        }
        .btn-guardar  { background: #111827; color: #fff; }
        .btn-guardar:hover  { background: #000; }
        .btn-cancelar { background: #f3f4f6; color: #111827; }
        .btn-cancelar:hover { background: #e5e7eb; }

        /* sin aspirantes */
        .empty { color: #6b7280; text-align: center; padding: 32px 0; }
    </style>
</head>
<body>
    <?php require BASE_PATH . 'view/partials/navbar.php'; ?>

    <main>
        <h2 class="page-title">Solicitudes de aspirantes</h2>

        <div class="card tabla-wrapper">
            <?php if (empty($aspirantes)): ?>
                <p class="empty">No hay aspirantes registrados aún.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aspirantes as $i => $a):
                            $estado = $a['estado'] ?? 'no_revisado';
                            $label  = match($estado) {
                                'considerado'    => 'Considerado',
                                'no_considerado' => 'No considerado',
                                default          => 'No revisado'
                            };
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($a['nombre'] . ' ' . $a['apellido']) ?></td>
                            <td><?= htmlspecialchars($a['cedula']) ?></td>
                            <td><?= htmlspecialchars($a['correo']) ?></td>
                            <td><?= htmlspecialchars($a['telefono']) ?></td>
                            <td>
                                <span class="badge <?= htmlspecialchars($estado) ?>">
                                    <?= htmlspecialchars($label) ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn-accion"
                                        onclick="abrirModal(<?= htmlspecialchars(json_encode($a)) ?>)">
                                    Ver / Editar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <!-- ══ DIALOG detalle + cambio de estado ══════════════════ -->
    <dialog id="dialog-aspirante">
        <div class="dlg-header">
            <h3 id="modal-titulo">Aspirante</h3>
            <button class="dlg-close" type="button"
                    onclick="document.getElementById('dialog-aspirante').close()"
                    title="Cerrar">✕</button>
        </div>
        <div class="dlg-body">
            <div class="dlg-info" id="modal-info"></div>
            <hr class="dlg-sep" />
            <label style="font-size:14px;font-weight:600;color:#111827;">
                Estado de la solicitud
                <select id="modal-estado" style="margin-top:6px;">
                    <option value="no_revisado">No revisado</option>
                    <option value="considerado">Considerado</option>
                    <option value="no_considerado">No considerado</option>
                </select>
            </label>
            <div class="dlg-actions">
                <button type="button" class="btn-cancelar"
                        onclick="document.getElementById('dialog-aspirante').close()">
                    Cancelar
                </button>
                <button type="button" class="btn-guardar" onclick="guardarEstado()">
                    Guardar
                </button>
            </div>
        </div>
    </dialog>

    <script>
        let aspiranteActual = null;

        function abrirModal(aspirante) {
            aspiranteActual = aspirante;

            document.getElementById('modal-titulo').textContent =
                aspirante.nombre + ' ' + aspirante.apellido;

            document.getElementById('modal-info').innerHTML = `
                <p><b>Cédula:</b> ${aspirante.cedula ?? '—'}</p>
                <p><b>Correo:</b> ${aspirante.correo ?? '—'}</p>
                <p><b>Teléfono:</b> ${aspirante.telefono ?? '—'}</p>
                <p><b>Género:</b> ${aspirante.genero ?? '—'}</p>
                <p><b>Nacionalidad:</b> ${aspirante.nacionalidad ?? '—'}</p>
                <p><b>Residencia:</b> ${aspirante.residencia ?? '—'}</p>
                <p><b>Fecha nac.:</b> ${aspirante.fecha_nacimiento ?? '—'}</p>
            `;

            const sel = document.getElementById('modal-estado');
            sel.value = aspirante.estado ?? 'no_revisado';

            document.getElementById('dialog-aspirante').showModal();
        }

        function guardarEstado() {
            const csrfToken = '<?= Security::generarCsrfToken() ?>';

            fetch('/rh/actualizar_estado', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken
                },
                body: JSON.stringify({
                    id: aspiranteActual.id,
                    estado: document.getElementById('modal-estado').value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.ok) {
                    document.getElementById('dialog-aspirante').close();
                    location.reload();
                } else {
                    alert('Error al guardar. Intenta de nuevo.');
                }
            })
            .catch(() => alert('Error de conexión.'));
        }
    </script>
</body>
</html>