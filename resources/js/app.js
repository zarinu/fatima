import './bootstrap';
import.meta.glob([
    '../images/**',
    '../font/**',
]);

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
