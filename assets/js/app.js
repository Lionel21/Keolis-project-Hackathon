/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */


/* MAP */
import * as L from 'leaflet';
// eslint-disable-next-line import/no-unresolved
import 'leaflet-defaulticon-compatibility';
import 'leaflet/dist/leaflet.css';
import 'leaflet-defaulticon-compatibility/dist/leaflet-defaulticon-compatibility.webpack.css';
// eslint-disable-next-line no-unused-vars
import { GestureHandling } from 'leaflet-gesture-handling';
import 'leaflet-gesture-handling/dist/leaflet-gesture-handling.css';
import 'leaflet.markercluster';
import 'leaflet.markercluster/dist/leaflet.markercluster';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';
import 'leaflet-routing-machine';
import 'leaflet-routing-machine/dist/leaflet-routing-machine.css';
import 'leaflet-routing-machine/src/localization';

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

const $ = require('jquery');

// eslint-disable-next-line import/no-extraneous-dependencies
require('bootstrap');

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
