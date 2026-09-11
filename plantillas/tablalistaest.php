<table class="tabla-estudiantes">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Curso</th>
            <th>Año</th>
            <th>Docente</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($estudiantes)): ?>
            <?php foreach ($estudiantes as $estudiante): ?>
                <tr>
                    <td><?php echo htmlspecialchars($estudiante['nombre_est']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['identificacion']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['curso']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['anio']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['profesor_est']); ?></td>

                    <td>
                        <form action="eliminar.php" method="POST" style="display:inline;"
                            onsubmit="return confirm('¿Eliminar a este estudiante?')">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($estudiante['id']); ?>">
                            <button id="eliminar-est" class="opcion-est" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="#3D4772" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>

                    <td>
                        <button type="button" class="opcion-est btn-editar"
                            data-id="<?php echo htmlspecialchars($estudiante['id']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#3D4772" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                    </td>

                    <td>
                        <button type="button" class="opcion-est btn-notas"
                            data-id="<?php echo htmlspecialchars($estudiante['id']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#3D4772" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8"><em>Todavía no hay estudiantes registrados.</em></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>