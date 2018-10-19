#!/bin/bash

# 1. Como instalar?
#   Copiar este arquivo para a pasta /opt/dashboard.
#   Na pasta/opt/dashboard deve existir o diretório ancine.
#   Na pasta /opt/dashboard deve existir os arquivos: index-ancine.php, main-ancine.php, console-ancine.php, yiic-ancine.php
# .sudo ./deployAncineServerv0.1.sh ancine_20161116.tar

ARQ=$1
DTF="$(date +"%Y%m%d")"

if [ -n "$ARQ" ]
then
	echo ">>>> INICIANDO Deploy"
	cd /opt/dashboard
	echo "... realizando backup"
	tar -czf dashboard-ancine$DTF.tar.gz ancine/
	echo "... parando serviços"
	service httpd stop
	echo "... deploy"
	rm -rf ancine
	tar -xf $ARQ
	cp -f index-ancine.php ancine/index.php
	cp -f main-ancine.php ancine/protected/config/main.php
	cp -f console-ancine.php ancine/protected/config/console.php
	cp -f yiic-ancine.php ancine/protected/yiic.php
	mkdir ancine/assets
	chown -R apache:apache ancine/
	chmod -R 775 ancine/
	echo "... deployed"
	echo "... iniciando serviços"
	service httpd start
	echo "Deploy realizado!!! <<<<"
else
	# Se eh null
	echo "Nao foi passado parametros arquivo TAR."
fi

