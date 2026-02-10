
FROM debian:latest
LABEL author="josephopgaitan@gmail.com"

# Evitar interacciones durante la instalación
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    php-yaml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

# Configuración de Apache para que los logs vayan a la salida estándar (Docker logs)
# Esto ayuda a ver errores sin entrar al contenedor
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

# Exponemos el puerto 80 del contenedor
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]