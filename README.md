# Scripter

## Description

Scripter is a light framework developed for help building PHP scripts

## Developing

Anyone is able to improve this framework or documentation by adding services, fixing the existing ones or making the existing ones faster

## Deploying

### Version

Please, in order to mantain a good architecture and compatibility with depending scripts you must consider these rules:

- If your change is a fix or a improvement upgrade security number (0.0.X)
- If your change is a new feature with retrocompatibility with previous versions, upgrade the minor (0.X.0)
- If your change is a new feature without retrocompatibility with previous versions, upgrade the mayor (X.0.0)

<b>Important: </b>We should try to avoid upgrading mayor versions unless neccessary

<b>Important: </b>Never do a workaround. These is a framework, if you need a workaround, do it in your script, not here

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
    
### DBDriver

#### Functions

- replaceOneRaw: Perform a single replace sentence
    - parameters
        - table {string}
        - values {array} -> key is the field, value is the value
- deleteRaw: Perform a delete query
    - parameters
        - table {string}
        - values {array} -> values for the where clause, key is the field, value is the value
- execute: Perform a select query based on a \Scripter\Service\DB\QueryBuilder instance
