# Instalación Proyecto Hyundauto

- Pasos para restaurar el proyecto:
  - 1) php bin/console doctrine:database:create
  - 2) php bin/console make:migration
  - 3) php bin/console doctrine:migrations:migrate
  - 4) http://localhost:8000/tipos/insertar/Eléctrico
  - 5) http://localhost:8000/tipos/insertar/Híbrido
  - 6) http://localhost:8000/modelos/insertar
  - 7) http://localhost:8000/modelos/consultar
  - 8) http://localhost:8000/modelos/consultarJSON