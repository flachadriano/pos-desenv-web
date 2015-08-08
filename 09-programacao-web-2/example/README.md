You can run this project like an usual PHP project, but you can run it on Docker

$ cd $HOME/Github/pos-desenv-web/09-programacao-web-2/example

$ sudo docker-osx-dev

$ docker run -v $(pwd):/app -p 80:80 examplephp