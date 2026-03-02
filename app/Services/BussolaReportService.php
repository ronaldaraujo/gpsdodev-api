<?php

namespace App\Services;

class BussolaReportService
{
    /**
     * Retorna os dados expandidos de uma dimensão, incluindo análise, plano de ação e conteúdos recomendados.
     */
    public function getDimensionData(string $dimensionKey, int $score): array
    {
        $level = $this->getScoreLevel($score);
        $data = $this->getDimensionMap()[$dimensionKey] ?? null;

        if (!$data) {
            return [];
        }

        return [
            'label' => $data['label'],
            'icon' => $data['icon'],
            'score' => $score,
            'level_label' => $this->getScoreLabel($score),
            'analysis' => $data['analysis'][$level],
            'action_plan' => $data['action_plan'][$level],
            'recommended_content' => $data['recommended_content']
        ];
    }

    private function getScoreLevel(int $score): string
    {
        if ($score >= 75) return 'high';
        if ($score >= 40) return 'medium';
        return 'low';
    }

    private function getScoreLabel(int $score): string
    {
        if ($score >= 75) return 'Alto';
        if ($score >= 40) return 'Moderado';
        return 'Em desenvolvimento';
    }

    /**
     * Retorna o mapa completo de dados de todas as dimensões.
     */
    private function getDimensionMap(): array
    {
        return [
            'direcao' => [
                'label' => 'Direção',
                'icon' => '🎯',
                'analysis' => [
                    'high' => 'Sua visão estratégica é excepcional. Você entende não apenas o "como" fazer, mas o "porquê" e "para onde" a sua carreira está indo. Diferente da maioria que se perde em frameworks da moda, você filtra as oportunidades através da lente dos seus objetivos de longo prazo. No seu nível, o desafio não é encontrar um caminho, mas saber dizer não para atalhos sedutores que desviam a rota principal. O mercado anseia por profissionais com esse nível de clareza, pois eles não apenas executam, mas alinham a engenharia aos objetivos do negócio.',
                    'medium' => 'Você tem momentos de grande clareza, mas muitas vezes se vê apenas reagindo ao fluxo do dia a dia. É como dirigir com o GPS perdendo o sinal em áreas difíceis: você sabe o destino geral, mas a próxima curva ainda é nebulosa. Isso é perfeitamente normal em fases de transição técnica ou de carreira. O que falta é formalizar essa visão. Transforme seus desejos soltos em metas tangíveis e comece a avaliar cada nova tarefa ou projeto com a pergunta: "Isso me aproxima de onde quero estar no ano que vem?".',
                    'low' => 'Você está operando puramente no modo de sobrevivência técnica: resolvendo o ticket da frente sem olhar para o horizonte. Você é capaz e resolve problemas, mas a falta de direcionamento intencional significa que outras pessoas (ou empresas) estão decidindo sua carreira por você. Trabalhar muito na direção errada (ou sem direção alguma) gera exaustão sem recompensa. É o momento exato para dar um passo atrás, parar de codar por algumas horas e fazer um diagnóstico honesto de onde você realmente deseja chegar.',
                ],
                'action_plan' => [
                    'high' => [
                        'Revise e refine sua tese de carreira atual: quais são seus não-negociáveis hoje?',
                        'Mapeie e conecte-se com 3 profissionais que já estão no patamar onde você quer chegar.',
                        'Comece a registrar e documentar o "racional" das suas maiores escolhas profissionais para ter histórico de decisão.'
                    ],
                    'medium' => [
                        'Defina 1 único objetivo profissional principal para os próximos 6 meses.',
                        'Audite a sua última semana: quantas horas foram gastas em coisas alinhadas a esse objetivo versus urgências alheias?',
                        'Crie um pequeno rito semanal de 15 minutos na sexta-feira apenas para revisar a rota.'
                    ],
                    'low' => [
                        'Escreva em um papel onde você não quer estar de jeito nenhum em 3 anos.',
                        'Identifique a tarefa no seu dia atual que mais rouba energia sem lhe dar nenhum conhecimento novo.',
                        'Converse com um mentor ou dev mais experiente não sobre código, mas sobre plano de vida.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'O dia que fiquei ao lado do criador do PHP',
                        'url' => 'https://gpsdodev.com.br/o-dia-que-fiquei-ao-lado-do-criador-do-php',
                        'type' => 'Post'
                    ],
                    [
                        'title' => 'Estamos evoluindo ou só complicando o básico?',
                        'url' => 'https://gpsdodev.com.br/estamos-evoluindo-ou-complicando-o-basico',
                        'type' => 'Post'
                    ]
                ]
            ],
            'construcao' => [
                'label' => 'Construção',
                'icon' => '🔨',
                'analysis' => [
                    'high' => 'Você é um verdadeiro artesão do software. Não se contenta em apenas "fazer funcionar", mas busca a excelência silenciosa da engenharia bem feita. Seu código é fácil de ler, seus projetos são manuteníveis e sua consistência gera uma profunda confiança nos seus pares. A intenção que você coloca em cada detalhe é a marca de um profissional sênior. O ponto de vigilância no seu nível é o over-engineering: lembre-se sempre de que o software rodando é melhor do que a arquitetura perfeita no quadro branco.',
                    'medium' => 'Você sabe o que é qualidade e se esforça para aplicá-la, mas na primeira espremida de prazo, os testes são ignorados e a dívida técnica é contraída. Isso cria um ciclo vicioso: a pressa gera dívida, a dívida reduz a velocidade no próximo ciclo, que gera mais pressa. Você tem a base técnica para excelência, agora o desenvolvimento deve ser focado na capacidade de negociar prazos com os stakeholders para proteger a qualidade fundamental do que você constrói.',
                    'low' => 'No momento, a quantidade e a velocidade parecem estar dominando completamente a qualidade. Você entrega rápido, mas o custo disso a longo prazo (bugs, retrabalho, código espaguete) já deve estar aparecendo ou aparecerá logo. Tornar-se um construtor de verdade começa por quebrar o ritmo frenético de "apagar incêndios" e aceitar que entregar algo menor, mas de excelência, acelera a equipe e sua evolução muito mais do que apagar tickets correndo.',
                ],
                'action_plan' => [
                    'high' => [
                        'Avalie uma parte do sistema onde você pode trocar a complexidade por uma arquitetura maravilhosamente simples.',
                        'Oriente ativamente devs mais juniores nas revisões de código a como pensar sobre o longo prazo.',
                        'Pratique a contenção de qualidade: identifique quando uma feature não precisa ser robusta, apenas validada.'
                    ],
                    'medium' => [
                        'Pare de aceitar prazos impossíveis silenciosamente. Negocie a entrega do MVP versus a feature completa.',
                        'Nas próximas 5 pull requests, dedique 15% do tempo apenas para pensar em legibilidade do código.',
                        'Implemente a regra de Boy Scout: deixe o arquivo em que você tocou um pouco melhor do que o encontrou.'
                    ],
                    'low' => [
                        'Comece a escrever testes para pelo menos 1 cenário feliz em toda feature que você mexer.',
                        'Antes de iniciar a codificação do próximo ticket, crie um plano por escrito no papel de como vai construí-lo.',
                        'Diminua seu WIP (Work in Progress). Trabalhe ativamente em apenas uma coisa de cada vez até finalizá-la.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'Double check não é paranoia, é maturidade',
                        'url' => 'https://gpsdodev.com.br/double-check-nao-e-paranoia-e-maturidade',
                        'type' => 'Post'
                    ],
                    [
                        'title' => 'Constância é o método',
                        'url' => 'https://gpsdodev.com.br/constancia-e-o-metodo',
                        'type' => 'Post'
                    ]
                ]
            ],
            'conexao' => [
                'label' => 'Conexão',
                'icon' => '🤝',
                'analysis' => [
                    'high' => 'Sua inteligência relacional é tão ou mais apurada que a sua inteligência de código. Você entende que software se faz com e para pessoas. É capaz de liderar tecnicamente não por autoridade, mas por empatia e influência. A clareza com que se comunica desarma conflitos antes que comecem e constrói pontes valiosas entre times técnicos e não técnicos. Continue a usar essa energia para destravar os potenciais ao redor, mas cuide sempre do seu limite de bateria social.',
                    'medium' => 'Você interage razoavelmente bem com os colegas, mas sua comunicação ainda oscila. Você pode ser muito bom explicando para a máquina o que ela tem que fazer, mas em uma reunião com PMs ou clientes, às vezes sente frustração ou não consegue se fazer entender de primeira. Lembre-se que empatia na comunicação também é uma habilidade técnica — é o que dita a diferença entre um pleno sólido e um sênior influente.',
                    'low' => 'A barreira que te separa do próximo grande salto salarial ou de reconhecimento raramente será saber outra linguagem. É a sua comunicação que está travando o seu avanço. O foco excessivo no código pode estar gerando atritos, dificuldade em alinhar expectativas ou sensação de não ser valorizado. Começar a entender o fluxo de negócio e o lado humano das tomadas de decisão mudará sua carreira radicalmente.',
                ],
                'action_plan' => [
                    'high' => [
                        'Treine ativamente outra pessoa na equipe a se comunicar com outras áreas do negócio.',
                        'Dê um passo atrás em reuniões onde você normalmente assume a palavra, e incentive alguém novo a apresentar o raciocínio.',
                        'Escreva e publique internamente os seus ritos de alinhamento com outros times para tornar isso cultura.'
                    ],
                    'medium' => [
                        'Na próxima vez que precisar discordar de uma abordagem técnica, faça sempre 2 perguntas antes de apresentar a sua objeção.',
                        'Invista 10 minutos a mais ao escrever o texto do Pull Request para explicar o "contexto do porquê", não apenas o "o quê".',
                        'Convide um colega para pair programming não apenas para resolver o bug, mas para ensinar como você navegou na base.'
                    ],
                    'low' => [
                        'Troque 5 vezes no mês a frase "Você não entendeu" por "Espera, eu acho que não me expressei direito. Deixa eu tentar de novo".',
                        'Faça pelo menos uma call (mesmo rápida) com a câmara aberta em reuniões estratégicas para demonstrar presença.',
                        'Se estiver há mais de 30 minutos batendo cabeça num erro incompreensível, levante a mão e peça ajuda.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'A sutil arte de ficar em silêncio',
                        'url' => 'https://gpsdodev.com.br/a-sutil-arte-de-ficar-em-silencio',
                        'type' => 'Post'
                    ],
                    [
                        'title' => '7 trocas de palavras que mudam sua comunicação',
                        'url' => 'https://gpsdodev.com.br/7-trocas-de-palavras-que-mudam-sua-comunicacao',
                        'type' => 'Post'
                    ]
                ]
            ],
            'consciencia' => [
                'label' => 'Consciência',
                'icon' => '🪞',
                'analysis' => [
                    'high' => 'Você tem a coragem de ser vulnerável num mercado que cobra que você seja um super-herói invencível de silício. Seus altos níveis de autoconhecimento permitem uma visão cristalina sobre onde você aporta valor e onde as coisas fogem do controle. Dizer "não sei", "falhei ali", ou pedir um tempo, não é uma fraqueza no seu arsenal, é o pilar que te protege de burnouts cruéis e o chão seguro a partir do qual você cresce rápido.',
                    'medium' => 'Você tem lampejos de ótima reflexão interna, mas ainda se protege um pouco nas trincheiras. Às vezes o seu ego (mesmo que com boas intenções) toma a direção quando as críticas ou bugs aparecem. O caminho agora é transformar esses momentos isolados de clareza mental em um ritual contínuo. Não espere a crise no projeto (ou pessoal) para olhar para dentro. Assuma o erro primeiro, antes que te digam — isso dissolve qualquer atrito em segundos.',
                    'low' => 'Muito da sua energia diária está escapando pela torneira da reatividade. Você pode estar num ciclo de tomar decisões precipitadas, seja no código ou na vida, por não parar para observar a "própria mente operando". Agir sem reflexão contínua cria uma ilusão muito perigosa de velocidade. Antes de melhorar qualquer hard skill técnica, a recomendação vital é você abrir mais espaço para se observar trabalhando. A mudança real não vem do conselho externo, vem do espelho.',
                ],
                'action_plan' => [
                    'high' => [
                        'Use a sua influência para modelar a segurança psicológica na equipe: exponha abertamente seus maiores desafios ou falhas em post-mortems.',
                        'Observe atentamente se o seu alto autoconhecimento não está gerando um isolamento na "torre de marfim".',
                        'Documente e compartilhe como você estrutura seus momentos de reflexão e calibração de rumo.'
                    ],
                    'medium' => [
                        'Quando ouvir um feedback duro, anote-o, agradeça, e force-se a esperar 24 horas antes de responder o que for.',
                        'No final da semana, escreva em 3 linhas sobre 1 erro seu que gerou dor de cabeça, sem colocar a culpa num fator externo.',
                        'Peça, de forma sincera e sem rebatimento, 1 feedback a um colega sobre alguma atitude sua que atrapalha o time.'
                    ],
                    'low' => [
                        'Nos próximos 15 dias, use um caderninho apenas para anotar com o que você sentiu raiva ou ansiedade antes de reagir.',
                        'Fale "eu não sei isso muito bem" na sua próxima daily ou reunião em que tentarem jogar a bola toda na sua mão sem clareza.',
                        'Remova qualquer notificação e distrações pesadas pelo menos nos 60 minutos do começo do seu dia para se calibrar.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'Achômetro tem péssima precisão',
                        'url' => 'https://gpsdodev.com.br/achometro-pessima-precisao',
                        'type' => 'Post'
                    ],
                    [
                        'title' => 'A gente cresce quando se permite se perder',
                        'url' => 'https://gpsdodev.com.br/a-gente-cresce-quando-se-permite-se-perder',
                        'type' => 'Post'
                    ]
                ]
            ],
            'evolucao' => [
                'label' => 'Evolução',
                'icon' => '📈',
                'analysis' => [
                    'high' => 'Você compreende que a evolução real no universo de engenharia requer investigar os fundamentos, não seguir as modas de maneira cega. O seu conhecimento tático envelhecerá, mas você já internalizou que a curva verdadeira só acontece fora da zona de conforto. Em um ambiente de IAs gerativas avançando sem freio, o que te assegura no jogo é justamente a capacidade que você demonstra em não parar a esteira. Mantenha essa força ativa focando em resolver os problemas maiores que nenhuma máquina sabe estruturar.',
                    'medium' => 'Você costuma avançar no aprendizado de forma pragmática, o famoso "aprendo se precisar amanhã de manhã". É excelente para entregas, mas se você não criar blocos de evolução intencionais e descolados da sua sprint, você rapidamente fica preso nos escopos dos sistemas do seu empregador atual. O mercado avança mais do que as stacks legadas. Crie curadores da sua confiança e dedique horas fixas, sem desculpas, para aprofundamento constante.',
                    'low' => 'Neste momento, você corre um grande risco de obsolescência técnica, não pelo ChatGPT, mas por comodismo. Estacionar numa posição que paga as contas enquanto para por completo os fluxos de aquisição intelectual condena a curva salarial e fecha inúmeras opções futuras. É uma ladeira silenciosa e muito escorregadia. O movimento de volta não exige revolução: escolha apenas uma mini-habilidade ou um novo bloco de fundação toda semana, mas não passe um mês estático.',
                ],
                'action_plan' => [
                    'high' => [
                        'Comece a explorar ativamente domínios totalmente adjacentes ao seu hoje (marketing, vendas ou infra pesada).',
                        'Ensine os seus achados mais fascinantes dos últimos 3 meses escrevendo um post publicamente e sem revisões infinitas.',
                        'Identifique a próxima disrupção estrutural da sua área principal e envolva-se em projetos Open Source sobre isso.'
                    ],
                    'medium' => [
                        'Marque 2 horas intransferíveis semanais de estudo, fora do horário em que está mais exausto(a).',
                        'Tome algo na sua stack principal que "sempre foca debaixo do pano" e crie uma POC explicando como de fato funciona por baixo.',
                        'Abandone o "aprender na marra durante a sprint". Estude de forma prévia algo fora da bolha da sua framework.'
                    ],
                    'low' => [
                        'Assuma o compromisso de ler uma newsletter ou artigo seminal técnico de 15 minutos às terças e quintas.',
                        'Em vez de pular direto na documentação ou vídeo tutorial prático, leia a página do "por que isso existe" do framework que usa.',
                        'Inscreva-se ou monte um pequeno desafio na companhia de só mais 1 dev para aplicar conhecimento de uma stack nova em 1 final de semana.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'IA faz, fala e faz, mas mente exausta não resolve',
                        'url' => 'https://gpsdodev.com.br/ia-faz-mas-mente-exausta-nao-resolve',
                        'type' => 'Post'
                    ],
                    [
                        'title' => 'IA como alavanca ou muleta?',
                        'url' => 'https://gpsdodev.com.br/ia-como-alavanca-ou-como-muleta',
                        'type' => 'Post'
                    ]
                ]
            ],
            'equilibrio' => [
                'label' => 'Equilíbrio',
                'icon' => '⚖️',
                'analysis' => [
                    'high' => 'No meio do culto ao sofrimento (hustle culture), você age como um ponto fora da curva: entende exatamente que produtividade verdadeira brota do respiro e da integridade física/mental. Seus altos números aqui indicam maturidade rara, a habilidade inegociável de preservar a máquina principal (você) operando sempre fora do vermelho. Continunue atuando intensamente nos sprints que importam, mas proteja esse limite implacável nos fins de semana.',
                    'medium' => 'O prato ainda roda no ar e raramente cai, mas a energia gasta pra equilibrar já está chegando em níveis complexos de se manter a longo prazo. O seu senso de descanso e descompressão muitas vezes colide com a ansiedade da entrega, gerando o pior dos cenários: você relaxa com culpa. Para sair do loop, abrace a mecânica brutal de que, para um profissional do conhecimento, recuperar as conexões neurais não é um favor a si, é parte indissociável das suas funções.',
                    'low' => 'Há fumaça perigosa nos circuitos da sua rotina atual. Extremos cansaços constantes, ausência fatal de recargas reais de saúde, limites borrados do trabalho para sua vida pessoal desenham o precipício do Burnout de ponta a ponta. Se há um lugar pelo qual deve focar sua energia hoje, abandone o código e reintegre-se ao mundo real: dormir limpo por 8 horas e separar, severamente, janelas em que você está com notificação zero são, agora, medidas emergenciais. Reconstruções não se dão com concreto no chão instável.',
                ],
                'action_plan' => [
                    'high' => [
                        'Comece a ser explícito aos menos graduados ou novos colegas não apenas sobre "o que você faz", mas sobre como organiza "seus limites".',
                        'Encontre, na sua vida fora do PC, uma atividade em profundidade intelectual equivalente, mas de natureza motora crua para descompressão mecânica.',
                        'Estruture seu ano já considerando 2 paradas técnicas reais offline.'
                    ],
                    'medium' => [
                        'Crie um ritual rígido ("shutdown sequence") às sextas-feiras: escreva num arquivo o que não finalizou, feche a IDE, desconecte.',
                        'Seja imperdoável com 1 dia no mês. Este dia, declare para você e seus superiores de que nada de trabalho será executado.',
                        'Mude o ambiente em que você janta e come. Tire de vez os dispositivos em suas recargas rápidas energéticas.'
                    ],
                    'low' => [
                        'Hoje à noite: Configure seus equipamentos no modo do not-disturb irreversível nas suas 10h não vitais da noite.',
                        'Saia fisicamente da sua área de trabalho a cada hora cheia num ritmo que deve durar não mais de 2 minutos. Respire longe da tela.',
                        'Se exercite por meros 15 min hoje, focando apenas no momento motor sem música nova ou podcasts atrelados — desligue o input.'
                    ]
                ],
                'recommended_content' => [
                    [
                        'title' => 'Infarto ou derrame, a escolha silenciosa',
                        'url' => 'https://gpsdodev.com.br/infarto-ou-derrame-a-escolha-silenciosa',
                        'type' => 'Post'
                    ],
                    [
                        'title' => 'Nunca desperdice uma noite não dormida',
                        'url' => 'https://gpsdodev.com.br/nunca-desperdice-uma-noite-nao-dormida',
                        'type' => 'Post'
                    ]
                ]
            ],
        ];
    }
}
