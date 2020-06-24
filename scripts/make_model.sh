#!/bin/bash

#Cria novos modelos com migrations utilizando
#o artisan a partir dos parametros informados

if [ $# -eq 0 ]
  then
    echo "Informe o nome do modelo como parametro"
    exit
fi

#Cada parametro sera tratado como um modelo a ser criado
for MODELO in "$@"
do
    php ../artisan make:model "$MODELO" -m
done
