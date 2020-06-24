#!/bin/bash

#Cria novos controllers a partir dos parametros informados

if [ $# -eq 0 ]
  then
    echo "Informe o nome do controler (sem Controller no final) como parametro"
    exit
fi

#Cada parametro sera tratado como um modelo a ser criado
for NAME in "$@"
do
    php ../artisan make:controller "$NAME"Controller
done
