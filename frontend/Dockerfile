FROM debian:latest
LABEL author="josephopgaitan@gmail.com"

ENV DEBIAN_FRONTEND=noninteractive

# Instalamos solo Apache, no necesitamos PHP aquí (es solo HTML/JS)
RUN apt-get update && apt-get install -y \
    apache2 \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitamos rewrite por si acaso 
RUN a2enmod rewrite

# Logs a stdout
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]