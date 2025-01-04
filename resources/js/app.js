import "./bootstrap";

import Alpine from "alpinejs";
import daisyui from "daisyui";
export default {
    plugins: [daisyui],
};

window.Alpine = Alpine;
Alpine.start();
