FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git mysql-server-5.6 && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /app
WORKDIR /app
COPY . /app
