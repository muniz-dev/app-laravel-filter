#!/bin/bash

# Script com comandos úteis para gerenciar o ambiente

case "$1" in
    start)
        echo "Iniciando containers..."
        docker-compose up -d
        ;;
    stop)
        echo "Parando containers..."
        docker-compose down
        ;;
    restart)
        echo "Reiniciando containers..."
        docker-compose restart
        ;;
    logs)
        docker-compose logs -f app
        ;;
    shell)
        docker-compose exec app sh
        ;;
    artisan)
        shift
        docker-compose exec app php artisan "$@"
        ;;
    composer)
        shift
        docker-compose exec app composer "$@"
        ;;
    migrate)
        docker-compose exec app php artisan migrate
        ;;
    fresh)
        docker-compose exec app php artisan migrate:fresh --seed
        ;;
    seed)
        docker-compose exec app php artisan db:seed
        ;;
    clear)
        docker-compose exec app php artisan cache:clear
        docker-compose exec app php artisan config:clear
        docker-compose exec app php artisan view:clear
        docker-compose exec app php artisan route:clear
        echo "Cache limpo!"
        ;;
    *)
        echo "Uso: $0 {start|stop|restart|logs|shell|artisan|composer|migrate|fresh|seed|clear}"
        echo ""
        echo "Comandos disponíveis:"
        echo "  start      - Inicia os containers"
        echo "  stop       - Para os containers"
        echo "  restart    - Reinicia os containers"
        echo "  logs       - Mostra logs do app"
        echo "  shell      - Abre shell no container"
        echo "  artisan    - Executa comando artisan (ex: ./commands.sh artisan migrate)"
        echo "  composer   - Executa comando composer (ex: ./commands.sh composer install)"
        echo "  migrate    - Executa migrations"
        echo "  fresh      - Recria banco e executa seeders"
        echo "  seed       - Executa seeders"
        echo "  clear      - Limpa todos os caches"
        exit 1
        ;;
esac
