![scrunitizer](https://scrutinizer-ci.com/g/Agares/MicroORM/badges/quality-score.png?b=master)
[![Build Status](https://travis-ci.org/Agares/MicroORM.svg?branch=master)](https://travis-ci.org/Agares/MicroORM)

# What is "MicroORM"?
A MicroORM is a concept that I have seen in .net circles (e.g. [Dapper](https://github.com/StackExchange/dapper-dot-net)).
The goal is to have a library that maps the results of queries into objects, but still leaves the queries themselves to yourself.

# Why?
I like to have control over the code that is executed by my application. 
I believe that the art of writing SQL queries is becoming slowly forgotten by some.
People sometimes forget about the power that lies in their databases and transform the data in code.
But it's hard to write code, that will be as performant as SQL queries 
(and don't forget that queries execute differently, just depending on what data are in the table!). 
Your RDBMS has a lot of power (various caches, indices, query planner), so why let some library generate crappy code that thrashes all of that?