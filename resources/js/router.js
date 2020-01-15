import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import ProductsTable from './components/product/Table'

export default new Router({
  routes: [
    {
        path: '/products',
        component: ProductsTable
    }
  ]
})
