# Practice project for PHP7 compatibility

I'm extremely surprised that people are still using PHP5 in 2019!

This project lets you practice running automated tools against a
code that is artificially stuffed with PHP7 incompatibilities.

Importantly these are artificially created examples and some of them are very rare in the wild.  Don't let this scare you off from using PHP7.  

## Running the tests

If you were migrating this class then you would probably want the methods to return the same value in PHP7 that they do in PHP5.

I've included a test suite where I assert that the value being returned from the `Main` class 
is the one that is expected if you were running PHP5.6

If you wanted to play around with the code and try to make it run under PHP7 you'll be able to quickly verify it's working as expected.

To run the tests you should `composer install` and then run `vendor/bin/phpunit`

Note: You can't run the tests in PHP5.6 because phpunit 4 depends on Doctrine instantiator which no longer supports PHP5.

## Run the code in PHP5.6

The project should run without errors in PHP5.6

From the project root you can run it in docker with this command:  

    docker run -it --rm --name my-running-script -v "$PWD":/usr/src/ -w /usr/src/ php:5.6-cli php src/index.php

# Automated detection tools

Note that neither of the tools are completely accurate in finding all incompatibilities.  php7mar seems a little bit better for this artificial case,
for production I would use both tools. 

## Using php7mar

Run `composer update` to include php7mar and then run `php ./vendor/alexia/php7mar/mar.php -f="./src"`

It will write a report to disk and give you the path so that you can view it.

## Using Phan

The quickest way to do this is by running phan with Docker.

First set up a bash alias to make it transparent that you're running phan through Docker:

    phan() { docker run -v $PWD:/mnt/src --rm -u "$(id -u):$(id -g)" cloudflare/phan:latest $@; return $?; }
    
Now you can run phan on the project, like this:

    phan -l . --exclude-directory-list vendor/