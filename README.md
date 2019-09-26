# Users currently viewing page

This package offers a laravel module that tracks users currently viewing a page.
UI is based on bootstrap 4.
This relies on pinging server from front-end. 

## Installation
Require via composer 
```bash
composer require mtcmedia/currently-viewing-page
```

Publish package (or at least its assets) 
```bash
 php artisan vendor:publish --provider=\\Mtc\\CurrentlyViewing\\Providers\\CurrentlyViewingServiceProvider

OR

 php artisan vendor:publish --provider=\\Mtc\\CurrentlyViewing\\Providers\\CurrentlyViewingServiceProvider --tag=assets
```
Add Vue component in your app.js file
```js
Vue.component('currently-viewing', require('./currently_viewing').default);
```

## Usage

Drop in component into template
```html
<currently-viewing></currently-viewing>
```

For linked pages (viewing relationships) you can specify custom url in component

```html
<currently-viewing url="custom_url_here"></currently-viewing>
```

## Contributing
Please see [Contributing](CONTRIBUTING.md) for details.