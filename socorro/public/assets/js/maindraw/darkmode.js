const temaOscuro = () => {
    document.querySelector('body').setAttribute('data-bs-theme', 'dark');
    document.querySelector('body').classList.add('dark-mode');
}

const temaClaro = () => {
    document.querySelector('body').setAttribute('data-bs-theme', 'light');
    document.querySelector('body').classList.remove('dark-mode');
}

const cambiarTema = () => {
    document.querySelector('body').getAttribute('data-bs-theme') === 'dark' ? temaClaro() : temaOscuro();
}
