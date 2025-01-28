# FASE 1: CLIENT SIDE

    $ npm run dev | npm start
    $ npm run build
    $ npm run preview

# FASE 2: SERVER SIDE WITH PHP

    $ npm run build:php => exports css and js for php files in watch-mode
    $ npm run preview:php => to use php built-in webserver. (XAMPP or MAMP can also be used...)

> Do not use /public folder for static assets when using build:php. Because Vite does not scan your html in the php file. It only exports and bundles js and css.
> So just use a /images folder.
