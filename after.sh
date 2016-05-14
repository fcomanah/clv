#!/bin/bash

sudo add-apt-repository ppa:webupd8team/atom

echo '--------------------------------------------------------------------'
#updates and upgrades
echo "Updating" &&
sudo apt-get update -qq
sudo apt-get upgrade -y
sudo apt-get dist-upgrade

PACKAGE_LIST="
atom
firefox
gimp
git
htop
lxde
make
nmap
openssh-server
p7zip-full
p7zip-rar
rar
unrar
unzip
vim
zip
"

for pak in $PACKAGE_LIST ; do
  if ! dpkg -s $pak > /dev/null; then
      echo '--------------------------------------------------------------------'
      echo 'Installing '$pak
      sudo apt-get install -y $pak
  fi
done

echo '--------------------------------------------------------------------'
echo "Installing Apache"
sudo apt-get update
sudo apt-get install -y apache2
echo "Configuring Apache"
sudo a2enmod userdir
sudo service apache2 reload
mkdir ~/public_html
chmod -R 755 ~/public_html
echo '--------------------------------------------------------------------'
echo "Installing MySQL"
sudo apt-get install -y mysql-server php-mysql
#sudo mysql_install_db
#sudo /usr/bin/mysql_secure_installation
echo '--------------------------------------------------------------------'
echo "Installing PHP"
sudo apt-get install -y php php-mcrypt

echo '--------------------------------------------------------------------'
echo "Clonning clv"
cd ~
git clone https://github.com/fcomanah/clv.git
sudo ln -rs clv/* /var/www/html/

cd ~/clv/db/
sudo mysql -u root -p < database.sql
sudo mysql -u clvu -p < clv.sql

echo '--------------------------------------------------------------------'
#cleaning and finishing
echo "Cleaning Up" &&
sudo apt-get -f install &&
sudo apt-get autoremove &&
sudo apt-get -y autoclean &&
sudo apt-get -y clean
sudo apt-get upgrade -y
#sudo reboot
