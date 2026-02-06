#!/bin/bash

# Script para compilar assets do Vite

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}Compilando assets do Vite...${NC}"
echo ""

# Verificar se Node.js está instalado
if ! command -v npm &> /dev/null; then
    echo -e "${RED}Erro: Node.js/npm não está instalado!${NC}"
    echo -e "${YELLOW}Instale Node.js para compilar os assets.${NC}"
    echo ""
    echo "Alternativa: Use o modo desenvolvimento:"
    echo "  npm run dev"
    exit 1
fi

# Instalar dependências se necessário
if [ ! -d "node_modules" ]; then
    echo -e "${YELLOW}Instalando dependências do Node.js...${NC}"
    npm install
fi

# Compilar assets
echo -e "${YELLOW}Compilando assets para produção...${NC}"
npm run build

echo ""
echo -e "${GREEN}✓ Assets compilados com sucesso!${NC}"
echo ""
echo "Os arquivos foram gerados em: public/build/"
echo ""
