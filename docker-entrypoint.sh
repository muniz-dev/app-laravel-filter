#!/bin/sh
set -e

# Criar diretórios necessários se não existirem
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs

# Ajustar permissões (só funciona se rodando como root)
if [ "$(id -u)" = "0" ]; then
    chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage
    chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage 2>/dev/null || true
else
    chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage 2>/dev/null || true
fi

# Executar comando original
exec "$@"
