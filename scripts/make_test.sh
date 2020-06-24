#!/bin/bash

#Cria novos controllers a partir dos parametros informados

if [ $# -eq 0 ]
  then
    echo "Informe o nome do test (sem Test no final) como parametro"
    exit
fi

#Cada parametro sera tratado como um modelo a ser criado
for NAME in "$@"
do
    #Parametro --unit faz gerar o teste na pasta tests/Unit
    php artisan make:test "$NAME"Test --unit
done
