# Maps SDK for Web

## Documentation

Please refer to the [Maps SDK section](https://developer.tomtom.com/maps-sdk-web-js) in TomTom's Developer Portal for detailed documentation with examples.

Also, the latest version of this SDK can be found there.

## Package content

The package contains the following files:

- `maps-web.min.js` - Library prepared to be included direcly in your HTML file.
- `maps-web.min.js.map` - Source map for the SDK build file.
- `maps.min.js` - Library in [UMD format](https://github.com/umdjs/umd). The code is minified and does not need any external dependencies.
- `maps.min.js.map` - Source map for the SDK build file.
- `maps.css` - Cascading Style Sheet needed by the library. It must be included in your webpage in order to render the expected map.
- `LICENSE.txt` - License file.
- `README.md` - This file.
- `css-styles/` - Cascading Style Sheets providing utility classes (e.g., poi icons and traffic incidents marker styles).

## Getting started

Please check the examples for a better understanding of the common use cases. The minimal *HTML* page allowed to display
the TomTom map could look like this:

```html
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="map.css"/>
        <script src="map-web.min.js"></script>
    </head>
    <body style="width: 100%; height: 100%; margin: 0; padding: 0;">
        <div id="map" style="width: 100%; height: 100%;"></div>
        <script>
            const map = tt.map({
                key: "<your maps api key>",
                container: "map"
            });
        </script>
    </body>
</html>
```

Please note that you need to have a valid **API Key** which can be obtained at [TomTom's Developer Portal](https://developer.tomtom.com).

