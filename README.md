## Epsilon Services

This application consumes CloudLX API for getting Users services.

### Installation
- Run `composer install` to install all dependencies.
- Rename `.env.example` to `.env` where to store all sensitive information. Default needed settings are included there.
- Create empty database (by default=laravel), and populate proper data in `.env` file in Database section to be able to connect to MySQL server.
- Since this app does not store any information about users etc., there is no need to run 

    ```php artisan migrate --seed```
- Run 
 
    ```php artisan key:generate``` 
    
    for generation of encryption key if value APP_KEY in `.env` file is empty.
- The frontend files are pre-generated, but can run `npm install` and `npm run dev`/`npm run prod` to install and compile files again.

### Packages used
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)
- [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) for enabling code completion.
- [fruitcake/laravel-cors](https://github.com/fruitcake/laravel-cors) allows you to send Cross-Origin Resource Sharing headers with Laravel middleware configuration.

- [vuex](https://vuex.vuejs.org/) for managing app state. 
- [bootstrap-vue](https://bootstrap-vue.js.org/docs/components/form/) for visual components. 

### Extra info
- The password for 'peter.pgk@gmail.com' user is in .env file

### TODO
- Finishing `'refresh_token'` procedure
- Handling errors from FE
