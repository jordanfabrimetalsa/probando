    let deferredPrompt;
    const installBtn = document.getElementById('btnInstall');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        installBtn.style.display = 'flex';
    });

    installBtn.addEventListener('click', async () => {
        if (!deferredPrompt) return;

        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;

        if (outcome === 'accepted') {
            console.log('Usuario instaló la app');
        }

        deferredPrompt = null;
        installBtn.style.display = 'none';
    });
