# Gist control app
This app makes connects with a Github app to control gists and their respective comments using an OAuth connection.

## Before you run it
There have not been used any external libraries except `Laravel` (the library `firebase/php-jwt` is installed according to `composer.json`, but it has not been used, so it's not necessary to install).

The only requirement before starting the app besides installing `Laravel` is to fill out the `.env` file with the following variables:
* `GITHUB_APP_ID`
* `GITHUB_APP_NAME`
* `GITHUB_APP_CLIENT_ID`
* `GITHUB_APP_CLIENT_SECRET`
* `GITHUB_APP_REDIRECT_URI`

Their values are stored in a more safe place. When the variables above are filled out with the correct values in the `.env` file, the app can be started with the following command:

```
php artisan serve
```

If you have some other app blocking port `8000`, please shut them down as this app is supposed to run on port `8000`.


## Reflections
I wanted to keep the API integration into a single unit, so I created a `service` that can be used by the controller to keep things simple and isolated. This also simplifies the controller logic.

One consideration is to split up the `GistController` into a `GistController` and `CommentController` and do the same thing for the `GistService`. The reason it that they are so connected that I reckoned they belong in the same controller. If the functionality gets larger, then a split would be obvious.

## Learning resources

* [Youtube tutorial](https://www.youtube.com/watch?v=_LA9QsgJ0bw&t=1350s&pp=ygUQbGFyYXZlbCB0dXRvcmlhbA%3D%3D)
* [Laravel: Create a project](https://laravel.com/docs/10.x/installation#creating-a-laravel-project)
* [Laravel: Controllers](https://laravel.com/docs/10.x/controllers)
* [Laravel: Views](https://laravel.com/docs/10.x/views)
* [Laravel: CSRF protection](https://laravel.com/docs/10.x/csrf)
* [Stack overflow: PUT method in forms](https://stackoverflow.com/questions/28143674/laravel-form-html-with-put-method-for-put-routes)