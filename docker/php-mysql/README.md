You can run this project like an usual PHP project, but you can run it on Docker

Only execute this command on the first time
$ docker build -t phpmysqlexample .

Run it on two terminal windows
$ cd $HOME/Github/pos-desenv-web/docker/php

Run it on one of the terminals
$ sudo docker-osx-dev

Run it on the other
$ docker run -v $(pwd):/app -p 80:80 phpmysqlexample
