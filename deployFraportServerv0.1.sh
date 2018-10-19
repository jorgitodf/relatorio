#!/bin/bash
# 1. Como instalar?
#!/bin/bash
#   Copiar este arquivo para a pasta /opt.
#   Na pasta/opt deve existir o diretório dashboard.
#   Na pasta /opt/dashboard deve existir os arquivos: index.php, main.php, console.php, yiic.php
# .sudo ./deployFraportServerv0.1.sh dashboard.tar

ARQ=$1
DTF="$(date +"%d%m%Y")"

if [ -n "$ARQ" ]
then
        echo ">>>> INICIANDO Deploy"
        cd /opt
		mv dashboard.tar dashboard_$DTF.tar
		cp -r /home/jorgito.paiva/dashboard.tar /opt/
        echo "... realizando backup"
        tar -czf dashboard_$DTF.tar.gz dashboard/
        echo "... parando serviços"
        service httpd stop
        echo "... deploy"
        rm -rf dashboard/
        tar -xvf $ARQ
        cp -f index.php dashboard/index.php
        cp -f main.php dashboard/protected/config/main.php
		cp -f fileDownload.php dashboard/fileDownload.php
		cp -f favicon.ico dashboard/favicon.ico
		cp -f viewPDF.php dashboard/viewPDF.php
        chown -R apache:apache dashboard/
        chmod -R 775 dashboard/
        echo "... deployed"
        echo "... iniciando serviços"
        service httpd start
        echo "Deploy realizado!!! <<<<"
else
        # Se eh null
        echo "Nao foi passado parametros arquivo TAR."
fi

