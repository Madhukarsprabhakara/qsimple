
## About qsimple

qsimple is a web based data transformation platform that helps automate sql tasks that need repeated execution.

### The problem

There are many open source etl tools avaialable for a team to choose from and some a popular too, like dbt. I built Qsimple because I wanted somethig simpler and dedicated to SQL based transformations. The goal was simple, if you know

- To connect to PostgreSQL DB
- Write SQL queries

You should be able to setup transformation jobs. Nothing more nothing less.

The exisitng tools do a lot more and have a lot more features. I just didn't need them because they also made adopting those tools more complicated than necessary.

I also didn't want to pay for ridiculous cloud credits. They are just super EXPENSIVE.

So if you are looking for a simple SQL transformation tool, I welcome you to give this a try. 

### Note

Right now this works only for PostgreSQL server.


### Deployment steps

- On mac

git clone https://github.com/Madhukarsprabhakara/qsimple.git

cd  qsimple
docker-compose run --rm qs_composer update
docker-compose run --rm qs_composer install

docker-compose run --rm qs_npm install 

cp env/env.example src/.env


#### On your local


#### In production



