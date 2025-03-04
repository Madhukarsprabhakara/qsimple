
## About qsimple

qsimple is an open source etl tool which helps run SQL based extract transform and load operations.

### The problem

There are many open source etl tools avaialable for a team to choose from and some a popular too, like dbt. I built Qsimple because I wanted somethig simpler and dedicated to SQL based transformations. The goal was simple, if you know

- To connect to PostgreSQL DB
- Write SQL queries

You should be able to setup transformation jobs. Nothing more nothing less.

The exisitng tools do a lot more and have a lot more features. I just didn't need them because they also made adopting those tools more complicated than necessary.

I also didn't want to pay for ridiculous cloud credits. They are just super EXPENSIVE.

So if you are looking for a simple SQL transformation tool, I welcome you to give this a try. 

### Note

Right now this works only for PostgreSQL DB.


### Deployment steps

- On mac

1. git clone https://github.com/Madhukarsprabhakara/qsimple.git
2. cd  qsimple
3. docker-compose run --rm qs_composer update
4. docker-compose run --rm qs_composer install
5. docker-compose run --rm qs_npm install 
6. cp env/env.example src/.env
7. docker-compose up -d --build qs_php qs_nginx qs_supervisord qs_scheduler qs_artisan
8. docker-compose run --rm qs_artisan migrate 
9. docker-compose run --rm qs_npm run build

Although on windows the steps are pretty much the same but since I don't have a wondows system I ahven't been able to test it there.

### Contact me

msprabhakara[at]gmail[dot]com


