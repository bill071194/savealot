 sudo yum update -y
 which amazon-linux-extras
 sudo  amazon-linux-extras | grep php
 sudo yum remove -y php php-* 
 sudo amazon-linux-extras disable php7.2
 sudo amazon-linux-extras disable lamp-mariadb10.2-php7.2
 sudo amazon-linux-extras enable php8.1
 
 sudo yum clean metadata
 sudo yum install php-cli php-pdo php-fpm php-mysqlnd -y
 sudo systemctl start httpd
 sudo systemctl enable httpd
 
 sudo amazon-linux-extras install mariadb10.5 -y
 sudo service mariadb start
 sudo systemctl enable mariadb
 ln -s /var/www/html webApp
 sudo chown ec2-user /var/www -R

 sudo yum install php-xml -y  
 sudo yum install php-mbstring -y
 
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer global require laravel/installer
