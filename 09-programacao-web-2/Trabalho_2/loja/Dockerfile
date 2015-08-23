FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git php5-sqlite && rm -rf /var/lib/apt/lists/*
RUN rm -fr /app
ADD . /app