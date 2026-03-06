# GPS do Dev — API (Backend)

## Stack Técnica

- **Framework:** Laravel 12
- **PHP:** 8.3+
- **Banco de Dados:** MySQL (via Docker / Sail)
- **PDF:** DomPDF (barryvdh/laravel-dompdf)
- **Autenticação:** Laravel Sanctum
- **Ambiente Local:** Laravel Sail (`./vendor/bin/sail`)

## Estrutura Principal

```
api/
├── app/
│   ├── Console/Commands/     # Artisan commands customizados
│   ├── Http/Controllers/     # Controllers da API
│   ├── Models/               # Eloquent models
│   ├── Providers/            
│   └── Services/             # Business logic (ex: BussolaReportService)
├── database/migrations/      # Migrações do banco
├── resources/views/reports/  # Templates Blade para PDFs
├── routes/api.php            # Rotas da API REST
├── public/                   # Assets estáticos (logos, ícones SVG)
└── storage/app/reports/      # PDFs gerados
```

## Comandos Artisan Customizados

| Comando | Descrição |
|---|---|
| `sail artisan report:generate {id_or_email}` | Gera o PDF do relatório completo para um usuário |
| `sail artisan gps:sync-posts` | Sincroniza posts do site (posts.json) para a tabela `site_posts` |

## Convenções

- **Sempre usar Sail** para interagir com o backend: `./vendor/bin/sail artisan ...`
- Dev server: `composer dev` (sobe server, queue, logs e vite simultaneamente)
- Setup: `composer setup`
- Testes: `composer test`
- Os templates Blade do PDF usam tabelas HTML (não flexbox/grid) por compatibilidade com DomPDF
- Page breaks no PDF: usar `<div class="page-break"></div>` e `page-break-inside: avoid`

## Modelos Principais

| Model | Descrição |
|---|---|
| `ReportRequest` | Pedido de relatório (nome, email, scores, status, pdf_path) |
| `SitePost` | Posts sincronizados do site (title, url, tags, published_at) |

## API REST

- `POST /api/reports/request` — Cria um novo pedido de relatório (via quiz do site)
