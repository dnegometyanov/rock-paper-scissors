# Rock paper scissors game

Php console implementation of rock paper scissors game

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