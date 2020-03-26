# Scripter

## Description

Scripter is a light framework developed for help building PHP scripts

## Services
 - Configuration 
 - Database Driver
 - FTP Driver
 - Logger
 - Zipper

## Dependencies

- Zipper:
    ```bash
        sudo apt-get install php-zip
    ```

## Services

### Configuration

We can add a configuration file called 'configuration.json' in the root path of our project
In this configuration we can add custom parameters or/and de default ones. Default paremeters are:

```json
{
    "databases": [
        {
            "name": "",
            "host": "",
            "port": "",
            "user": "",
            "password": ""
        }
    ],
    "ftps": [
        {
            "type": "<sftp|ftp>",
            "name": "<internal identifier>",
            "host": "",
            "port": "",
            "user": "",
            "password": ""
        }
    ]
}
```

#### Autoloading

If databases loaded, you will be able to find them in the code by using:
```php
    $this->getConnection('<name>')
```

If ftps loaded, you will be able to find them in the code by using:
```php
    $this->getFTP('<name>')
```
    