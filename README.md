# IT Helpdesk System

Sistema de chamados para departamento de T.I desenvolvido com base em cenários reais de empresas, com foco em organização, rastreabilidade e eficiência no atendimento interno.

---

## Overview

Este projeto tem como objetivo centralizar e organizar o fluxo de solicitações de T.I dentro de uma empresa, substituindo processos informais e descentralizados por uma solução estruturada e rastreável.

---

## Business Case

### Context

Uma empresa de médio porte, com aproximadamente 150 colaboradores distribuídos entre setores como administrativo, financeiro e comercial, enfrenta dificuldades na gestão de solicitações direcionadas ao departamento de T.I.

Diariamente, a equipe de tecnologia recebe diversas demandas, como:
- problemas com acesso a sistemas  
- falhas em equipamentos  
- solicitações de instalação de softwares  
- dúvidas operacionais  

Essas solicitações chegam por múltiplos canais, como e-mail, mensagens diretas e abordagens presenciais, gerando um fluxo desorganizado de informações.

---

### Problem

A ausência de um sistema centralizado resulta em:

- falta de priorização adequada dos chamados  
- perda ou esquecimento de solicitações  
- ausência de histórico de atendimentos  
- dificuldade em acompanhar o status das demandas  
- comunicação descentralizada entre usuários e equipe de T.I  

---

### Impact

Esses problemas impactam diretamente a operação da empresa:

- aumento do retrabalho  
- baixa eficiência no atendimento  
- insatisfação dos colaboradores  
- dificuldade em identificar gargalos recorrentes  
- falta de dados para tomada de decisão  

---

### Solution

Desenvolvimento de um sistema de chamados interno que permite:

- abertura de solicitações de forma padronizada  
- categorização e priorização dos chamados  
- acompanhamento de status (aberto, em andamento, concluído)  
- registro de interações e histórico  
- centralização da comunicação entre usuários e T.I  

---

### Expected Results

Com a implementação da solução, espera-se:

- maior organização do fluxo de trabalho  
- redução de perda de chamados  
- aumento da eficiência da equipe de T.I  
- melhoria na comunicação interna  
- geração de dados para análise e melhoria contínua  

---

## ⚙️ Tech Stack

- Backend: Laravel  
- Database: MySql  
- Frontend: Blade 
- API: RESTful  

---

## Core Features

- Autenticação de usuários  
- Criação de chamados  
- Listagem e visualização de chamados  
- Atualização de status  
- Definição de prioridade  
- Comentários e histórico de interações  

---

## Data Modeling

Entidades principais:

- **Users**
- **Tickets**
- **Comments**

Relações:

- Um usuário pode criar vários chamados  
- Um chamado pode ter vários comentários  

---

## Getting Started

```bash
# Clone o repositório
git clone <your-repo-url>

# Acesse a pasta
cd it-helpdesk-system

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Rode as migrations
php artisan migrate

# Inicie o servidor
php artisan serve

# ou

composer run dev
