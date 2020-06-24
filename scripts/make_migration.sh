#!/bin/bash

#Cria novos controllers a partir dos parametros informados

if [ "$#" -ne 2 ]
  then
    echo "Informe o nome da migration e o nome da tabela"
    exit
fi

php ../artisan make:migration "$1" --table="$2"

