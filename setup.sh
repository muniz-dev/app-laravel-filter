#!/bin/bash

set -e

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Setup do Ambiente Laravel Livewire${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""

# Verificar se Docker está rodando
if ! docker info > /dev/null 2>&1; then
    echo -e "${RED}Erro: Docker não está rodando!${NC}"
    exit 1
fi

# Verificar se docker-compose está disponível
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}Erro: docker-compose não está instalado!${NC}"
    exit 1
fi

echo -e "${YELLOW}[1/9] Ajustando permissões...${NC}"
# Ajustar permissões dos diretórios necessários
mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache public/build
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
echo -e "${GREEN}✓ Permissões ajustadas${NC}"
echo ""

echo -e "${YELLOW}[2/9] Subindo containers Docker...${NC}"
docker-compose down 2>/dev/null || true

# Reconstruir imagem se necessário (para incluir entrypoint)
if [ -f docker-entrypoint.sh ]; then
    echo -e "${YELLOW}   Reconstruindo imagem Docker...${NC}"
    docker-compose build --no-cache app 2>/dev/null || docker-compose build app
fi

docker-compose up -d

# Aguardar container iniciar e ajustar permissões
echo -e "${YELLOW}   Ajustando permissões dentro do container...${NC}"
sleep 5
for i in {1..10}; do
    if docker-compose exec -T --user root app sh -c "mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage/framework/sessions /var/www/html/storage/framework/views /var/www/html/storage/framework/cache /var/www/html/storage/logs && chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage && chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage" 2>/dev/null; then
        break
    fi
    sleep 1
done

echo -e "${GREEN}✓ Containers iniciados${NC}"
echo ""

echo -e "${YELLOW}[3/9] Aguardando PostgreSQL ficar pronto...${NC}"
sleep 5
for i in {1..30}; do
    if docker-compose exec -T postgres pg_isready -U postgres > /dev/null 2>&1; then
        echo -e "${GREEN}✓ PostgreSQL está pronto${NC}"
        break
    fi
    if [ $i -eq 30 ]; then
        echo -e "${RED}Erro: PostgreSQL não ficou pronto a tempo${NC}"
        exit 1
    fi
    sleep 1
done
echo ""

echo -e "${YELLOW}[4/9] Criando arquivo .env se não existir...${NC}"
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
        echo -e "${GREEN}✓ Arquivo .env criado a partir do .env.example${NC}"
    else
        echo -e "${YELLOW}⚠ Arquivo .env.example não encontrado, criando .env básico...${NC}"
        cat > .env << 'EOF'
APP_NAME="Catálogo de Produtos"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=product_filter
DB_USERNAME=postgres
DB_PASSWORD=postgres

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
EOF
        echo -e "${GREEN}✓ Arquivo .env criado${NC}"
    fi
    chmod 644 .env
else
    echo -e "${GREEN}✓ Arquivo .env já existe${NC}"
fi
echo ""

echo -e "${YELLOW}[5/9] Instalando dependências do Composer...${NC}"
# Garantir que composer.lock possa ser criado
touch composer.lock 2>/dev/null || true
chmod 666 composer.lock 2>/dev/null || true

# Garantir permissões antes de instalar (executar como root)
echo -e "${YELLOW}   Ajustando permissões finais...${NC}"
docker-compose exec -T --user root app sh -c "
    mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage/framework/sessions /var/www/html/storage/framework/views /var/www/html/storage/framework/cache /var/www/html/storage/logs && 
    chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage && 
    chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage
" 2>/dev/null || true

# Instalar dependências como root e depois ajustar ownership
docker-compose exec -T --user root app sh -c "
    composer install --no-interaction --prefer-dist && 
    chown -R www-data:www-data /var/www/html/vendor /var/www/html/composer.lock /var/www/html/bootstrap/cache 2>/dev/null || true
" || {
    echo -e "${RED}Erro ao instalar dependências. Verifique os logs.${NC}"
    exit 1
}

echo -e "${GREEN}✓ Dependências instaladas${NC}"
echo ""

echo -e "${YELLOW}[6/9] Gerando chave da aplicação...${NC}"
# Verificar se APP_KEY já existe no .env
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
    docker-compose exec -T app php artisan key:generate --force
    echo -e "${GREEN}✓ Chave gerada${NC}"
else
    echo -e "${GREEN}✓ Chave já existe${NC}"
fi
echo ""

echo -e "${YELLOW}[7/9] Executando migrations...${NC}"
docker-compose exec -T app php artisan migrate --force
echo -e "${GREEN}✓ Migrations executadas${NC}"
echo ""

echo -e "${YELLOW}[8/9] Executando seeders...${NC}"
docker-compose exec -T app php artisan db:seed --force
echo -e "${GREEN}✓ Seeders executados${NC}"
echo ""

echo -e "${YELLOW}[9/9] Compilando assets (Vite)...${NC}"
# Verificar se Node.js está disponível localmente
if command -v npm &> /dev/null; then
    if [ ! -d "node_modules" ]; then
        echo -e "${YELLOW}   Instalando dependências do Node.js...${NC}"
        npm install 2>&1 | grep -v "npm WARN" | head -20 || true
        echo -e "${YELLOW}   ...${NC}"
    else
        echo -e "${YELLOW}   Dependências do Node.js já instaladas${NC}"
    fi
    
    echo -e "${YELLOW}   Compilando assets para produção...${NC}"
    if npm run build 2>&1 | tee /tmp/vite_build.log | tail -5 | grep -q "built\|success"; then
        echo -e "${GREEN}✓ Assets compilados${NC}"
    else
        # Verificar se o build foi bem-sucedido mesmo assim
        if [ -f "public/build/manifest.json" ]; then
            echo -e "${GREEN}✓ Assets compilados (manifest.json encontrado)${NC}"
        else
            echo -e "${YELLOW}   ⚠ Compilação pode ter tido problemas.${NC}"
            echo -e "${YELLOW}   Tente executar manualmente: npm run build${NC}"
        fi
    fi
    rm -f /tmp/vite_build.log 2>/dev/null || true
else
    echo -e "${YELLOW}   ⚠ Node.js não encontrado localmente.${NC}"
    echo -e "${YELLOW}   Instale Node.js e execute: npm install && npm run build${NC}"
    echo -e "${YELLOW}   Ou use o modo dev: npm run dev (em outro terminal)${NC}"
fi
echo ""

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Setup concluído com sucesso!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo -e "Aplicação disponível em: ${YELLOW}http://localhost:8000${NC}"
echo -e "Logs de Atividade: ${YELLOW}http://localhost:8000/admin/activity-logs${NC}"
echo -e "Logs de Pesquisa: ${YELLOW}http://localhost:8000/admin/search-logs${NC}"
echo ""

# Verificar se assets foram compilados
if [ ! -f "public/build/manifest.json" ] && command -v npm &> /dev/null; then
    echo -e "${YELLOW}⚠ Aviso: Assets não foram compilados.${NC}"
    echo -e "${YELLOW}Execute: npm run build${NC}"
    echo ""
fi

echo -e "Comandos úteis:"
echo -e "  Ver logs: ${YELLOW}docker-compose logs -f app${NC}"
echo -e "  Parar: ${YELLOW}docker-compose down${NC}"
echo -e "  Recompilar assets: ${YELLOW}npm run build${NC}"
echo -e "  Modo dev (hot reload): ${YELLOW}npm run dev${NC}"
echo ""
