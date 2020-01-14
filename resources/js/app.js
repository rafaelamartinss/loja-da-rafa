import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'
import VueApollo from 'vue-apollo'
import { ApolloClient } from 'apollo-client'
import { createHttpLink } from 'apollo-link-http'
import { InMemoryCache } from 'apollo-cache-inmemory'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(VueApollo)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('the-sidebar', require('./components/layout/TheSidebar.vue').default);
Vue.component('base-table', require('./components/StoreBaseTable.vue').default);
Vue.component('base-form', require('./components/StoreBaseForm.vue').default);
Vue.component('category-table', require('./components/category/Table.vue').default);
Vue.component('product-table', require('./components/product/Table.vue').default);


const httpLink = createHttpLink({
    // You should use an absolute URL here
    uri: 'http://localhost:3000/graphql',
});

const cache = new InMemoryCache();

const apolloClient = new ApolloClient({
link: httpLink,
cache,
});

const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
});

const app = new Vue({
    el: '#app',
    apolloProvider,
});
