function formatAsMetricDistance(distanceMeters) {
    const distance = Math.round(distanceMeters);
    if (distance >= 1000) {
        return Math.round(distance / 100) / 10 + ' km';
    }
    return distance + ' m';
}

var Formatters = {
    formatAsMetricDistance: formatAsMetricDistance
};


window.Formatters = window.Formatters || Formatters;
