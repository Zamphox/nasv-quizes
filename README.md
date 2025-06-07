# NASV Quizes

The aim of the project is to better remember the information and quiz users on subjects of lessons in the
Hetman Petro Sahaidachny National Army Academy in Lviv, Ukraine.

This is a personal project and is not associated with any establishments.

Created and maintained by cadet
<ins>Mykhailo Poliukhovych</ins>.
<sub>(zamphox@gmail.com)</sub>

<sub>2025</sub>

## Setup

1. \`cp .env.example .env\`
2. \`docker-compose up -d\`
3. \`./vendor/bin/sail artisan migrate --seed\`

## Dev Commands

| Command                                  | Description        |
|------------------------------------------|--------------------|
| ```./vendor/bin/sail down```             | stop containers    |
| ```./vendor/bin/sail build --no-cache``` | build containers   |
| ```./vendor/bin/sail up -d```            | start containers   |
| ```sudo chown -R $USER:$USER .```        | owner fix          |
| ```composer run dev/npm run dev```       | run react frontend |" > README.md





