# Usa PHP CLI como base
FROM php:8.2-cli

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    gnupg \
    ca-certificates \
    && docker-php-ext-install zip pdo pdo_mysql 

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala Node.js (versión LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Verifica instalaciones
RUN php -v && composer -V && node -v && npm -v

# Establece el directorio de trabajo
WORKDIR /app
