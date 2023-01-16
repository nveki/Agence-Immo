# Agence Immo 

## Description
un site dynamique pour agence Immobilière 

## How to install

### Clone repo

```bash
# clone the repo from Github through SSH
git clone git@github.com:nveki/Agence-Immo.git
```

### Config .env.local
```bash

```
### Install project's dependencies
```shell
# cd into the project directory ( ~cd var/.../.../Agence-Immo
~composer update
```
### Config .env.local
```bash
- Copy ".env" and rename the copy by ".env.local"
- Delete everything in ".env.local"
- Check if ".env.local" is in ".gitignore"
- In file ".env.local",  copy and modify DATABASE_URL="mysql://DBUSERNAME:!DBPASSWORD!@127.0.0.1:3306/DBNAME?serverVersion=mariadb-10.3.25" 
with your information username, password and database name. 

```
### Create database

In VSC shell 
```shell
~ bin/console doctrine:database:create
```
### Do the migrations
#! Delete the Version files in 'migrations/' (not the .gitignore)if necessary
Then
In VSC shell 
```shell
~ bin/console make:migration
```
followed by
```shell
~ bin/console doctrine:migrations:migrate
``` 

### Install TailwindCSS PostCss & Autoprefixer
```shell
# cd into the project directory ( ~cd var/.../.../Agence-Immo
~npm install -D tailwindcss postcss autoprefixer
```
### Build 
```shell
# cd into the project directory ( ~cd var/.../.../Agence-Immo
~npm run dev 
or 
~npm run watch (if you don't want to build everytime) 

```

