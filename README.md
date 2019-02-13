![Downloads](https://img.shields.io/github/downloads/robertnicjoo/Resto/v.1/total.svg?style=plastic)
![Follow](https://img.shields.io/github/followers/robertnicjoo.svg?style=plastic)
![Forks](https://img.shields.io/github/forks/robertnicjoo/Resto.svg?style=plastic)
![Stars](https://img.shields.io/github/stars/robertnicjoo/Resto.svg?style=plastic)
[![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)

## About Resto

Resto is simple restaurant application (for testing purpose only)

- [Developer Website](https://tjd-studio.com).
- [Email Me](mailto:robertnicjoo@outlook.com).

## Screenshots

![homepage](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/1.png)
![menuCategories](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/2.png)
![menuItems](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/3.png)
![orders](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/4.png)
![addingOrder](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/5.png)
![employees](https://raw.githubusercontent.com/robertnicjoo/Resto/master/screenshots/6.png)

## Installation

1. Copy all files to your server/OR localhost root
2. Import provided SQL file to your database
3. Connect your database to Resto app by editing `.env` file

### Tips

1. If you don't want to use pre-built database (which I suggest you to do, in order to see built configs), you can run commands below

```
php artisan migrate
php artisan db:seed
```

2. If you set your application properly and seeing an error or white page run commands below:

```
composer dumpautoload
php artisan cache:clear
php artisan view:clear
```

## License

Resto is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
