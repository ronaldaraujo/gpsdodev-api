<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bússola Profissional - GPS do Dev</title>
    <!-- Use Inter font which matches the UI closely -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 20px;
        }
        .page-break {
            page-break-after: always;
        }
        .text-accent { color: #b845cf; }
        .bg-accent { background-color: #b845cf; }
        
        .header-logo {
            text-align: center;
            margin-top: 60px;
            margin-bottom: 30px;
        }
        .main-title {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 40px;
            line-height: 1.2;
        }
        
        .profile-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            margin: 0 auto;
            width: 80%;
            text-align: left;
        }
        .profile-label {
            font-size: 12px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .name {
            font-size: 28px;
            font-weight: bold;
            color: #1e293b;
            margin: 0 0 5px 0;
        }
        .email {
            color: #64748b;
            margin: 0 0 30px 0;
        }
        
        .divider {
            border-top: 1px solid #f1f5f9;
            margin: 30px 0;
        }
        
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            color: #b845cf;
            margin: 0 0 15px 0;
        }
        
        .profile-desc {
            color: #475569;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
        
        .footer {
            margin-top: 80px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            border-bottom: 2px solid #b845cf;
            padding-bottom: 5px;
            margin-bottom: 30px;
            display: inline-block;
        }

        /* Overview Table */
        .overview-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        .overview-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
        }
        .overview-header {
            width: 100%;
            margin-bottom: 10px;
        }
        .overview-icon-label {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }
        .overview-score {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }
        
        .score-bar-container {
            width: 100%;
            height: 12px;
            background-color: #e2e8f0;
            border-radius: 6px;
            margin-bottom: 5px;
        }
        .score-bar-fill {
            height: 12px;
            border-radius: 6px;
        }
        
        .text-high { color: #16a34a; }
        .bg-high { background-color: #22c55e; }
        .text-medium { color: #ca8a04; }
        .bg-medium { background-color: #eab308; }
        .text-low { color: #ea580c; }
        .bg-low { background-color: #f97316; }
        
        .level-label {
            font-size: 12px;
            color: #64748b;
            text-align: right;
        }
        
        /* Detailed Analysis */
        .detail-card {
            background-color: #ffffff;
            border-top: 4px solid #b845cf;
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 40px;
        }
        
        .detail-header-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .detail-title {
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
        }
        .detail-score-badge {
            background-color: #f1f5f9;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            color: #1e293b;
            text-align: right;
        }
        
        .sub-title {
            font-size: 12px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        
        .analysis-text {
            color: #334155;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: justify;
        }
        
        .action-plan-box {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .action-item-table {
            width: 100%;
            margin-bottom: 15px;
        }
        .action-number {
            width: 24px;
            height: 19px;
            padding-top: 5px;
            background-color: #b845cf;
            color: #ffffff;
            border-radius: 12px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            vertical-align: middle;
        }
        .action-text {
            padding-left: 15px;
            color: #334155;
            line-height: 1.5;
            vertical-align: top;
        }
        
        .link-item {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 15px;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #334155;
            display: block;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Cover Page -->
    <div>
        <div class="header-logo"><img src="{{ public_path('logo-light.png') }}" height="45" alt="GPS do Dev"></div>
        <div class="main-title">Relatório Completo<br/>Bússola Profissional</div>
        
        <div class="profile-box">
            <div class="profile-label">Preparado para</div>
            <div class="name">{{ $report->name }}</div>
            <div class="email">{{ $report->email }}</div>
            
            <div class="divider"></div>
            
            <div class="profile-label">Seu Perfil Principal</div>
            <div class="profile-name">{{ $report->profile['label'] }}</div>
            <div class="profile-desc">{{ $report->profile['description'] }}</div>
        </div>
        
        <div class="footer">Gerado em {{ now()->format('d/m/Y') }}</div>
    </div>

    <div class="page-break"></div>

    <!-- Overview Page -->
    <div>
        <div class="section-title">Visão Geral das Dimensões</div>
        
        @foreach(['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'] as $dimKey)
            @php 
                $data = $dimensionsData[$dimKey]; 
                $scoreClass = $data['score'] >= 75 ? 'bg-high' : ($data['score'] >= 40 ? 'bg-medium' : 'bg-low');
                $textClass = $data['score'] >= 75 ? 'text-high' : ($data['score'] >= 40 ? 'text-medium' : 'text-low');
            @endphp
            <div class="overview-card" style="margin-bottom: 20px;">
                <table class="overview-header">
                    <tr>
                        <td class="overview-icon-label">
                            <img src="{{ public_path('icons/' . $dimKey . '.svg') }}" width="20" height="20" style="vertical-align: -4px; margin-right: 6px; fill: #1e293b;">
                            {{ $data['label'] }}
                        </td>
                        <td class="overview-score {{ $textClass }}">{{ $data['score'] }} <span style="font-size: 14px; color: #64748b;">/ 100</span></td>
                    </tr>
                </table>
                <div class="score-bar-container">
                    <div class="score-bar-fill {{ $scoreClass }}" style="width: {{ $data['score'] }}%"></div>
                </div>
                <div class="level-label">{{ $data['level_label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="page-break"></div>

    <!-- Detailed Analysis Pages -->
    <div>
        <div class="section-title">Análise Profunda e Plano de Ação</div>
        
        @foreach(['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'] as $index => $dimKey)
            @php $data = $dimensionsData[$dimKey]; @endphp
            
            <div class="detail-card">
                <table class="detail-header-table">
                    <tr>
                        <td class="detail-title">
                            <img src="{{ public_path('icons/' . $dimKey . '.svg') }}" width="22" height="22" style="vertical-align: -4px; margin-right: 6px;"> 
                            {{ $data['label'] }}
                        </td>
                        <td align="right">
                            <div class="detail-score-badge">
                                Score: {{ $data['score'] }} <span style="font-size: 12px; font-weight: normal; color: #64748b;">({{ $data['level_label'] }})</span>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <div class="sub-title">Diagnóstico Expandido</div>
                <div class="analysis-text">{{ $data['analysis'] }}</div>

                <div class="action-plan-box">
                    <div class="sub-title">Seu Plano de Ação (Próximos 30 dias)</div>
                    @foreach($data['action_plan'] as $idx => $action)
                        <table class="action-item-table">
                            <tr>
                                <td width="30" valign="top"><div class="action-number">{{ $idx + 1 }}</div></td>
                                <td class="action-text" valign="top">{{ $action }}</td>
                            </tr>
                        </table>
                    @endforeach
                </div>

                @if(!empty($data['recommended_content']))
                    <div>
                        <div class="sub-title">Leituras Recomendadas (GPS do Dev)</div>
                        @foreach($data['recommended_content'] as $content)
                            <a href="{{ $content['url'] }}" class="link-item">
                                <img src="{{ public_path('icons/link.svg') }}" width="16" height="16" style="vertical-align: -2px; margin-right: 6px; fill: #b845cf;">
                                {{ $content['title'] }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            
            @if($index % 2 !== 0 && $index !== 5)
                <div class="page-break"></div>
            @endif
        @endforeach
    </div>

</body>
</html>
