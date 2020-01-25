# redspira-api

Laravel API wrapper for http://app.respira.org.mx/

[![Build Status](https://travis-ci.com/javleds/redspira-api.svg?branch=master)](https://travis-ci.com/javleds/redspira-api)

## Requirements
- Laravel 5.7
- PHP 7.2

## Installation

```
composer require javleds/redspira-api
```

## Usage
By now, Redspira API has only one endpoint, but it is going to grow up with the time

#### Device
```
class SomeClass
{
    public function example()
    {        
        \RedspiraApi::device()->getDataForLastHours(
            'A0034', // device 
            'pm25',  // pollutant
            12 // hours
        );        
    }
}
```

> Built as part of project: https://github.com/Punksolid/calidad-del-aire

## Contribution

If you want to contribute, follow next steps:
- Fork the project
- Create a new branch and perform the necessary changes
- Send your pull request 

## Licence

MIT