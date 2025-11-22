<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIKOS</title>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            height: 100%;
            overflow: hidden;
        }
        
        html {
            height: 100%;
        }

        .auth-container {
            display: flex;
            height: 100%;
            min-height: 100%;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 20s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, 20px) rotate(5deg); }
        }

        .left-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 500px;
        }

        .right-panel {
            flex: 1;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px;
            overflow-y: auto;
        }

        .form-container {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-group {
            margin-bottom: 24px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        .input-group input:focus {
            outline: none;
            border-color: #2563eb;
            background: #eff6ff;
        }

        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider::before {
            margin-right: 16px;
        }

        .divider::after {
            margin-left: 16px;
        }

        .social-btn {
            width: 100%;
            padding: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .social-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .switch-form {
            text-align: center;
            margin-top: 28px;
            color: #64748b;
            font-size: 15px;
        }

        .switch-form a {
            color: #2563eb;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-wrapper label {
            font-size: 14px;
            color: #64748b;
            cursor: pointer;
            margin: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        .feature-icon {
            font-size: 36px;
            flex-shrink: 0;
        }

        .toast {
            position: fixed;
            top: 24px;
            right: 24px;
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-left: 4px solid #16a34a;
            z-index: 1000;
            display: none;
            align-items: center;
            gap: 12px;
            min-width: 300px;
        }

        .toast.show {
            display: flex;
            animation: slideIn 0.3s ease;
        }

        .toast.error {
            border-left-color: #dc2626;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 968px) {
            .auth-container {
                flex-direction: column;
            }

            .left-panel {
                padding: 40px 24px;
                min-height: 200px;
            }

            .right-panel {
                padding: 40px 24px;
            }
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
 </head>
 <body>
  <div class="auth-container"><!-- Left Panel -->
   <div class="left-panel">
    <div class="left-content">
     <div style="font-size: 80px; margin-bottom: 24px;">
      🏠
     </div>
     <h1 id="app-title" style="margin: 0 0 16px 0; font-size: 48px; font-weight: 900;">SIKOS</h1>
     <p style="margin: 0 0 48px 0; font-size: 18px; opacity: 0.95; line-height: 1.6;">Sistem Informasi Kos Modern untuk kemudahan pengelolaan dan kenyamanan penghuni</p>
     <div class="feature-item">
      <div class="feature-icon">
       💳
      </div>
      <div style="text-align: left;">
       <h3 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700;">Pembayaran Mudah</h3>
       <p style="margin: 0; font-size: 14px; opacity: 0.9;">Bayar tagihan dengan praktis</p>
      </div>
     </div>
     <div class="feature-item">
      <div class="feature-icon">
       📊
      </div>
      <div style="text-align: left;">
       <h3 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700;">Riwayat Lengkap</h3>
       <p style="margin: 0; font-size: 14px; opacity: 0.9;">Track semua pembayaran Anda</p>
      </div>
     </div>
     <div class="feature-item">
      <div class="feature-icon">
       📝
      </div>
      <div style="text-align: left;">
       <h3 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700;">Laporan Cepat</h3>
       <p style="margin: 0; font-size: 14px; opacity: 0.9;">Submit komplain dengan mudah</p>
      </div>
     </div>
    </div>
   </div><!-- Right Panel - Login Form -->
   <div class="right-panel">
    <div class="form-container">
     <div style="margin-bottom: 40px;">
      <h2 id="login-title" style="margin: 0 0 8px 0; font-size: 32px; font-weight: 800; color: #1e293b;">Masuk ke Akun</h2>
      <p id="subtitle-text" style="margin: 0; font-size: 16px; color: #64748b;">Silakan login untuk melanjutkan</p>
     </div>
     <form action="proses.php?action=login" method="post">
    
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="gagal"){
            echo "<div style='background:#fee2e2; color:#991b1b; padding:10px; border-radius:8px; margin-bottom:15px; text-align:center; font-size:14px;'>Login Gagal! Email atau Password salah.</div>";
        } else if($_GET['pesan']=="daftar_sukses"){
            echo "<div style='background:#dcfce7; color:#166534; padding:10px; border-radius:8px; margin-bottom:15px; text-align:center; font-size:14px;'>Pendaftaran Berhasil! Silakan Login.</div>";
        }
    }
    ?>

    <div class="input-group">
        <label for="login-email">Email</label>
        <div class="input-wrapper">
            <span class="input-icon">📧</span> 
            <input type="email" id="login-email" name="email" placeholder="nama@email.com" required>
        </div>
    </div>

    <div class="input-group">
        <label for="login-password">Password</label>
        <div class="input-wrapper">
            <span class="input-icon">🔒</span> 
            <input type="password" id="login-password" name="password" placeholder="Masukkan password" required>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div class="checkbox-wrapper">
            <input type="checkbox" id="remember-me"> 
            <label for="remember-me">Ingat saya</label>
        </div>
        <a href="#" style="color: #2563eb; font-size: 14px; font-weight: 600; text-decoration: none;">Lupa password?</a>
    </div>

    <button type="submit" class="btn btn-primary"> 
        <span>🚀</span> <span>Masuk</span> 
    </button>
</form>
     <div class="divider">
      atau masuk dengan
     </div><button class="social-btn" onclick="socialLogin('google')">
      <svg width="20" height="20" viewbox="0 0 24 24">
       <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" /><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" /><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" /><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
      </svg><span>Google</span> </button> <button class="social-btn" onclick="socialLogin('facebook')">
      <svg width="20" height="20" viewbox="0 0 24 24">
       <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
      </svg><span>Facebook</span> </button>
     <div class="switch-form">
      Belum punya akun? <a href="#" onclick="goToRegister(event)">Daftar sekarang</a>
     </div>
    </div>
   </div>
  </div><!-- Toast Notification -->
  <div id="toast" class="toast">
   <div id="toast-icon" style="font-size: 32px;">
    ✅
   </div>
   <div>
    <p id="toast-title" style="margin: 0 0 4px 0; font-weight: 700; font-size: 15px;">Berhasil!</p>
    <p id="toast-message" style="margin: 0; font-size: 13px;">Operasi berhasil dilakukan</p>
   </div>
  </div>
  <script>
        const defaultConfig = {
            app_title: "SIKOS",
            login_title: "Masuk ke Akun",
            welcome_text: "Selamat datang kembali!",
            subtitle_text: "Silakan login untuk melanjutkan",
            background_color: "#2563eb",
            card_color: "#ffffff",
            text_color: "#1e293b",
            primary_action_color: "#2563eb",
            secondary_action_color: "#f8fafc",
            font_family: "Inter",
            font_size: 16
        };

        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            if (email && password) {
                showToast('Login Berhasil!', `Selamat datang kembali!`, 'success');
                
                setTimeout(() => {
                    showToast('Redirecting...', 'Mengarahkan ke dashboard...', 'success');
                }, 1500);
            }
        }

        function socialLogin(provider) {
            const providerName = provider.charAt(0).toUpperCase() + provider.slice(1);
            showToast('Social Login', `Login dengan ${providerName} akan segera tersedia`, 'success');
        }

        function showForgotPassword(event) {
            event.preventDefault();
            
            const modal = document.createElement('div');
            modal.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; display: flex; align-items: center; justify-content: center; padding: 20px;';
            modal.innerHTML = `
                <div style="background: white; padding: 32px; border-radius: 16px; max-width: 450px; width: 100%; animation: fadeIn 0.3s ease;">
                    <div style="text-align: center; margin-bottom: 24px;">
                        <div style="font-size: 64px; margin-bottom: 16px;">🔑</div>
                        <h3 style="margin: 0 0 8px 0; font-size: 24px; font-weight: 700; color: #1e293b;">Lupa Password?</h3>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">Masukkan email Anda untuk reset password</p>
                    </div>
                    <form onsubmit="handleForgotPassword(event, this.parentElement.parentElement)">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 14px;">Email</label>
                            <input type="email" id="forgot-email" required style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; box-sizing: border-box;" placeholder="nama@email.com">
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <button type="button" onclick="this.closest('div').parentElement.parentElement.remove()" style="flex: 1; padding: 12px; border: 2px solid #e2e8f0; background: white; border-radius: 10px; cursor: pointer; font-weight: 600; color: #64748b;">Batal</button>
                            <button type="submit" style="flex: 1; padding: 12px; border: none; background: #2563eb; color: white; border-radius: 10px; cursor: pointer; font-weight: 600;">Kirim Link</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);
            
            setTimeout(() => {
                const emailInput = document.getElementById('forgot-email');
                if (emailInput) emailInput.focus();
            }, 100);
        }

        function handleForgotPassword(event, modal) {
            event.preventDefault();
            const email = document.getElementById('forgot-email').value;
            modal.remove();
            showToast('Link Terkirim!', `Link reset password telah dikirim ke ${email}`, 'success');
        }

        function goToRegister(event) {
            event.preventDefault();
            showToast('Redirecting...', 'Mengarahkan ke halaman register...', 'success');
        }

        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const icon = document.getElementById('toast-icon');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');

            if (type === 'error') {
                toast.classList.add('error');
                icon.textContent = '❌';
                toastTitle.style.color = '#991b1b';
                toastMessage.style.color = '#dc2626';
            } else {
                toast.classList.remove('error');
                icon.textContent = '✅';
                toastTitle.style.color = '#166534';
                toastMessage.style.color = '#15803d';
            }

            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 4000);
        }

        async function onConfigChange(config) {
            const customFont = config.font_family || defaultConfig.font_family;
            const baseSize = config.font_size || defaultConfig.font_size;
            const baseFontStack = 'Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif';

            const appTitle = document.getElementById('app-title');
            if (appTitle) {
                appTitle.textContent = config.app_title || defaultConfig.app_title;
                appTitle.style.fontFamily = `${customFont}, ${baseFontStack}`;
                appTitle.style.fontSize = `${baseSize * 3}px`;
            }

            const loginTitle = document.getElementById('login-title');
            if (loginTitle) {
                loginTitle.textContent = config.login_title || defaultConfig.login_title;
                loginTitle.style.fontFamily = `${customFont}, ${baseFontStack}`;
                loginTitle.style.fontSize = `${baseSize * 2}px`;
            }

            const subtitleText = document.getElementById('subtitle-text');
            if (subtitleText) {
                subtitleText.textContent = config.subtitle_text || defaultConfig.subtitle_text;
                subtitleText.style.fontFamily = `${customFont}, ${baseFontStack}`;
                subtitleText.style.fontSize = `${baseSize}px`;
            }

            const bgColor = config.background_color || defaultConfig.background_color;
            const cardColor = config.card_color || defaultConfig.card_color;
            const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;

            const leftPanel = document.querySelector('.left-panel');
            if (leftPanel) {
                leftPanel.style.background = `linear-gradient(135deg, ${bgColor} 0%, ${adjustBrightness(bgColor, -20)} 100%)`;
            }

            const rightPanel = document.querySelector('.right-panel');
            if (rightPanel) {
                rightPanel.style.background = cardColor;
            }

            document.querySelectorAll('.btn-primary').forEach(btn => {
                btn.style.background = primaryColor;
            });

            document.querySelectorAll('h1, h2, h3, p, label, span, a').forEach(el => {
                el.style.fontFamily = `${customFont}, ${baseFontStack}`;
            });
        }

        function adjustBrightness(color, percent) {
            const num = parseInt(color.replace("#",""), 16);
            const amt = Math.round(2.55 * percent);
            const R = (num >> 16) + amt;
            const G = (num >> 8 & 0x00FF) + amt;
            const B = (num & 0x0000FF) + amt;
            return "#" + (0x1000000 + (R<255?R<1?0:R:255)*0x10000 +
                (G<255?G<1?0:G:255)*0x100 +
                (B<255?B<1?0:B:255))
                .toString(16).slice(1);
        }

        if (window.elementSdk) {
            window.elementSdk.init({
                defaultConfig: defaultConfig,
                onConfigChange: onConfigChange,
                mapToCapabilities: (config) => ({
                    recolorables: [
                        {
                            get: () => config.background_color || defaultConfig.background_color,
                            set: (value) => {
                                config.background_color = value;
                                window.elementSdk.setConfig({ background_color: value });
                            }
                        },
                        {
                            get: () => config.card_color || defaultConfig.card_color,
                            set: (value) => {
                                config.card_color = value;
                                window.elementSdk.setConfig({ card_color: value });
                            }
                        },
                        {
                            get: () => config.text_color || defaultConfig.text_color,
                            set: (value) => {
                                config.text_color = value;
                                window.elementSdk.setConfig({ text_color: value });
                            }
                        },
                        {
                            get: () => config.primary_action_color || defaultConfig.primary_action_color,
                            set: (value) => {
                                config.primary_action_color = value;
                                window.elementSdk.setConfig({ primary_action_color: value });
                            }
                        },
                        {
                            get: () => config.secondary_action_color || defaultConfig.secondary_action_color,
                            set: (value) => {
                                config.secondary_action_color = value;
                                window.elementSdk.setConfig({ secondary_action_color: value });
                            }
                        }
                    ],
                    borderables: [],
                    fontEditable: {
                        get: () => config.font_family || defaultConfig.font_family,
                        set: (value) => {
                            config.font_family = value;
                            window.elementSdk.setConfig({ font_family: value });
                        }
                    },
                    fontSizeable: {
                        get: () => config.font_size || defaultConfig.font_size,
                        set: (value) => {
                            config.font_size = value;
                            window.elementSdk.setConfig({ font_size: value });
                        }
                    }
                }),
                mapToEditPanelValues: (config) => new Map([
                    ["app_title", config.app_title || defaultConfig.app_title],
                    ["login_title", config.login_title || defaultConfig.login_title],
                    ["welcome_text", config.welcome_text || defaultConfig.welcome_text],
                    ["subtitle_text", config.subtitle_text || defaultConfig.subtitle_text]
                ])
            });
        }
    </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a03d709b5c8da32',t:'MTc2MzQzMDg2OC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>