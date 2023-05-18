FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -q -y ssmtp mailutils libpng-dev && rm -rf /var/lib/apt/lists/*
# root is the person who gets all mail for userids < 1000
RUN echo "root=camagru.yodana@gmail.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=camagru.yodana@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=gdmiwwckfwmgfrkk" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf

# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
RUN apt-get update && apt-get upgrade -y