# Aplicação Laravel Livewire - Sistema de Filtros de Produtos

Aplicação Laravel 11 com Livewire para filtragem de produtos com persistência de filtros na URL, multi-seleção de categorias e marcas, e sistema de auditoria completo.

## Características

- ✅ **Laravel 11** - Framework PHP moderno
- ✅ **Livewire 3** - Componentes reativos sem JavaScript complexo
- ✅ **Docker** - Ambiente de desenvolvimento containerizado
- ✅ **PostgreSQL** - Banco de dados robusto
- ✅ **Filtros Persistentes** - Filtros salvos na URL (sobrevivem a reload)
- ✅ **Multi-seleção** - Categorias e marcas com seleção múltipla
- ✅ **Sistema de Auditoria** - Logs de atividades e pesquisas
- ✅ **Código Limpo** - Arquitetura com Repositories e Services
- ✅ **Documentação Completa** - PHPDoc em todas as classes

## Requisitos

- Docker e Docker Compose
- Composer (para instalação local, opcional)

## Instalação Rápida

### Opção 1: Script Automatizado (Recomendado)

Execute o script de setup que automatiza todo o processo:

```bash
cd /home/ale/projects/moot/test
./setup.sh
```

O script irá:
1. Ajustar permissões
2. Subir os containers Docker
3. Aguardar PostgreSQL ficar pronto
4. Criar arquivo .env se não existir
5. Instalar dependências do Composer
6. Gerar chave da aplicação
7. Executar migrations
8. Executar seeders

### Opção 2: Instalação Manual

Se preferir fazer manualmente:

#### 1. Configure o ambiente

```bash
cd /home/ale/projects/moot/test
cp .env.example .env  # ou o script criará automaticamente
```

#### 2. Inicie os containers Docker

```bash
docker-compose up -d
```

#### 3. Instale as dependências do PHP

```bash
docker-compose exec app composer install
```

#### 4. Gere a chave da aplicação

```bash
docker-compose exec app php artisan key:generate
```

#### 5. Execute as migrations

```bash
docker-compose exec app php artisan migrate
```

#### 6. Execute os seeders

```bash
docker-compose exec app php artisan db:seed
```

### Instalação de Assets (Opcional)

Para desenvolvimento frontend:

```bash
npm install
npm run dev
```

## Acessando a Aplicação

- **Aplicação Principal**: http://localhost:8000
- **Logs de Atividade**: http://localhost:8000/admin/activity-logs
- **Logs de Pesquisa**: http://localhost:8000/admin/search-logs

## Estrutura do Projeto

```
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│           ├── ActivityLogController.php
│           └── SearchLogController.php
├── Livewire/
│   └── ProductFilter.php
├── Models/
│   ├── ActivityLog.php
│   ├── Brand.php
│   ├── Category.php
│   ├── Product.php
│   └── SearchLog.php
├── Observers/
│   └── ProductObserver.php
├── Repositories/
│   ├── BrandRepository.php
│   ├── CategoryRepository.php
│   └── ProductRepository.php
└── Services/
    ├── AuditService.php
    └── ProductFilterService.php

database/
├── migrations/
│   ├── 2024_01_01_000001_create_categories_table.php
│   ├── 2024_01_01_000002_create_brands_table.php
│   ├── 2024_01_01_000003_create_products_table.php
│   ├── 2024_01_01_000004_create_product_category_table.php
│   ├── 2024_01_01_000005_create_activity_logs_table.php
│   └── 2024_01_01_000006_create_search_logs_table.php
└── seeders/
    ├── BrandSeeder.php
    ├── CategorySeeder.php
    ├── DatabaseSeeder.php
    └── ProductSeeder.php

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php
    ├── livewire/
    │   └── product-filter.blade.php
    └── admin/
        ├── activity-logs/
        │   └── index.blade.php
        └── search-logs/
            └── index.blade.php
```

## Funcionalidades

### Filtros de Produtos

- **Nome do Produto**: Busca por texto no nome
- **Categorias**: Multi-seleção de categorias
- **Marcas**: Multi-seleção de marcas
- **Persistência na URL**: Filtros são salvos na URL e persistem após reload
- **Limpar Filtros**: Botão para limpar todos os filtros

### Sistema de Auditoria

#### Logs de Atividade
Registra todas as atividades realizadas no sistema:
- Criação de produtos
- Atualização de produtos
- Exclusão de produtos
- Filtros por ação, tipo de modelo e data

#### Logs de Pesquisa
Registra todas as pesquisas realizadas:
- Termo pesquisado
- Filtros aplicados
- Quantidade de resultados
- Estatísticas (total de pesquisas, média de resultados, termo mais pesquisado)

## Comandos Úteis

### Script de Comandos Rápido

Use o script `commands.sh` para comandos comuns:

```bash
./commands.sh start      # Inicia containers
./commands.sh stop       # Para containers
./commands.sh restart    # Reinicia containers
./commands.sh logs       # Mostra logs
./commands.sh shell      # Abre shell no container
./commands.sh artisan migrate    # Executa migrations
./commands.sh artisan migrate:fresh --seed  # Recria banco
./commands.sh clear      # Limpa todos os caches
```

### Docker Compose (Alternativa)

```bash
# Iniciar containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f app

# Executar comandos Artisan
docker-compose exec app php artisan [comando]
```

### Artisan

```bash
# Limpar cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear

# Recriar banco de dados
docker-compose exec app php artisan migrate:fresh --seed

# Criar novo seeder
docker-compose exec app php artisan make:seeder NomeSeeder
```

## Desenvolvimento

### Adicionar Novos Produtos

Os produtos podem ser adicionados através do seeder ou criando um novo seeder:

```bash
docker-compose exec app php artisan make:seeder ProductSeeder
```

### Adicionar Novas Categorias/Marcas

Edite os seeders correspondentes:
- `database/seeders/CategorySeeder.php`
- `database/seeders/BrandSeeder.php`

### Personalizar Filtros

O componente Livewire está em `app/Livewire/ProductFilter.php`. A view está em `resources/views/livewire/product-filter.blade.php`.

## Tecnologias Utilizadas

- **Laravel 11** - Framework PHP
- **Livewire 3** - Componentes reativos
- **PostgreSQL** - Banco de dados
- **Docker** - Containerização
- **Alpine.js** - JavaScript minimalista
- **Tailwind CSS** - Framework CSS utilitário

## Arquitetura

A aplicação segue os princípios de código limpo:

- **Repositories**: Abstração da camada de dados
- **Services**: Lógica de negócio
- **Observers**: Eventos de modelos
- **Controllers**: Apenas coordenação de requisições

## Licença

Este projeto foi desenvolvido para fins de teste.

## Autor

Alexandre Felipe Muniz Raymundo.
