# Zoom Plugin

> A plugin that provides the ability to zoom map using ui controls (including range slider).

## Instalation
Include ZoomControls script in your page `<head>`:
```
<script src='/ZoomControls/ZoomControls.js'></script>
```
You must also add the stylesheet:
```
<link href='./ZoomControls/ZoomControls.css' rel='stylesheet' />
```
## Usage
In this example we assume that you already have the TomTom Maps SDK for Web library included.
```js
const ttZoomControls = tt.plugins.ZoomControls({
    className: 'my-class-name', // default = ''
    animate: false // deafult = true
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
    zoom: 12,
    minZoom: 9,
    maxZoom:12
});

map.addControl(ttZoomControls, 'top-left');
```
