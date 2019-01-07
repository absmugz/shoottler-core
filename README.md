# Shoottler project

> Manage any kind of bookable resources

We are on pre-alpha development stage. You can fork the project, and play around with the code to see what's comming, but we are not ready yet for an alpha version.

## How it's build and special thanks to all the people behind these libraries:
* [Laravel][laravel] 5.7, A PHP framework for web artisans
* [Nicolas Widart][Nwidart] Laravel Modular Approach
* [Ade Novid][Ade-Novid] Laravel + Core UI + [VUE Js][vuejs] boilerplate
* [Core UI][coreui] for Vue, Free Bootstrap Admin Template
* [Axios][axios], [jQuery][jquery], [Moment.js][moment], [Lodash][lodash]
* [Vue Router][vue-router] and [Vuex][vuex], set out of the box
* Notification using [Vue-SweatAlert2][vue-sweatalert2] and [Vue-Notification][vue-notification]
* Loading spinner with [Vue Loading Spinner][vue-loading-spinner]

## Requirement
* **PHP** >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* **Node** >= 8.9.4
* **NPM** >= 5.6.0
* For Ubuntu, require `apt-get install libpng16-dev`, [see](https://github.com/imagemin/imagemin-mozjpeg/issues/28)

## How to Install

* Install using git
```bash
git clone https://github.com/shoottler/shoottler-core.git project_name
```
* Install Dependencies
```bash
cd project_name
composer update
npm install
php artisan migrate
```
* Compile Static Assets
```bash
## for Development
npm run dev

## for Production
npm run prod

```
## Documentation
Under development

## Contributing
We are on a very early stage of our project, we need all the help we can get to make Shoottler the next big booking management app.
PRs accepted.

## License
This project is licensed under the GPL-3.0 License - see the [LICENSE](LICENSE) file for details

[laravel]: https://laravel.com
[Ade-Novid]: https://github.com/adenvt/laravel-coreui-vue
[vuejs]: https://vuejs.org/
[Nwidart]: https://github.com/nWidart/laravel-modules
[coreui]: https://coreui.io
[axios]: https://github.com/axios/axios
[jquery]: https://jquery.com/
[lodash]: https://lodash.com/
[moment]: https://momentjs.com/
[vue-router]: https://router.vuejs.org/
[vuex]: https://vuex.vuejs.org/
[vue-sweatalert2]: https://github.com/avil13/vue-sweetalert2
[vue-notification]: http://vue-notification.yev.io/
[vue-loading-spinner]: https://nguyenvanduocit.github.io/vue-loading-spinner/
[docker-compose]: https://docs.docker.com/compose/
