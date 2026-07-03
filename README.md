💈 Barbearia IFSP - Sistema de Agendamento

Este é o projeto final para a disciplina do Prof. Dr. Reginaldo do Prado (IFSP). Consiste num sistema web completo para gestão e agendamento de horários numa barbearia, desenvolvido utilizando a arquitetura do Laravel com o auxílio do Laravel Boost e metodologias de Vibe Coding.

🚀 Funcionalidades Principais

Página Inicial (Vitrine): Apresentação da barbearia e catálogo de serviços com imagens.

Autenticação: Sistema de Login e Registo com separação de perfis (Administrador e Cliente).

Painel Administrativo (Admin): * Visualização da agenda do dia.

CRUD completo de Serviços (Criar, Ler, Atualizar, Eliminar) com upload de imagens diretamente para a pasta pública.

Painel do Cliente:

Histórico de agendamentos.

Formulário de novo agendamento com validação dinâmica de horários disponíveis.

🛠️ Tecnologias Utilizadas

Backend: PHP 8.2+, Laravel 11.x

Frontend: Blade Templates, Tailwind CSS (Tema personalizado Dark/Gold)

Base de Dados: SQLite (Configuração padrão para facilitar testes)

Metodologia: Vibe Coding assistido por IA (Model Context Protocol) com diretrizes rigorosas (Skills).

⚙️ Como Instalar e Executar Localmente

Siga os passos abaixo para testar o projeto no seu ambiente local. Certifique-se de ter o PHP 8.2+, Composer e Node.js instalados.

Clone o repositório ou extraia os ficheiros:

git clone <url-do-repositorio>
cd barbearia-ifsp


Instale as dependências do PHP e do Node:

composer install
npm install


Configure as variáveis de ambiente:
Copie o ficheiro de exemplo e crie o seu .env.

cp .env.example .env


Nota: Por padrão, o Laravel usará o SQLite. Não é necessário configurar credenciais de MySQL a menos que deseje.

Gere a chave da aplicação:

php artisan key:generate


Prepare a Base de Dados e preencha com os dados de teste (Seeders):
Este comando cria as tabelas e insere os utilizadores de teste e os serviços base.

php artisan migrate --seed


Compile os ficheiros de front-end (Tailwind):

npm run build
# Ou, se for continuar a desenvolver: npm run dev


Inicie o servidor local:

php artisan serve


Aceda à aplicação em: http://localhost:8000

🔑 Credenciais de Teste

O comando --seed gerou dois utilizadores para facilitar os testes. Pode usá-los para testar os diferentes painéis.

Tipo de Utilizador

Email

Password

Administrador

admin@barbearia.com

password

Cliente

cliente@barbearia.com

password

Desenvolvido no âmbito do Instituto Federal de São Paulo (IFSP).