[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Agares/MicroORM/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Agares/MicroORM/?branch=master)
[![Build Status](https://travis-ci.org/Agares/MicroORM.svg?branch=master)](https://travis-ci.org/Agares/MicroORM)

# What is "MicroORM"?
A MicroORM is a concept borrowed from .NET circles (e.g. [Dapper](https://github.com/StackExchange/dapper-dot-net)).
The idea is to have a library that maps the results of queries into objects, but leaves the queries themselves up to you.

# Why?
I like to have control over the code that is executed by my application. 
I believe that in some cases, the art of writing SQL queries is being slowly forgotten.
Programmers sometimes forget about the power that lies in their databases, and they resort to transforming data using code.
But it's hard to write code that will be as performant as SQL queries. 
(And don't forget that queries adapt to execute differently depending on what data is in the table!)

Your RDBMS has a lot of power (caches, indices, query planners), so why let some library generate crappy code that bypasses all of that?
