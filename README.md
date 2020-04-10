<p align="center">
    <h1 align="center">Checking Self-employed status by ITN code</h1>
    <br>
</p>

This project is based on Yii 2 php framework.


INSTALLATION
------------

### Need to install 
1. [Composer](http://getcomposer.org/), (instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).)
2. [Docker](https://www.docker.com/)
3. [Docker-compose](https://www.docker.com/)

### Install
Clone:
~~~
git clone git@github.com:HotAlexx/itn-checking.git
cd itn-checking
~~~
Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches
