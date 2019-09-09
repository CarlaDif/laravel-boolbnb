if (!window.tail) {
    throw new Error('Tail must be available globally to use the language selector.');
}

var TailSelector = (function() {
    function TailSelector(selectOptions, selector, defaultKey) {
        this.selectOptions = selectOptions;
        this.defaultKey = defaultKey;

        this.selectorElem = createSelectElement.call(this);
        appendOptions.call(this, this.selectorElem);

        this.element = document.querySelector(selector);
        this.element.replaceWith(this.selectorElem);

        this.tailElem = convertToTail.call(this);
    }

    TailSelector.prototype.getElement = function() {
        return this.tailElem;
    };

    function createSelectElement() {
        var selectorElem = document.createElement('select');
        selectorElem.classList = 'tt-select';
        return selectorElem;
    }

    function appendOptions(selectorElem) {
        for (var optionKey in this.selectOptions) {
            var option = document.createElement('option');
            option.value = optionKey;
            option.innerHTML = this.selectOptions[optionKey];
            selectorElem.appendChild(option);
        }
    }

    function convertToTail() {
        var tailSelect = window.tail.select(this.selectorElem, {
            classNames: 'tt-fake-select',
            hideSelected: true
        });

        tailSelect.options.select(this.defaultKey, '#');
        return tailSelect;
    }

    return TailSelector;
})();

window.TailSelector = window.TailSelector || TailSelector;
