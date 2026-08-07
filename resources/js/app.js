import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import L from 'leaflet';
import '/node_modules/leaflet/dist/leaflet.css';

window.Alpine = Alpine;
window.L = L;

Alpine.plugin(collapse);
Alpine.start();