# SearchBox Plugin
This plugin provides a search box functionality to your map. Underneath it uses the TomTom Fuzzy Search service. For more information about
Fuzzy Search please refer to the documentation: https://developer.tomtom.com/search-api/search-api-documentation-search/fuzzy-search

## Instalation
Include SearchBox script in your page `<head>`:
```
<script src='/SearchBox/SearchBox.js'></script>
```
You must also add the stylesheet:
```
<link href='./SearchBox/SearchBox.css' rel='stylesheet' />
```

# Usage
There are two ways to include search box into your page.
1. Embed it into the map.
2. Get the HTML container and place it wherever you need on your page.

The first way to use search box:
```js
const ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
map.addControl(ttSearchBox, 'top-left');
```
Note, that you need to pass the Tomtom services instance to the search box constructor. The second parameter are the options. They allow you to customize how search box behaves. Options (except `searchOptions.key`) are not mandatory, we provide default ones.
Example options:
```js
{
    idleTimePress: 200,
    minNumberOfCharacters: 3,
    searchOptions: {
        key: '<your-tomtom-search-key>'
        language: 'en-GB'
    },
    units: 'metric',
    filter: function(result[, resultIndex[, results]]) {
        return true;
    },
    noResultsMessage: 'No results found.'
}
```
- idleTimePress - Search service call delay (in ms) after the last typed character.
- minNumberOfCharacters - The minimum number of characters to trigger the search call.
- units - Either 'metric' or 'imperial'. Search results will show the distance from the center of the map, this sets which units should be used.
- searchOptions - All custom options for the Search service. For all parameters please refer to https://developer.tomtom.com/search-api/search-api-documentation-search/fuzzy-search.
- filter - Only results that pass the test implemented in this method will be shown on the results list.
- noResultsMessage - The message shown when a given query Search service returned no results or they were filtered out.

The second way to use search box:
```js

const ttSearchBox = tt.plugins.SearchBox(tt.services.fuzzySearch, options);
const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
//Attach searchboxHTML to your page
```

# Handling events
Search box emits 3 events:
- tomtom.searchbox.resultscleared - Triggered when the clear button is clicked.
- tomtom.searchbox.resultselected - Triggered when the user selects an element on the results list. It is fired after either
clicking on an element or highlighting it using arrow keys and clicking the Enter button.
- tomtom.searchbox.resultsfound - Triggered when the search engine finds results.

If you want to subscribe for the event:
```js
ttSearchBox.on('tomtom.searchbox.resultsfound', function(data) {
    console.log(data);
});
```

# Updating options programatically
If you have initialized the search box and you want to change options later, you can do the following:
```js
ttSearchBox.getOptions() //if you need old options u can also retrieve them
ttSearchBox.updateOptions(newOptions)
ttSearchBox.query()
```
This query method triggers the search with updated options. This is necessary if you want to update results for the user with new options.
