#!/bin/bash

# This script will deploy the Xarisma site to the Xarisma
# Peer1 server. It will also set the deploy time in the
# footer line, that will appear on the footer line of the
# destination web site. Note that this script requires
# perl, and will perform a check to insure that perl is
# installed on the local machine.
# Last Rev: 11-May-2015

clear

################ Initialize Variables ################ 
 webRoot="/var/www"
 siteName='xarisma'
 appRoot="$webRoot"/"$siteName"
 targetDir=$HOME/sitebackup
 DATE=$(date +"%Y-%m-%d_%H-%M-%S")
 archiveName="$siteName"_"$DATE".tar.gz
 archiveFullPath="$targetDir"/"$archiveName"

 footerDir="$HOME"/"$siteName"/"src/XarismaBundle/Resources/views/Default"
 footerFile="base.html.twig"

 #- Setup variables for string replacement
 placeHolder='DEPLOY_TIME'
 #deployTime=$(date -R)
 deployTime=$(date +"%Y-%m-%d_%H-%M-%S")


echo "Beginning site deployment"
echo "=================================================="
echo "  - Deploy Time: ""$deployTime"
echo "  - Website : ""$siteName"

################ Create target archive directory if not exists ################
if [ ! -d "$targetDir" ] ; then
   echo "  - Creating Archive directory: ""$targetDir"
    mkdir -p "$targetDir"/
    if [ "$?" != "0" ] ; then
        echo "ERROR: Could not create archive directory. Aborting"
        exit
    fi
else
    echo "  - Archive directory: ""$targetDir"
fi

################ Copy entire website to temporary directory for processing ################
echo "  - Copying web site to temporary directoy"
cp -rf "$appRoot"/ "$targetDir"/
if [ ! -d "$targetDir" ] ; then
    echo "ERROR: Could not copy web site. Aborting"
    exit
fi

echo "  - Removing unneeded directories from website copy"
rm -rf "$targetDir"/"$siteName"/.git/
rm -rf "$targetDir"/"$siteName"/app/cache/*
rm -rf "$targetDir"/"$siteName"/app/logs/*

################ Create TAR archive file ################
echo "  - Creating TAR file: ""$archiveName"
cd $targetDir
tar zcvf  "$archiveFullPath" "$siteName"/ > /dev/null

if [ "$?" != "0" ] ; then
    echo "ERROR: Could not create TAR file. Aborting"
    exit
else
    echo "  - Removing temporary copy of website"
    rm -rf cp -rf "$targetDir"/"$siteName"
fi
################ SCP Archive to Xarisma server and deploy ################
echo "  - Uploading site .tar file to server"
scp "$archiveFullPath" dbriggs@xarisma.com:"$targetDir"/ > /dev/null


#-- Execute following commands on remote server
ssh dbriggs@xarisma.com << EOF
  cd $targetDir
  unlink current_site 
  ln -s "$archiveName" current_site
  echo "  - Unarchiving site to www directory"
  rm -rf ~/"$siteName/*"
  tar xzvf current_site  > /dev/null
#  sudo chmod -R 0777 /var/www/vhosts/xardev.xarisma.com/app/cache
#  sudo chmod -R 0777 /var/www/vhosts/xardev.xarisma.com/app/logs
EOF


