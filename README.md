# Task 2 : Gemini Club Inductions Server

## Setup
To setup apache, php ( for website ) and cronjob ( for db backup )
```sh
bash setup.sh
```
> __Note__ : During setup, you are asked to set mysql root password. This is to setup cronjob for creating backup service. Use the same password in `compose.yaml` 

## Environment variables
|Variable|Use|
| ------ | ------ |
| `MYSQL_PASSWORD` | Root password for `mysql` service ( Set the same as before ) |
| `PHPMYADMIN_USER` ,`PHPMYADMIN_PASSWORD` | Credentials for read-only account at `PHPMyAdmin` service |
| `WEBSITE_PASSWORD` | Password for `core` to see user details at `user.gemini.club` |
>__Note__ : Do not change other variables.

## Docker
- Whole server setup is dockerised and image is available @ [DockerHub](https://hub.docker.com/r/revanth7733/gemini)
- Server image `gemnini` requires `mysql` and `phpmyadmin` docker images. All required images will be pulled automatically. 
- Before starting the containers, set the environment variables in `compose.yaml`
- If you want to build the image from base linux image, comment `image : gemini` line in `compose.yaml` . This will build image while running `docker compose` .  `Dockerfile` and other required files for building image are available in `docker_build` directory
- To start the server, use the following command.
```sh
docker compose up -d
```
>__Note__ : Do not use `docker-compose` (v1). `compose.yaml`  is written for `docker compose` (v2)


## Usage
To run the alaises, first start the interactive terminal for user by the following command and then run the aliases.
```sh
docker exec -it gemini sudo -u [username] bash
```
>__Note__ : Username for mentor is their names and for mentees it is their roll no. preceded by `r` like `r10222074` 

## Websites
|Website|Use|
| ------ | ------ |
| http://gemini.club | Displays the `mentees_domain` file in `core`  home directory |
| http://db.gemini.club | To manage database by `PHPMyAdmin` service |
| http://user.gemini.club | Displays the user details based on their permissions | 
>__Note__ : To see user details, set the password for user by `New User` option. Username for mentees is their roll no. and for mentors it is their names.


## Persistence
- `Database` -> For persisting database, volume named`db` is created and mounted to `/var/lib/mysql` in `mysql` container.
- `core home` -> For persisting `core` home directory, another volume is created. To persist user accounts, `/etc/passwd` and `/etc/group` are copied to `core` home and it is restored while starting the container.

## Other details
- For websites, `/etc/hosts` is modified accordingly for local DNS.
- For SQL Queries, `mysql-connector-python` module is used. Instead of installing module by `pip`, it is extracted from `.tar.xz` file because installing `pip` increases image size by `350MB`
- User Details website is made using `PHP` 

