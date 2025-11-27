#!/bin/bash

# Remove categoria and dashboard related files
rm -f /workspaces/PHP/Aps4--Projeto_Final/app/Http/Controllers/CategoriaController.php
rm -f /workspaces/PHP/Aps4--Projeto_Final/app/Http/Controllers/DashboardController.php
rm -f /workspaces/PHP/Aps4--Projeto_Final/app/Models/Categoria.php
rm -f /workspaces/PHP/Aps4--Projeto_Final/database/migrations/2025_11_24_183815_create_categorias_table.php
rm -f /workspaces/PHP/Aps4--Projeto_Final/database/seeders/CategoriaSeeder.php
rm -f /workspaces/PHP/Aps4--Projeto_Final/resources/views/dashboard.blade.php
rm -rf /workspaces/PHP/Aps4--Projeto_Final/resources/views/categorias/

echo "Categoria and dashboard components removed successfully!"