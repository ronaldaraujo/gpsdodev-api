<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bússola Profissional - GPS do Dev</title>
    <!-- Tailwind via CDN for spatie/laravel-pdf -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* slate-50 */
            color: #0f172a; /* slate-900 */
        }
        .page-break {
            page-break-after: always;
        }
        /* Custom GPS do Dev accent colors */
        .text-accent { color: #f97316; } /* orange-500 */
        .bg-accent { background-color: #f97316; }
        .border-accent { border-color: #f97316; }
        
        .score-bar {
            height: 12px;
            border-radius: 9999px;
            background-color: #e2e8f0; /* slate-200 */
            overflow: hidden;
        }
        .score-fill {
            height: 100%;
            border-radius: 9999px;
        }
        .score-high { background-color: #22c55e; } /* green-500 */
        .score-medium { background-color: #eab308; } /* yellow-500 */
        .score-low { background-color: #f97316; } /* orange-500 */
    </style>
</head>
<body class="antialiased p-10">

    <!-- Cover Page -->
    <div class="h-screen flex flex-col items-center justify-center text-center">
        <h3 class="text-xl font-bold text-accent uppercase tracking-widest mb-4">GPS do Dev</h3>
        <h1 class="text-5xl font-extrabold text-slate-900 mb-6">Relatório Completo<br/>Bússola Profissional</h1>
        
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 max-w-2xl w-full mx-auto mt-10">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Preparado para</p>
            <h2 class="text-3xl font-bold text-slate-800">{{ $report->name }}</h2>
            <p class="text-slate-500 mt-1">{{ $report->email }}</p>
            
            <div class="mt-8 pt-8 border-t border-slate-100">
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Seu Perfil Principal</p>
                <h3 class="text-2xl font-bold text-accent">{{ $report->profile['label'] }}</h3>
                <p class="text-slate-600 mt-3 text-lg leading-relaxed">{{ $report->profile['description'] }}</p>
            </div>
        </div>
        
        <p class="mt-auto text-sm text-slate-400 pb-10">Gerado em {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="page-break"></div>

    <!-- Overview Page -->
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 border-b-2 border-accent pb-2 inline-block">Visão Geral das Dimensões</h2>
        
        <div class="space-y-6">
            @foreach(['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'] as $dimKey)
                @php 
                    $data = $dimensionsData[$dimKey]; 
                    $scoreClass = $data['score'] >= 75 ? 'score-high' : ($data['score'] >= 40 ? 'score-medium' : 'score-low');
                    $textClass = $data['score'] >= 75 ? 'text-green-600' : ($data['score'] >= 40 ? 'text-yellow-600' : 'text-orange-600');
                @endphp
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">{{ $data['icon'] }}</span>
                            <span class="text-lg font-bold text-slate-800">{{ $data['label'] }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-bold {{ $textClass }}">{{ $data['score'] }}</span>
                            <span class="text-sm text-slate-500 ml-1">/ 100</span>
                        </div>
                    </div>
                    <div class="score-bar w-full">
                        <div class="score-fill {{ $scoreClass }}" style="width: {{ $data['score'] }}%"></div>
                    </div>
                    <p class="mt-2 text-sm font-medium text-slate-500 text-right">{{ $data['level_label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="page-break"></div>

    <!-- Detailed Analysis Pages -->
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold mb-10 border-b-2 border-accent pb-2 inline-block">Análise Profunda e Plano de Ação</h2>
        
        @foreach(['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'] as $index => $dimKey)
            @php $data = $dimensionsData[$dimKey]; @endphp
            
            <div class="mb-12 {{ $index % 2 !== 0 ? 'page-break' : '' }}">
                <div class="bg-white p-8 rounded-2xl shadow-sm border-t-4 border-accent">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                            <span>{{ $data['icon'] }}</span> {{ $data['label'] }}
                        </h3>
                        <div class="bg-slate-100 px-4 py-1.5 rounded-full">
                            <span class="font-bold text-slate-800">Score: {{ $data['score'] }}</span>
                            <span class="text-sm text-slate-500">({{ $data['level_label'] }})</span>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">Diagnóstico Expandido</h4>
                        <p class="text-slate-700 leading-relaxed text-justify">{{ $data['analysis'] }}</p>
                    </div>

                    <div class="mb-8 bg-slate-50 p-6 rounded-xl border border-slate-100">
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Seu Plano de Ação (Próximos 30 dias)</h4>
                        <ul class="space-y-3">
                            @foreach($data['action_plan'] as $idx => $action)
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-accent text-white text-xs font-bold mt-0.5">{{ $idx + 1 }}</span>
                                    <span class="text-slate-700 leading-relaxed">{{ $action }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if(!empty($data['recommended_content']))
                        <div>
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">Leituras Recomendadas (GPS do Dev)</h4>
                            <div class="grid grid-cols-1 gap-3">
                                @foreach($data['recommended_content'] as $content)
                                    <a href="{{ $content['url'] }}" class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 bg-white text-slate-700 text-sm font-medium">
                                        <span class="text-accent">🔗</span>
                                        {{ $content['title'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
