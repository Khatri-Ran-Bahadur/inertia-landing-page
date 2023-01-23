import "bootstrap-icons/font/bootstrap-icons.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "./Mixins/translations";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import "./admin.css";
import { useToast } from "vue-toastification";

const toast = useToast();

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";
const options = {
    timeout: 2000,
};
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        const myApp = createApp({ render: () => h(app, props) })
            .use(Toast, options)
            .use(plugin)
            .mixin(translations)
            .use(ZiggyVue, Ziggy);

        // config global property after createApp and before mount
        myApp.config.globalProperties.$toast = toast;
        myApp.mount(el);
        return myApp;
    },
});

InertiaProgress.init({ color: "#fd4e89", showSpinner: true });
