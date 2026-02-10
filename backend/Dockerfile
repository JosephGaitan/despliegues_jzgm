FROM debian:latest
LABEL author="josephopgaitan@gmail.com"

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    php-yaml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

# --- SECCIÓN NUEVA PARA RENDER ---
# 1
COPY . /var/www/html/backend

# 2. 

RUN mv /var/www/html/backend/dbconfiguration.render.yml /var/www/html/backend/dbconfiguration.yml

# 3. Ajustamos el DocumentRoot de Apache para que apunte a /backend
RUN sed -i 's|/var/www/html|/var/www/html/backend|g' /etc/apache2/sites-available/000-default.conf

# 4. Permitimos el paso en el directorio (Equivalente al AllowOverride All)
RUN echo "<Directory /var/www/html/backend>" >> /etc/apache2/apache2.conf && \
    echo "    Options Indexes FollowSymLinks" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf
# ---------------------------------

RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]