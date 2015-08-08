TECNOLOGIAS PARA O DESENVOLVIMENTO APLICAÇÕES WEB
==============

# DOCKER

For some projects, Docker can be used to run.

# HELPERS

-d, --detach=false         Run container in background and print container ID

# HOW TO INSTALL DOCKER

$ brew update

$ brew install docker

$ brew install boot2docker

hot update of the files when change
$ curl -o /usr/local/bin/docker-osx-dev https://raw.githubusercontent.com/brikis98/docker-osx-dev/master/src/docker-osx-dev
$ chmod +x /usr/local/bin/docker-osx-dev
$ docker-osx-dev install

$ boot2docker init

$ boot2docker start --vbox-share=disable

install rsync to sync dev folder when running projects
$ boot2docker ssh "tce-load -wi rsync"

$ docker run hello-world

# ON RESTART COMPUTER

Start Docker
$ boot2docker up

Start the MAC shell
& boot2docker shellinit

# ACESSING PROJECT THROUGH BROWSER

Get the ip of the docker server:
$ boot2docker ip
	
Will be shown something like this:
- 192.168.59.103
	
Put into the browser:
- http://192.168.59.103/app
	
In this way will be accessed index.html

# SHOW LOGS

When run a project, the last output is a hash, get this hash and send as parameter, e.g.:
$ docker logs 692e618da4e7fbbf0487c836abed50aa240be1a4910f4163518b90a7bfb12303

# REMOVING ALL IMAGES

After finish the project can be runned this command to remove all images:
$ docker rm -f $(docker ps -aq)
