# Tv API Application

This application has 2 main funtionalities:
- Process csv files to store data
- Request information from an external API 

## Architecture

The application has 3 entry points

API Entry point:
```
/?q=nameOfShow
```
This is providing a json as a response with the information requested to the external API and additional information in the case that some score would be stored in the database

ADDING data entry point
```
add/scores
```
This entry point is used to introduce data in tha database application. 
This will be added to the response.


Healthcheck entry point:
```
/healthCheck
```
This health check is used to check if the application is running. 

The application has been created using hexagonal architecture and the architecture pattern of CQRS.

We have a 2 bundle context, both of them are in the Module folder.
The intention of separating both modules is because one of them is dedicated to writing operations and the other one for lecture. 
They can be promoted to be 2 separate microservices. 
The command and the query are independent of the type of order that start them. 
They have been started from a request from controllers but they could be started from another source. 
The command and the query have primitive types. They are independent. 

It wasn't added a command-bus, but it could be added to writer command in order to have an asyncronous process that allows the application to process huge amounts of information.

```
├── Configuration
│   ├── APIConfiguration.php
│   └── ConfigurationInterface.php
├── Console
│   ├── Commands
│   └── Kernel.php
├── Http
│   ├── Controllers
│   │   ├── Controller.php
│   │   ├── CSVProcessorController.php
│   │   ├── HealthCheckController.php
│   │   └── TvShowController.php
│   └── Middleware
│       ├── Authenticate.php
│       └── ExampleMiddleware.php
├── Modules
│   ├── DataProcessor
│   │   ├── Application
│   │   │   ├── Command
│   │   │   │   └── CreateScoresFromCsvCommand.php
│   │   │   ├── CommandHandler
│   │   │   │   └── CreateScoresFromCsvCommandHandler.php
│   │   │   ├── Configuration
│   │   │   │   └── DataProcessorConfiguration.php
│   │   │   ├── Exception
│   │   │   │   ├── ErrorReadingFileException.php
│   │   │   │   ├── FileNotExistException.php
│   │   │   │   ├── InvalidFileException.php
│   │   │   │   └── InvalidFileFormatException.php
│   │   │   ├── Factory
│   │   │   │   └── CsvProcessorErrorFactory.php
│   │   │   └── Service
│   │   │       ├── CsvReader.php
│   │   │       └── FileValidator.php
│   │   ├── Domain
│   │   │   ├── Score.php
│   │   │   └── ScoreRepository.php
│   │   └── Infrastructure
│   │       ├── Configuration
│   │       │   └── Configuration.php
│   │       ├── Exception
│   │       │   ├── ErrorReadingFileException.php
│   │       │   ├── FileNotExistException.php
│   │       │   ├── InvalidFileExtension.php
│   │       │   └── InvalidFileFormatException.php
│   │       ├── Factory
│   │       │   └── CsvProcessorErrorFactory.php
│   │       ├── Repository
│   │       │   └── ScoreEloquentRepository.php
│   │       └── Service
│   │           ├── CsvReader.php
│   │           └── FileValidator.php
│   └── TvShow
│       ├── Application
│       │   ├── Adapter
│       │   │   └── CacheProxy.php
│       │   ├── Client
│       │   │   └── Client.php
│       │   ├── Configuration
│       │   │   └── Configuration.php
│       │   ├── Decorator
│       │   │   ├── ResponseDecoratorInterface.php
│       │   │   └── ResponseDecorator.php
│       │   ├── Exception
│       │   │   ├── ClientException.php
│       │   │   └── EmptyArgumentException.php
│       │   ├── Factory
│       │   │   ├── ErrorFactory.php
│       │   │   ├── TvShowFactoryInterface.php
│       │   │   └── TvShowFactory.php
│       │   ├── Query
│       │   │   ├── Query.php
│       │   │   └── TvShowQuery.php
│       │   ├── QueryHandler
│       │   │   ├── QueryHandler.php
│       │   │   └── TvShowQueryHandler.php
│       │   ├── Searcher
│       │   │   ├── TvShowSearcherInterface.php
│       │   │   └── TvShowSearcher.php
│       │   └── ValueObject
│       │       └── Url.php
│       ├── Domain
│       │   ├── Exception
│       │   │   └── InvalidTvShowNameException.php
│       │   ├── Score.php
│       │   ├── ScoreRepository.php
│       │   └── TvShow.php
│       └── Infrastructure
│           ├── Client
│           │   └── TvMazeClient.php
│           ├── Configuration
│           │   └── Configuration.php
│           ├── Exception
│           │   └── ClientException.php
│           ├── Factory
│           │   └── ErrorResponseFactory.php
│           ├── Proxy
│           │   └── CacheProxy.php
│           └── Repository
│               └── ScoreEloquentRepository.php
└── Providers
    ├── AppServiceProvider.php
    ├── AuthServiceProvider.php
    └── EventServiceProvider.php
```

# Improvments
This application can be improved in several aspects. Here I mention some of them. 
- Validate the csv file against the API. 
- Don't introduce repeated information in the database.
- Don't introduce information which stored information has an earlier date.
- Health check for the database
- Adding Swagger for the API
- Use the Exceptions/Handler instead having the factories for the responses
- We can retrieve more information from the external API


# Configuration

## Instructions to start the application

- Clone the repository
- Unzip the application
- If you have composer and php run the next command:
```
php composer install
```
- Run the migrations to create the database and the table
```
php artisan migrate
```

The configurable parameters in the .env are the next:

```
API_TVMAZE_URL=http://api.tvmaze.com/search/shows?q=
CACHE_TIME="10 minutes"
CACHE_ENABLED=true
CSV_DELIMITER=";"
```
- API_TVMAZE_URL is the url to the external API
- CACHE_TIME is the time that you can configure your cache working
Example: "1 hour", "2 hours", "1 minutes", "10 minutes", "1 day"
- CACHE_ENABLED: Allows you to enable or disable the cache
- CSV_DELIMITER: You can change the delimiter in the csv

If everything has gone correctly you will have your lumen application running

If you have any problems, please do not hesitate to contact me at jesus.fs.franco@gmail.com

## Running the tests

I have created the unit test and functional test for codeception. 
They can be easily migrated to another framework or system. 

To execute them, once you have your application running in your local machine, execute:

```
php vendor/bin/codecept run unit
```

You can also run the coverage using 

```
php vendor/bin/codecept run unit --coverage
```


Take into consideration that I have created one functional test. I could create all the scenarios. 

```
php vendor/bin/codecept run functional
```
