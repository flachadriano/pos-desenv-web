# EXECUTE PROJECT ON DOCKER

Start Docker
$ boot2docker up

Start the MAC shell
$ eval "$(boot2docker shellinit)"

$ docker kill $(docker ps -q); docker build -t mymony:latest .; docker run -d -p 80:80 mymony
