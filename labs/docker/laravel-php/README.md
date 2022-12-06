# Docker image for php-fpm in production environment


Highlights:

- All PHP modules needed for Laravel (or any other PHP framework really)
- Composer embedded in container

#### How to use ?
This image is intended to be used as base image for your project.
> Image can be pulled from DockerHub with `docker pull vivifyideas/php-fpm-production`

### How to customize `php.ini` ?
You can add `custom.ini` file that will extend `php.ini`, this file should be located at `/usr/local/etc/php/conf.d/custom.ini
`
