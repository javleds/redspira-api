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

### Device

#### Get device registries
```
class SomeClass
{
    public function example()
    {
        $parameters = new Javleds\RedspiraApi\DataParameters\DeviceParameters(
            $deviceId, // string Monitor identifier       
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $startDate, // DateTime First date for filtering device entries       
            $endDate, // DateTime Last date for filtering device entries      
            $interval, // string Intervl of time [ApiParameters::HOUR_INTERVAL|ApiParameters::MINUTE_INTERVAL]      
            $tomeOffset, // (opt) int Time offset       
        );        
        
        /** @var Collection<DeviceRegistry> $registries **/
        $registries = \RedspiraApi::device()->get($parameters);        
    }
}
```

#### Get device registries for last hours
```
class SomeClass
{
    public function example()
    {
        /** @var Collection<DeviceRegistry> $registries **/
        $registries = \RedspiraApi::device()->getLastHours(
            $deviceId, // string Monitor identifier
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $hours, // int Hours of interest before now
            $timeOffset // (opt) int Tome offset
        );        
    }
}
```

#### Get device registries for last days
```
class SomeClass
{
    public function example()
    {
        /** @var Collection<DeviceRegistry> $registries **/
        $registries = \RedspiraApi::device()->getLastDays(
            $deviceId, // string Monitor identifier
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $days, // int Days of interest before now
            $timeOffset // (opt) int Tome offset
        );        
    }
}
```

### Areas

```
class SomeClass
{
    public function example()
    {
        /** @var Collection<Area> $areas **/
        $areas = \RedspiraApi::areas()->all();        
    }
}
```

#### Single area

```
class SomeClass
{
    public function example()
    {
        $parameters = new Javleds\RedspiraApi\DataParameters\AreaParameters(
            $areaId, // string Area identifier, you could get them useing RedspiraApi::areas->all();       
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $startDate, // DateTime First date for filtering device entries       
            $endDate, // DateTime Last date for filtering device entries      
            $interval, // string Intervl of time [ApiParameters::HOUR_INTERVAL|ApiParameters::MINUTE_INTERVAL]      
            $tomeOffset, // (opt) int Time offset       
        );        
        
        /** @var Collection<AreaRegistry> $registries **/
        $registries = \RedspiraApi::area()->getRegistries($parameters);        
    }
}
```

#### Single area for last hours

```
class SomeClass
{
    public function example()
    {
        /** @var Collection<AreaRegistry> $registries **/
        $registries = \RedspiraApi::area()->getLastHours(
            $areaId, // string Area identifier
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $hours, // int Hours of interest before now
            $timeOffset // (opt) int Tome offset
        );        
    }
}
```

#### Single area for last days

```
class SomeClass
{
    public function example()
    {
        /** @var Collection<AreaRegistry> $registries **/
        $registries = \RedspiraApi::area()->getLastDays(
            $areaId, // string Area identifier
            $parameterId, // string Parameter or pollutant [ApiParameters::PM25_PARAMETER|ApiParameters::PM10_PARAMETER]
            $days, // int Days of interest before now
            $timeOffset // (opt) int Tome offset
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