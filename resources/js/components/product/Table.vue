<template>
    <div v-if="products !== undefined" class="container">
        <base-table
            :items="products"
            :has-permission="true"
            actions="products"
            :csrf="csrf"
        ></base-table>
    </div>
</template>

<script>
import gql from 'graphql-tag'

const QUERY_PRODUCTS = gql`
    query Products
    {
        products{
            id
            name
        }
    }`;

export default {
    props: {
        hasPermission: {
            type: Boolean,
            required: true
        },
        csrf: {
            type:String
        }
    },
    apollo: {
        // Simple query that will update the 'hello' vue property
        products: {
            query: QUERY_PRODUCTS
        },
    }
}
</script>
