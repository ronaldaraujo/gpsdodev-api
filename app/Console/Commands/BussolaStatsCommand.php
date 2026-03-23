<?php

namespace App\Console\Commands;

use App\Models\BussolaSubmission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BussolaStatsCommand extends Command
{
    protected $signature = 'bussola:stats';
    protected $description = 'Exibe estatísticas gerais das submissões da Bússola Profissional';

    public function handle(): int
    {
        $this->newLine();
        $this->line('  🧭  <fg=cyan;options=bold>Bússola Profissional — Estatísticas</>');
        $this->line('  ' . str_repeat('─', 50));
        $this->newLine();

        // ── Period counts ──
        $total = BussolaSubmission::count();
        $today = BussolaSubmission::whereDate('created_at', Carbon::today())->count();
        $week = BussolaSubmission::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $month = BussolaSubmission::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $linked = BussolaSubmission::whereNotNull('report_request_id')->count();
        $anonymous = $total - $linked;
        $conversionRate = $total > 0 ? round(($linked / $total) * 100, 1) : 0;

        $this->info('  📊 Submissões por Período');
        $this->table(
            ['Período', 'Total'],
            [
                ['Hoje', $today],
                ['Últimos 7 dias', $week],
                ['Últimos 30 dias', $month],
                ['Total geral', $total],
            ]
        );

        $this->info('  🔗 Vinculação');
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Anônimas (sem nome/email)', $anonymous],
                ['Vinculadas (com nome/email)', $linked],
                ['Taxa de conversão', "{$conversionRate}%"],
            ]
        );

        if ($total === 0) {
            $this->warn('  Nenhuma submissão encontrada ainda.');
            return self::SUCCESS;
        }

        // ── Average scores ──
        $dimensions = ['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'];
        $dimensionLabels = [
            'direcao' => '🎯 Direção',
            'construcao' => '🔨 Construção',
            'conexao' => '🤝 Conexão',
            'consciencia' => '🪞 Consciência',
            'evolucao' => '📈 Evolução',
            'equilibrio' => '⚖️  Equilíbrio',
        ];

        $submissions = BussolaSubmission::all();
        $averages = [];

        foreach ($dimensions as $dim) {
            $sum = 0;
            $count = 0;
            foreach ($submissions as $sub) {
                $scores = $sub->scores;
                if (isset($scores[$dim])) {
                    $sum += $scores[$dim];
                    $count++;
                }
            }
            $averages[$dim] = $count > 0 ? round($sum / $count, 1) : 0;
        }

        // Sort to find strongest/weakest
        arsort($averages);
        $strongestDim = array_key_first($averages);
        $weakestDim = array_key_last($averages);

        $this->info('  📈 Média de Scores por Dimensão');
        $scoreRows = [];
        foreach ($averages as $dim => $avg) {
            $bar = str_repeat('█', (int) ($avg / 5)) . str_repeat('░', 20 - (int) ($avg / 5));
            $label = $dimensionLabels[$dim] ?? $dim;
            $indicator = '';
            if ($dim === $strongestDim) $indicator = ' ⬆ mais forte';
            if ($dim === $weakestDim) $indicator = ' ⬇ mais fraca';
            $scoreRows[] = [$label, $avg, $bar . $indicator];
        }
        $this->table(['Dimensão', 'Média', 'Distribuição'], $scoreRows);

        // ── Top profiles ──
        $profileCounts = [];
        foreach ($submissions as $sub) {
            $label = $sub->profile['label'] ?? 'Desconhecido';
            $profileCounts[$label] = ($profileCounts[$label] ?? 0) + 1;
        }
        arsort($profileCounts);
        $topProfiles = array_slice($profileCounts, 0, 5, true);

        $this->info('  🏆 Top 5 Perfis Mais Frequentes');
        $profileRows = [];
        $rank = 1;
        foreach ($topProfiles as $label => $count) {
            $pct = round(($count / $total) * 100, 1);
            $profileRows[] = ["#{$rank}", $label, $count, "{$pct}%"];
            $rank++;
        }
        $this->table(['#', 'Perfil', 'Quantidade', '%'], $profileRows);

        $this->newLine();
        $this->line('  <fg=gray>Dados atualizados em: ' . Carbon::now()->format('d/m/Y H:i:s') . '</>');
        $this->newLine();

        return self::SUCCESS;
    }
}
