<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — Dunosusa</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body id="auth-standalone">

<main id="auth-page">
    <div class="auth-container">
        <div class="auth-card">

            <div class="auth-header">
                <a href="<?= base_url('welcome/home') ?>" class="auth-logo-link">
                    <img src="<?= base_url('assets/media/logo.png') ?>" alt="Dunosusa" class="auth-logo">
                </a>
            </div>

            <div class="auth-body">
                <h2 class="auth-titulo">Iniciar sesión</h2>

                <?php if(!empty($error_login)): ?>
                    <div class="auth-error"><?= $error_login ?></div>
                <?php endif; ?>

                <form action="<?= base_url('welcome/login') ?>" method="POST" class="auth-form">

                    <div class="auth-campo">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" id="correo" name="correo" required autocomplete="email"
                        maxlength="150">
                    </div>

                    <div class="auth-campo">
                        <label for="password">Contraseña</label>
                        <div class="input-password-wrap">
                            <input type="password" id="password" name="password"
                                   placeholder="••••••••" required autocomplete="current-password"
                                   maxlength="255">

                            <button type="button"
                                    class="btn-toggle-pass"
                                    onclick="togglePass('password', this)"
                                    aria-label="Mostrar contraseña">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="auth-captcha">
                        <div class="g-recaptcha"
                             data-sitekey="<?= RECAPTCHA_SITE_KEY ?>">
                        </div>
                    </div>

                    <button type="submit" name="submit_login" class="auth-btn">Entrar</button>

                    <p class="auth-switch">¿No tienes cuenta?
                        <a href="<?= base_url('welcome/registro') ?>">Regístrate aquí</a>
                    </p>

                </form>
            </div>

        </div>
    </div>
</main>

<script>
function togglePass(inputId, btn) {
    const input = document.getElementById(inputId);

    const iconEye = `
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
    `;

    const iconEyeOff = `
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.8 21.8 0 0 1-3.17 4.36"/>
            <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
        </svg>
    `;

    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = iconEyeOff;
    } else {
        input.type = 'password';
        btn.innerHTML = iconEye;
    }
}
</script>

</body>
</html>