
<h1 align="center">
  Time Tracker
</h1>

<p align="center">
  This is a imple task tracker that allows users to create tasks and track the time spent on them. Hexagonal Architecture and DDD an SOLID principles have been applied in the solution.
</p>

## Installation and configuration

### Clone repository

1. Clone this project into a machine with
   Docker installed

       git clone https://github.com/niladalia/time-tracker

2. Move to the project folder:

        cd time-tracker

### Environment configuration

1. Create a local .env file

        cp .env .env.local

### Project setup

1. Install all dependencies :

        make build


3. Now you can access http://localhost:82/

###  Tests

1. Execute Phpunit and Behat tests:

        make run-tests

### Arquitechture

My initial approach for this task was to maintain a completely decoupled
context between Sessions and Tasks, adhering more strictly to DDD principles.
However, I ultimately decided to couple Tasks and Sessions because they are
tightly related in the context of time tracking. Separating these contexts
would have resulted in an overly complex architecture,
requiring ACLs to retrieve session-related information—an unjustified
overhead for this app. Since sessions are the core mechanism for measuring
time spent on tasks, coupling them simplifies the implementation, keeps the
domain logic coherent, and aligns with hexagonal architecture, while making
a minor but justified compromise on DDD principles.


### Hexagonal architecture and DDD
As per requirements, this project follows Hexagonal architecture as a base for the implementation of the Domain Driven Design.
So we have our app structured over 3 different layers  Infrastructure, Application and Domain. Placing all the
external dependencies and entry points in Infrastructure, all the use cases in Application, and the domain entities
attributes and entities in the Domain layer.
This is the structure of the src folder :

```scala
$ tree -L 4 src

└── Tasks
    ├── Application
    │     ├── Create
    │     │     └── TaskCreator.php
    │     ├── CreateAndStart
    │     │     ├── DTO
    │     │     └── TaskCreateAndStart.php
    │     ├── Find
    │     │     ├── DTO
    │     │     ├── TaskFindByName.php
    │     │     ├── TaskFinder.php
    │     │     └── TasksFinder.php
    │     ├── Resolver
    │     │     ├── DTO
    │     │     └── TaskResolver.php
    │     ├── Start
    │     │     └── TaskStarter.php
    │     ├── Stop
    │     │     ├── DTO
    │     │     └── StopTask.php
    │     └── TaskOverview
    │         ├── DTO
    │         └── TasksOverview.php
    ├── Domain
    │     ├── Exceptions
    │     │     ├── TaskHasOpenSessionsException.php
    │     │     └── TaskNotFound.php
    │     ├── Task.php
    │     ├── TaskRepository.php
    │     ├── Tasks.php
    │     └── ValueObject
    │         ├── TaskId.php
    │         ├── TaskName.php
    │         ├── TaskStartTime.php
    │         ├── TaskTotalTime.php
    │         └── TaskUpdatedAt.php
    └── Infrastructure
        ├── Controllers
        │       ├── TaskStartController.php
        │       └── TaskStopController.php
        └── Persistence
            └── Doctrine

```

## TODO 
Depending on the browser, security restrictions may prevent the app from showing an alert when the user refreshes the page. I added that alert to prevent losing active tracks. In the future, it would be beneficial to include a STOP button in the task list, allowing the app to manage multiple open tasks and stop them individually.
