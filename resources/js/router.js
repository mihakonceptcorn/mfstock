import vueRouter from 'vue-router';
import Vue from 'vue';
import Index from "./views/Index";
import ImageCategory from "./views/ImageCategory";
import ImageSingle from "./views/ImageSingle";
import ImageContributor from "./views/ImageContributor";
import ImageSearch from "./views/ImageSearch";

Vue.use(vueRouter);

const routes = [
    {path: "/", component: Index},
    {path: "/category/:id", component: ImageCategory},
    {path: "/contributor/:id", component: ImageContributor},
    {path: "/image/:id", component: ImageSingle},
    {path: "/about-us", component: Index},
    {path: "/search/", component: ImageSearch, props: true, name: 'search'},
];

export default new vueRouter({
    mode: "history",
    routes: routes
});
