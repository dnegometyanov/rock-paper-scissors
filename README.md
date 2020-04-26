# Rock paper scissors game

Php console implementation of rock paper scissors game

## Implementation notes

**This implementation of the game allows extra functionality 
for any number of layers and any number of move options.
For example, besides classic game, there is config for 3 players 
and 5 move options (with extra Spock and Lizard move options).**

You can run 3 players Spock / Lizard config with

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

## Run unit tests

Runs container and executes unit tests.

    make unit-tests

## Static analysis

Static analysis check

    make static-analysis
    
## Fix code style

    make cs-fix