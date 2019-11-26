#Tv API Application

This application has 2 main funtionalities:
- Process csv files to storage data
- Request information about external sources 

##Architecture

The application has 3 entry points

API Entry point:
```
/?q=nameOfShow
```
Which it is providing a json as a response with the information requested to the external API and addiotional information in the case that some score would be storaged in the database

ADDING data entry point
```
add/scores
```
This entry point is used to introduced data in tha database application. This will be added to the response.


Healthcheck entry point:
```
/healthCheck
```
This health check is used to check if the application is running. 

The application has been created using hexagonal architecture and the architecture pattern of CQRS.

We have 2 bundle context, both of then are in the Module folder.
The intention of separate both modules is because one of them it is dedicated to writing operations and the other one for lecture. 
They can be promoted to be 2 separated microservices. 
The command and the query are independent of the type of order that start them. 
They have been started from a request from controllers but they could be started from another source. 
The command and the query have primitive types. They are independent. 

It wasn't added a command-bus, but it could be added to writer command in order to have an asyncronous process that allow the application process hugh amount of information.






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

#Improvals
This application can be improved in several aspects. Here I mention some of them. 
- Validate the csv file against the API. 
- Don't introduce repeated information in the database.
- Don't introduce information which storaged information has date posterior.
- Helth check for the database
- Adding Swagger for the API
 


#Configuration

###Cache


#Run 
```
php composer install
```
If everything have gone correctly you will have your symfony application running

If you have any problem, please contact me: jesus.fs.franco@gmail.com

## Running the tests

I have create the unit test and functional test for codeception. 
They can be easily migrate to another framework or system. 

To execute then, once you have your application running in you local machine, execute:

```
php vendor/bin/codecept run unit
```

Take in consideration that I have created one functional test. I could create all the scenarios. 

```
php vendor/bin/codecept run functional
```

You can run also the coverage using 

```
php vendor/bin/codecept run unit --coverage
```

#Application Tree

```
├── Configuration
│   └── Configuration.php
├── Console
│   ├── Commands
│   └── Kernel.php
├── Events
│   ├── CreateScoresEvent.php
│   ├── Event.php
│   └── ExampleEvent.php
├── Exceptions
│   └── Handler.php
├── Http
│   ├── Controllers
│   │   ├── Controller.php
│   │   ├── CSVProcessorController.php
│   │   ├── HealthCheckController.php
│   │   └── TvShowController.php
│   └── Middleware
│       ├── Authenticate.php
│       └── ExampleMiddleware.php
├── Jobs
│   ├── ExampleJob.php
│   └── Job.php
├── Listeners
│   ├── CreateScoresListener.php
│   └── ExampleListener.php
├── Modules
│   ├── DataProcessor
│   │   ├── Application
│   │   │   ├── Command
│   │   │   │   └── CreateScoresFromCsvCommand.php
│   │   │   ├── CommandHandler
│   │   │   │   └── CreateScoresFromCsvCommandHandler.php
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
│   │       ├── CsvReader.php
│   │       ├── Exception
│   │       │   ├── ErrorReadingFileException.php
│   │       │   ├── FileNotExistException.php
│   │       │   ├── InvalidFileExtension.php
│   │       │   └── InvalidFileFormatException.php
│   │       ├── Factory
│   │       │   └── CsvProcessorErrorFactory.php
│   │       ├── FileValidator.php
│   │       └── Repository
│   │           └── ScoreEloquentRepository.php
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
│       │   │   └── ClientException.php
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
│           │   └── APIConfiguration.php
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
