# MinecraftDatabase

## Description

A website as database for various minecraft things.

For images scroll down.

This project uses the Laravel framework. They have great documentation here: https://laravel.com/docs/

## Features

### General

* Open source
* Flexible / mostly automatically
* Simple
* No user authentication needed
* No advertisement
* No premium features

### Servers

* Personal server pages
* Index all servers
* Support for all 1.7+ servers
* Detects online mode automatically

## Planning (in general)

* Statistics
    * Players -> new players, online players, ...
    * Plugins -> version, usage count, ...
    * Servers -> online/offline, cracked/premium, ...
    * Including webserver ones i.e. added servers,
* Monitoring webserver -> Webpage for viewing viewing recent ping results
* Authless entry removal
    * For servers: verification -> a verification code in the motd
    * For players: verification -> join a premium mc server
* Set a database entry to:
    * Hide only specific properties
    * Private/hide -> only you can still see the statistics
    * Delete it
* Skin database
* Server geo location
* **Better** SEO
* Player database
* API for all features, including UUID resolver, Banner generator, ...

## Installation

### Requirements

* PHP 5.7+
* MySQL or MariaDB (for development you use SQLite too which has no additional setup requirement)
* Webserver with PHP support (or php artisian )

#### Quick setup using virtual machine (Homestead)

If you don't want to install and setup the the things above, you can create a virtual machine for this. Everything
will be configured and you can start using as you started it.

* Install VirtualBox if you don't have it - https://www.virtualbox.org/
* Install Vagrant if you don't have it - https://www.vagrantup.com/
* Clone this repository
* Install composer if you don't have it - https://getcomposer.org/
* Run "composer install"
* Run
    Windows: "vendor\bin\homestead make"
    Linux/Mac: "php vendor/bin/homestead make"
* Run "vagrant up" to start the virtual machine
* SSH to the server using
    * command line: "vagrant ssh"
    * any other programs like Putty to ip:localhost port: 2222 (default -> username=vagrant; password=vagrant)
* Go to the project folder: "cd minecraftdatabase"
* Run "sudo npm install"
* Run "php artisian migrate --seed"
* Run "gulp" or "gulp watch"
* That's it. You can now access it with localhost:8000
* With "vagrant halt" you can stop the machine
* For more details visit https://laravel.com/docs/5.2/homestead

#### Manual setup

* Clone this repository
* Install composer - https://getcomposer.org/
* Install NodeJS - https://nodejs.org
* Run "composer create"
* Run "npm install"
* Run "php artisian migrate --seed"
* Run "gulp"
* Install MySQL (or MariaDB) and a Webserver (for example nginx or apache)
* Check your server config in the ".env"-file
* Let your webserver server point to the public folder
* If you are on a production server add this to your cronjobs to so tasks can run periodically:
    "* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1"

## Updating

* git fetch
* git pull
* gulp
* php artisian migrate

## App specific commands

* php artisian command:ping
    Pings all servers in the database

## Development - Useful commands

### Artisian webserver

* php artisian serve

### Run gulp in the background

* Run "gulp watch"
This will check for modified assets and will deploy them if needed automatically. There is no need to compile
sass files manually

### Debug commands in Tinker

![tinker](http://i.imgur.com/GDFeZIc.png)

* php artisian tinker
* Example: "\App\Server::find(1);"
* exit

### IDE-Helper

* php artisian ide-helper:generate
* php artisian ide-helper:meta
* php artisian ide-helper:models

### List all routes

* php artisian route:list

### Reset your database

* php artisian migrate:refresh --seed

## Screenshots

### Index

![index](http://i.imgur.com/50aiPOM.png)

### Server page

![server page](http://i.imgur.com/HHrgpl4.png)

## Credits

* Website favicon
[Source](https://www.wpclipart.com/computer/icons/database_symbol.png.html)
[License: Public Domain](https://www.wpclipart.com/terms.html)
* Server favicon default
[Source](http://www.iconarchive.com/show/minecraft-icons-by-chrisl21.2.html)
[License: CC Attribution-Noncommercial-No Derivate 4.0](http://creativecommons.org/licenses/by-nc-nd/4.0/)
* Server favicon default 2
[Source](https://www.iconfinder.com/icons/104823/minecraft_icon)
[License: Creative Commons (Unported 3.0)](https://creativecommons.org/licenses/by/3.0/)
* Minecraft Font
[Source](http://www.fonts2u.com/minecraft.schriftart)
[License: Freeware](https://creativecommons.org/licenses/by/3.0/)
* Minecraft Colors
[Source](https://github.com/Spirit55555/PHP-Minecraft)
[License: GPLv3](https://github.com/Spirit55555/PHP-Minecraft/blob/master/LICENSE)
* PHP-Minecraft-Query
[Source](https://github.com/xPaw/PHP-Minecraft-Query)
[License: MIT](https://github.com/xPaw/PHP-Minecraft-Query/blob/master/LICENSE)