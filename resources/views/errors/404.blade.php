<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GPS do Dev | API - 404</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: {
                        background: '#09090b',
                        foreground: '#fafafa',
                        accent: '#b845cf',
                        muted: '#71717a'
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #09090b; color: #fafafa; }
        .glow { box-shadow: 0 0 120px 30px rgba(184, 69, 207, 0.15); }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
    <!-- Background Decorators -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-accent/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 flex flex-col items-center text-center w-full max-w-lg">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-block transition-transform hover:scale-105">
                <img src="{{ asset('logo-light.png') }}" alt="GPS do Dev" class="h-10 object-contain mx-auto" />
            </a>
        </div>

        <div class="relative flex items-center justify-center py-6 w-full">
            <div class="absolute inset-0 bg-accent/20 blur-[60px] rounded-full pointer-events-none"></div>
            <h1 class="relative text-[120px] font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-br from-white to-white/40 leading-none">
                404
            </h1>
        </div>

        <div class="flex flex-col items-center mt-2 mb-8 gap-2">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white mb-2">
                Rota não encontrada
            </h2>
            <p class="text-muted text-base leading-relaxed px-4">
                Parece que você informou coordenadas erradas para nossa API. Este endpoint não existe no sistema do GPS do Dev.
            </p>
        </div>

        <a href="{{ url('/') }}" class="group relative inline-flex items-center justify-center px-8 py-3 font-semibold text-white transition-all bg-white/5 border border-white/10 rounded-full hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-background overflow-hidden">
            <div class="absolute inset-0 w-full h-full -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <span class="relative flex items-center justify-center gap-2">
                Documentação da API
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </span>
        </a>
    </div>

    <footer class="absolute bottom-6 text-center w-full">
        <p class="text-xs text-white/30">&copy; {{ date('Y') }} GPS do Dev. Todos os direitos reservados.</p>
    </footer>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</body>
</html>
