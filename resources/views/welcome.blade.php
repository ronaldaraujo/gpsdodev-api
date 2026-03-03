<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GPS do Dev | API</title>
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

    <div class="relative z-10 flex flex-col items-center text-center">
        <div class="mb-10 glow rounded-full p-2">
            <img src="{{ asset('logo-light.png') }}" alt="GPS do Dev" class="h-12 object-contain" />
        </div>

        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-4">
            API System
        </h1>
        
        <div class="flex items-center gap-3 bg-white/5 border border-white/10 rounded-full px-5 py-2 mb-8 backdrop-blur-sm">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
            <span class="text-sm font-medium text-green-400 tracking-wide uppercase">Operacional</span>
        </div>

        <p class="max-w-[400px] text-muted text-base leading-relaxed mb-12">
            O ambiente e os serviços da API do GPS do Dev estão ativos e respondendo perfeitamente na nuvem.
        </p>
    </div>

    <footer class="absolute bottom-6 text-center w-full">
        <p class="text-xs text-white/30">&copy; {{ date('Y') }} GPS do Dev. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
