# Integrantes 
Imanol Martínez, Mikel Rivera, Diego Nido, Unax Zardoya

# Docker LAMP
Linux + Apache + MariaDB (MySQL) + PHP 7.2 on Docker Compose. Mod_rewrite enabled by default.

## Instructions

If this is the first time you are using this, you must build "web" (docker image) first
```bash
$ docker build -t="web" .
```

Set phpmyadmin's default username and password in docker-compose.yml (MYSQL_USER, MYSQL_PASSWORD)

Enter the following command to start your containers:
```bash
$ docker-compose up -d
```

To stop them, use this:
```bash
$ docker-compose stop
```

The database.sql file will be imported when you create the containers for the first time.

If you are looking for phpMyAdmin, take a look at [this](https://github.com/celsocelante/docker-lamp/issues/2).
