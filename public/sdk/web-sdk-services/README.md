# Maps SDK for Web

## Documentation


Please refer to the [Services SDK section](https://developer.tomtom.com/maps-sdk-web-js) in the TomTom Developer Portal for detailed documentation with examples.

Also, the latest version of this SDK can be found there.

## Package content

The package contains the following files:

- `services-web.min.js` - Library prepared to be included direcly in your HTML file.
- `services-web.min.js.map` - Source map for the SDK built file.
- `services.min.js` - Library in [UMD format](https://github.com/umdjs/umd). The code is minified and does not need any external dependencies.
- `services.min.js.map` - Source map for the SDK built file.
- `services-node.js` - Library designed for use in Node.js environment.
- `services-node.js.map` - Source maps for the SDK built file.
- `LICENSE.txt` - License file.
- `README.md` - This file.

## Getting started

This library can be used both on the client and node.js server.

### Usage in browser

Services are accessible in a browser through `window` under the tt namespace. See [The tt namespace SDK section](https://developer.tomtom.com/maps-sdk-web-js) in the TomTom Developer Portal for detailed documentation with examples.

The minimal code needed to use services could look like this:

```html
<html>
<head>
    <script src="services-web.min.js"></script>
    <script>
        tt.services.copyrights({
            key: "<your api key>"
        }).go()
            .then(function (results) {
                console.log('Copyrights', results);
            })
            .catch(function (reason) {
                console.log('Copyrights', reason);
            })
    </script>
</head>
<body></body>
</html>
```

Please note that you need to have a valid **API Key** which can be obtained at [TomTom's Developer Portal](https://developer.tomtom.com).
