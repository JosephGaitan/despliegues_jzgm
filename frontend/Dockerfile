# VERSION SIMPLE PARA AWS
# FROM debian:latest
# LABEL author="josephopgaitan@gmail.com"

# ENV DEBIAN_FRONTEND=noninteractive

# # Instalamos solo Apache, no necesitamos PHP aquí (es solo HTML/JS)
# RUN apt-get update && apt-get install -y \
#     apache2 \
#     curl \
#     && apt-get clean && rm -rf /var/lib/apt/lists/*

# # Habilitamos rewrite por si acaso 
# RUN a2enmod rewrite

# # Logs a stdout
# RUN ln -sf /dev/stdout /var/log/apache2/access.log \
#     && ln -sf /dev/stderr /var/log/apache2/error.log

# EXPOSE 80

# CMD ["apachectl", "-D", "FOREGROUND"]

# VERSION COMPLEJA PARA RENDER
FROM debian:latest
LABEL author="josephopgaitan@gmail.com"

ENV DEBIAN_FRONTEND=noninteractive

# 1. Instalamos Apache y Curl
RUN apt-get update && apt-get install -y \
    apache2 \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Habilitamos módulos necesarios
RUN a2enmod rewrite headers

# 3. Copiamos el código fuente
COPY public_html /var/www/html/frontend/public_html

# 4. INYECTAMOS LA URL DEL BACKEND DE RENDER (HTTPS)
# Esta es la URL que obtuvo en el paso anterior
RUN echo 'const apiUrl = "https://backend-films-daw.onrender.com";' > /var/www/html/frontend/public_html/config/urls.js

# 5. Ajustamos DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/frontend/public_html|g' /etc/apache2/sites-available/000-default.conf

# 6. Permisos y DirectoryIndex
RUN echo "<Directory /var/www/html/frontend/public_html>" >> /etc/apache2/apache2.conf && \
    echo "    Options Indexes FollowSymLinks" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "    DirectoryIndex pages/home.html" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# Logs
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]