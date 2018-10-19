#!/bin/bash
# 1. Como instalar?
#!/bin/bash
#   Copiar este arquivo para a pasta /opt.
#   Na pasta/opt deve existir o diretório dashboard.
#   Na pasta /opt/dashboard deve existir os arquivos: index.php, main.php, console.php, yiic.php
# .sudo ./deployincraServerv0.1.sh incra_20161017.tar.gz

ARQ=$1
DTF="$(date +"%Y%m%d")"

if [ -n "$ARQ" ]
then
        echo ">>>> INICIANDO Deploy"
		cp -r /home/jorgito.paiva/dashboard.tar /opt/
        cd /opt
        echo "... realizando backup"
        tar -czf dashboard$DTF.tar.gz dashboard/
        echo "... parando serviços"
        service httpd stop
        echo "... deploy"
        rm -rf dashboard
        tar -xvf dashboard.tar
        cp -f index.php dashboard/index.php
        cp -f main.php dashboard/protected/config/main.php
        cp -f console.php dashboard/protected/config/console.php
        cp -f yiic.php dashboard/protected/yiic.php
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

