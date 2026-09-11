const inputsInformacion = document.querySelectorAll(".input");
const inputsCalificaciones = document.querySelectorAll(".notas");

inputsInformacion.forEach(input => {
    input.addEventListener(
        "keydown",
        (evt) => {
            const clases = evt.target.name;

            if (clases === 'nombre-estudiante' || clases === 'profesor-estudiante') {
                const unableCharsInput = '0123456789@#$%&*=+_[]{}/\\|;:<>?!¿¡^~`"\'';

                if (unableCharsInput.includes(evt.key)) {
                    evt.preventDefault()
                }
            } else if (clases === 'ano-estudiante') {
                const unableCharsInput = 'e@-#$%&*=+_[]{}/\\|;:<>?!¿¡^~`"\'';

                if (unableCharsInput.includes(evt.key)) {
                    evt.preventDefault()
                }
            } else if (clases === 'curso-estudiante') {
                const unableCharsInput = '@#$%&*=+_[]{}/\\|;:<>?!¿¡^~`"\'';

                if (unableCharsInput.includes(evt.key)) {
                    evt.preventDefault()
                }
            } else if (clases === 'identificacion-estudiante') {
                const unableCharsInput = 'abcdefghijklmnñopqrstuvwxyz@#$%&*=+_[]{}/\\|;:<>?!¿¡^~`"\'';

                if (unableCharsInput.includes(evt.key)) {
                    evt.preventDefault()
                }
            }
        }
    )
})

inputsCalificaciones.forEach(input => {
    input.addEventListener(
        "keydown",
        (evt) => {
            const calificaciones = evt.target.name;
            const unableCharsInput = 'e@-#$%&*=+_[]{}/\\|;:<>?!¿¡^~`"\'';

            if (unableCharsInput.includes(evt.key)) {
                evt.preventDefault();
            }
        })
    }
)

inputsCalificaciones.forEach(input =>
    input.addEventListener('wheel', (event) => {
        event.preventDefault();
    })
);
