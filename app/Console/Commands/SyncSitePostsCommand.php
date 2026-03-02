<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\SitePost;

class SyncSitePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gps:sync-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync posts from the main site (posts.json)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feedUrl = env('SITE_POSTS_FEED_URL', 'https://gpsdodev.com.br/posts.json');
        
        $this->info("Buscando posts de {$feedUrl}...");
        
        try {
            $response = Http::timeout(15)->get($feedUrl);
            
            if (!$response->successful()) {
                $this->error("Falha ao buscar os posts. Status HTTP: " . $response->status());
                return Command::FAILURE;
            }
            
            $posts = $response->json();
            
            if (!is_array($posts)) {
                $this->error("O formato do JSON retornado é inválido.");
                return Command::FAILURE;
            }
            
            $count = 0;
            
            foreach ($posts as $postData) {
                if (empty($postData['url'])) {
                    continue;
                }
                
                SitePost::updateOrCreate(
                    ['url' => $postData['url']],
                    [
                        'title' => $postData['title'] ?? 'Sem Título',
                        'tags' => $postData['tags'] ?? [],
                        'published_at' => !empty($postData['published_at']) ? $postData['published_at'] : now(),
                    ]
                );
                $count++;
            }
            
            $this->info("Sucesso! {$count} posts foram sincronizados no banco de dados.");
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error("Erro durante a sincronização: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
