const modal = document.getElementById('modal');
const modalBody = document.getElementById('modal-body');
const cerrarModal = document.getElementById('cerrar-modal');

function abrirModal() {
    modal.classList.remove('oculto');
}

function cerrar() {
    modal.classList.add('oculto');
    modalBody.innerHTML = '';
}

cerrarModal.addEventListener('click', cerrar);
modal.addEventListener('click', (e) => {
    if (e.target === modal) cerrar();
});

// Botones
document.querySelectorAll('.btn-editar').forEach(boton => {
    boton.addEventListener('click', async () => {
        const id = boton.dataset.id;
        const respuesta = await fetch(`editar.php?id=${id}`);
        const html = await respuesta.text();
        modalBody.innerHTML = html;
        abrirModal();
    });
});

document.querySelectorAll('.btn-notas').forEach(boton => {
    boton.addEventListener('click', async () => {
        const id = boton.dataset.id;
        const respuesta = await fetch(`notas.php?id=${id}`);
        const html = await respuesta.text();
        modalBody.innerHTML = html;
        abrirModal();
    });
});