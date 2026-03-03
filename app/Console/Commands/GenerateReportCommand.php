<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportRequest;
use App\Services\BussolaReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class GenerateReportCommand extends Command
{
    protected $signature = 'report:generate {id_or_email}';
    protected $description = 'Gera o PDF do Relatório Completo para um pedido específico';

    public function handle(BussolaReportService $bussolaService)
    {
        $idOrEmail = $this->argument('id_or_email');
        
        $requestQuery = ReportRequest::query();
        if (is_numeric($idOrEmail)) {
            $requestQuery->where('id', $idOrEmail);
        } else {
            $requestQuery->where('email', $idOrEmail);
        }

        $reportRequest = $requestQuery->latest()->first();

        if (!$reportRequest) {
            $this->error("Pedido não encontrado para: {$idOrEmail}");
            return Command::FAILURE;
        }

        $this->info("Gerando relatório para {$reportRequest->name} ({$reportRequest->email})...");

        // Prepare extended data
        $dimensionsData = [];
        foreach (['direcao', 'construcao', 'conexao', 'consciencia', 'evolucao', 'equilibrio'] as $dim) {
            $score = $reportRequest->scores[$dim] ?? 0;
            $dimensionsData[$dim] = $bussolaService->getDimensionData($dim, $score);
        }

        $fileName = 'bussola_' . Str::slug($reportRequest->name) . '_' . date('Ymd_His') . '.pdf';
        $pdfPath = storage_path('app/public/reports/' . $fileName);

        if (!is_dir(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0755, true);
        }

        $pdf = Pdf::loadView('reports.bussola', [
            'report' => $reportRequest,
            'dimensionsData' => $dimensionsData,
        ]);
        
        $pdf->save($pdfPath);

        $reportRequest->update([
            'status' => 'generated',
            'pdf_path' => $pdfPath,
        ]);

        $this->info("Relatório PDF gerado com sucesso!");
        $this->info("📍 Caminho local: {$pdfPath}");
        $this->warn("🌐 URL para download: " . url('storage/reports/' . $fileName));

        return Command::SUCCESS;
    }
}
