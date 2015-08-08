You can run this project like an usual PHP project, but it can run into Docker.

$ cd $HOME/Github/pos-desenv-web/09-programacao-web-2/example

$ sudo docker-osx-dev

$ docker run -v $(pwd):/app -p 80:80 examplephp

# ONE LINE RUN

$ docker kill $(docker ps -q); docker build -t examplephp:latest .; docker run -d -p 80:80 examplephp

# RUN PROJECT

Acces the folder of this project and run the command:
$ docker build -t examplephp .

Run the builded project
$ docker run -d -p 80:80 examplephp

# UPDATE PROJECT AFTER CHANGES

Kill all docker processes:
$ docker kill $(docker ps -q)

And then redo the RUN PROJECT

docker run -d -P --name examplephp -v /examplephpvolume examplephp .
docker run -d -P --name web -v /webapp training/webapp python app.py

docker run -d -P --name examplephp -v /app:/opt/examplephp/deploy examplephp python app.py
docker run -d -P --name examplephp -v /app:/opt/examplephp/deploy examplephp
docker run -d -p 80:80 --name examplephp -v /app:/opt/examplephp/deploy examplephp

docker run -v `pwd`/host/src/path:/container/src/path nodejsapp
docker run -p 80:80 -v `pwd`/Users/flachadriano/Github/pos-desenv-web/09-programacao-web-2/example/app:/app examplephp

docker run -p 80:80 -v $(pwd):/app examplephp

docker run -it -v $(pwd):/app examplephp bash