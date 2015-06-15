HOW TO INSTALL DOCKER

brew update

brew install docker

brew install boot2docker

boot2docker init

boot2docker start

docker run hello-world

RUN PROJECT

Acces the folder of this project and run the command:
- docker build .

After finish the command will be shown something like this: 
- Successfully built 43088b2966aa

Get the build hash and use it into this command
- docker run -d -p 80:80 43088b2966aa

UPDATE PROJECT AFTER CHANGES

Kill all docker processes:
- docker kill $(docker ps -aq)

And then redo the RUN PROJECT

ACESSING PROJECT THROUGH BROWSER

Get the ip of the docker server:
- boot2docker ip
	
Will be shown something like this:
- 192.168.59.103
	
Put into the browser:
- http://192.168.59.103/app
	
In this way will be accessed index.html

If want to acess any other file just put after app, like this:
- http://192.168.59.103/app/TestAjax
