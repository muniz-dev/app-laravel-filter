# Testes da Aplicação

Este diretório contém os testes automatizados da aplicação usando PHPUnit.

## Estrutura de Testes

### Testes Unitários (`tests/Unit/`)

- **Repositories**: Testes dos repositórios de dados
  - `ProductRepositoryTest.php` - Testa filtros, busca e contagem de produtos
- **Services**: Testes dos serviços de negócio
  - `ProductFilterServiceTest.php` - Testa lógica de filtragem
  - `AuditServiceTest.php` - Testa logging de atividades e pesquisas

### Testes de Feature (`tests/Feature/`)

- **Livewire**: Testes dos componentes Livewire
  - `ProductFilterTest.php` - Testa filtros, persistência de URL e limpeza
- **Controllers**: Testes dos controllers
  - `ActivityLogControllerTest.php` - Testa visualização e filtros de logs de atividade
  - `SearchLogControllerTest.php` - Testa visualização e filtros de logs de pesquisa

## Executando os Testes

### Executar todos os testes

```bash
docker-compose exec app php artisan test
```

### Executar apenas testes unitários

```bash
docker-compose exec app php artisan test --testsuite=Unit
```

### Executar apenas testes de feature

```bash
docker-compose exec app php artisan test --testsuite=Feature
```

### Executar um teste específico

```bash
docker-compose exec app php artisan test tests/Unit/Repositories/ProductRepositoryTest.php
```

### Executar com cobertura de código

```bash
docker-compose exec app php artisan test --coverage
```

## Cobertura de Testes

Os testes cobrem:

- ✅ Filtros de produtos (nome, categoria, marca)
- ✅ Paginação
- ✅ Persistência de filtros na URL
- ✅ Logging de atividades
- ✅ Logging de pesquisas
- ✅ Controllers de admin
- ✅ Repositórios e serviços

## Adicionando Novos Testes

Ao adicionar novas funcionalidades, certifique-se de:

1. Criar testes unitários para lógica de negócio
2. Criar testes de feature para componentes Livewire e controllers
3. Manter a cobertura de código acima de 80%
4. Seguir o padrão AAA (Arrange, Act, Assert)

## Factories

As factories estão em `database/factories/`:

- `BrandFactory.php`
- `CategoryFactory.php`
- `ProductFactory.php`
- `ActivityLogFactory.php`
- `SearchLogFactory.php`
