📄 Relatório do Projeto - Barbearia IFSP

Disciplina: [Nome da Disciplina]

Professor: Prof. Dr. Reginaldo do Prado

Instituição: Instituto Federal de São Paulo (IFSP)

1. Contexto e Objetivo

O presente projeto teve como objetivo o desenvolvimento de um sistema de agendamentos web para uma barbearia. O problema principal a resolver era a desorganização comum em agendamentos feitos via WhatsApp ou telefone, que frequentemente resultam em choques de horários ou esquecimentos.

A solução construída oferece uma "vitrine" pública dos serviços (com imagens e preços), uma área de gestão de catálogo para o administrador (barbeiro) e um painel de cliente onde é possível efetuar agendamentos escolhendo apenas os horários que estão efetivamente disponíveis no sistema.

2. Metodologia: Vibe Coding e Assistência de IA

O desenvolvimento do projeto seguiu a metodologia de Vibe Coding, fazendo um uso intensivo de ferramentas de Inteligência Artificial acopladas ao ambiente de desenvolvimento (Model Context Protocol - MCP).

Através da IA, foi possível agilizar a escrita de código repetitivo (como a estruturação dos CRUDs, Migrations e Models), focar na arquitetura do sistema e resolver problemas complexos com rapidez. A interação contínua permitiu iterar o design (Blade + Tailwind) e a lógica de negócio num espaço de tempo reduzido, mantendo um alto padrão de qualidade de código.

3. Aplicação das Skills de Desenvolvimento

O projeto foi rigidamente guiado por um conjunto de "Skills" (diretrizes) predefinidas:

Skill 1 - Identidade Visual: Todo o front-end foi construído utilizando Tailwind CSS. Definiu-se uma paleta de cores consistente (Tema Dark/Gold - slate-900 e amber-500) que transmite sofisticação, alinhada com o público de uma barbearia.

Skill 2 - Padrão de CRUD: A gestão de serviços segue estritamente a arquitetura Resource Controller. As validações de dados nunca ocorrem no controller, mas sim através de classes FormRequest injetadas.

Skill 3 - Boas Práticas de Base de Dados: Foram implementados Soft Deletes (deleted_at) nos serviços e agendamentos para evitar perdas de histórico acidentais. A integridade referencial foi garantida através de chaves estrangeiras com cascadeOnDelete().

Skill 4 - Código Limpo: O código fonte obedece ao padrão PSR, utilizando a língua inglesa para a nomenclatura técnica (Models, Controllers, Variáveis) e a língua portuguesa apenas nas interfaces apresentadas ao utilizador final (Early Return foi largamente utilizado para evitar o aninhamento profundo de if/else).

4. Principais Dificuldades e Soluções Encontradas

Durante o desenvolvimento, surgiram alguns desafios técnicos que foram resolvidos de forma iterativa:

Problema de Atalhos (Symlinks) com o Windows + OneDrive:

Dificuldade: Ao utilizar a funcionalidade padrão do Laravel para armazenamento (php artisan storage:link), o sistema operativo Windows (em conjunto com a pasta partilhada do OneDrive) criava atalhos corrompidos, impedindo o navegador de apresentar as imagens dos serviços, embora as mesmas estivessem salvas no disco.

Solução: Foi necessário contornar o uso de symlinks. O Controller de serviços foi reescrito para utilizar o método move() e gravar as imagens recebidas via upload diretamente na pasta pública (public/uploads/services). Assim, a renderização da imagem na tabela e na Landing Page tornou-se imune às restrições do OneDrive.

Validação Dinâmica de Agendamentos (Evitar Choques de Horário):

Dificuldade: Garantir que um cliente não pudesse selecionar um horário que já tivesse sido ocupado por outro cliente, ou um horário num dia que já passou.

Solução: Desenvolveu-se um endpoint na API interna do Laravel que devolve (em formato JSON) a lista de horários ocupados para uma determinada data. No front-end (Blade), foi implementado um script em JavaScript Vanilla (API Fetch) que consulta essa rota de forma dinâmica e reconstrói o <select> de horários sempre que o utilizador altera o dia ou o mês, ocultando os horários passados e os já agendados.

5. Conclusão

A implementação deste projeto provou ser um excelente exercício de consolidação das práticas de desenvolvimento full-stack com o ecossistema Laravel. A integração da Inteligência Artificial como parceira de desenvolvimento (Vibe Coding) demonstrou como é possível acelerar a produção de código padrão, permitindo que o programador concentre o seu esforço nas regras de negócio críticas e na experiência do utilizador.