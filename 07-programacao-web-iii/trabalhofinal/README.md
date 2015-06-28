You can run this project like an usual project, but it can run into a Docker.

To run using Docker, just follow theses steps:

# HOW TO INSTALL DOCKER

In my case, I am using Mac, so these steps to install Docker will only work into Mac OS:

brew update

brew install docker

brew install boot2docker

boot2docker init

boot2docker start

docker run hello-world

# ON RESTART COMPUTER

Start Docker
$ boot2docker up

Start the MAC shell, only to MAC
& eval "$(boot2docker shellinit)"

# RUN PROJECT

Acces the folder of this project and run the command:
$ docker build -t trabalhofinal .

Run the builded project
$ docker run -d -p 80:80 trabalhofinal

# UPDATE PROJECT AFTER CHANGES

Kill all docker processes:
$ docker kill $(docker ps -q)

And then redo the RUN PROJECT

The project can be updated with the commands into only one line:
$ docker kill $(docker ps -q); docker build -t trabalhofinal:latest .; docker run -d -p 80:80 trabalhofinal

# ACESSING PROJECT THROUGH BROWSER

Get the ip of the docker server:
- boot2docker ip
	
Will be shown something like this:
- 192.168.59.103
	
Put into the browser:
- http://192.168.59.103/app
	
In this way will be accessed index.html

# SHOW LOGS

When runa  project, the last output is a hash, get this hash and send as parameter, e.g.:
$ docker logs 692e618da4e7fbbf0487c836abed50aa240be1a4910f4163518b90a7bfb12303

# REMOVING ALL IMAGES

After finish the project can be runned this command to remove all images:
$ docker rmi $(docker images -qf "dangling=true")
