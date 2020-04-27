# Rock paper scissors game

Php console implementation of rock paper scissors game

## Implementation notes

**This implementation of the game allows extra functionality 
for any number of layers and any number of move options.
For example, besides classic game, there is config for 3 players 
and 5 move options (with extra Spock and Lizard move options).**

After environment setup (see section below), you can run 3 players Spock / Lizard config with

    make run-spock-lizard

### Score system description for more than 2 players
To allow more than 2 players, this game uses player score idea - when player beats competitor,
his score is incremented. Game ranking is implemented by grouping players by score and sort by highest score.

Several players could have the same rank if they have equal score.
For example, if 2 players of 3 have the highest rank, they both get the 1st place, while the least player gets 2nd place.
If all 3 players have the same score - it's a Draw.

### Example screenshot of classic game (2 players, 3 move options)

![Example of classic game output](/docs/img/three-items-two-players.png)

### Example screenshot of extended game (3 players, 5 move options - Spock / Lizard version)

![Example Spock-Lizard gane for 3 players output](/docs/img/spock-lizard.png)

### Lizard / Spock game rules
![Spock Lizard rules](https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Rock_Paper_Scissors_Lizard_Spock_en.svg/1920px-Rock_Paper_Scissors_Lizard_Spock_en.svg.png)

## Architecture explanation

1) Game is implemented as console application

2) No framework dependencies, except composer for autoloading and phpunit 

3) Game is configured via configs in src/config folder. 
Config name could be passed as parameter to console command (see `Makefile` for usage examples).

4) Key Services
     - `RulesService` - compares two moves and selects a winner of 2
     
     - `GameService` - compares all pairs and increments score of player if he wins.
     Then it groups / sorts players by score so players with highest score have the highest rank.
     
     - `GameSeriesService`  - aggregates score per Series of games and ranks players.
      
     - `ProbabilityGameplayStrategyService` - selects move using probability config. Both Random and Always Paper strategies use it.  

     - Models folder with models, typed collections, and factories for them
     
     - `View` folder for visualisation staff
      
     - Some utility classes that run the game like `Controller` and `App`
       
## TODOs (what could be done better or not implemented yet)
  
  - Not all classes are Unit tested (takes some time)
  
   - GameService / GameSeriesService are hard to mock for unit testing 
  
  - To create builders for tests
  
  - In case of framework version, probably its DI modules may be more suitable, than hand-made DI in `Controller` and `App`

  - Think more on refactoring Model names - some of them like `PlayerGameScoreGroupedRankedCollection` and `PlayerGameScoreGroupedSortedCollection` semm messy to me. 

## Game description

In this implementation of the game, two players with different strategies play against each other.

 - Scissors beat the paper

 - Stone beats scissors
 - Paper beats a stone
 - If both players choose the same thing, it's a draw.

Two players with the following strategies are implemented:
 - Player А: selects paper each time
 - Player B: makes a random choice every time 

Players compete 100 times against each other.
As a result, totals summary and each game result is displayed.

**As described before, this implementation of the game 
supports any number of players and move options via config** 

## Prerequisites

Install Docker and optionally Make utility.

Commands from Makefile could be executed manually in case Make utility is not installed.

## Build container and install composer dependencies

    make build

## Build container and install composer dependencies

If dist files are not copied to actual destination, then
    
    make copy-dist-configs
        
## Run application

Runs container and executes console application.

    make run

Runs container and executes version for 5 items and 3 players (Spock / Lizard version)

    make run-spock-lizard

## Run all tests

Runs container and executes all tests.

    make all-tests
    
## Run unit tests

Runs container and executes unit tests.

    make unit-tests

## Run functional tests

Runs container and executes functional tests.

    make functional-tests

## Static analysis

Static analysis check

    make static-analysis
    
## Fix code style

    make cs-fix