// resources/js/app.js
// Powergrid
import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/tailwind.css'
// Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // Estilos básicos
// Traducción al español
import { Spanish } from "flatpickr/dist/l10n/es";
flatpickr.localize(Spanish);
// Modal
import './open-modal';
