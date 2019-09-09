# Pan Plugin

> A plugin that provides the ability to pan map using ui controls.

## Instalation
Include PanControls script in your page `<head>`:
```
<script src='/PanControls/PanControls.js'></script>
```
You must also add the stylesheet:
```
<link href='./PanControls/PanControls.css' rel='stylesheet' />
```
## Usage
In this example we assume that you already have the Tomtom Maps SDK for Web library included.
```js

const ttPanControls = new tt.plugins.PanControls({
    className: 'my-class-name', // default = ''
    panOffset: 150 // default = 100
});

const map = tt.map({
    key: '<your-tomtom-maps-sdk-key>',
    container: 'map',
    theme: {
        style: 'main',
        layer: 'basic',
        source: 'raster'
    }
}, {
    center: [19.45773, 51.76217],
    zoom: 12
});

map.addControl(ttPanControls, 'top-left');
```
