/*
 *
 * Retrieve Hash Tags from URL
 * Will be removed by jquery.hasher.js to parse Hashtags more detailed
 **/

// Writes String post Hashtag to hasher
hasher = document.location.hash;
hasher = hasher.replace(/^.*#/, '');

$('#debugger').append('> hashtag' + hasher);

