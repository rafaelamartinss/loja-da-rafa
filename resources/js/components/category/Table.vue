<template>
    <div v-if="categories !== undefined" class="container">
        <base-table
            :items="categories"
            :has-permission="true"
            actions="categories"
            :csrf="csrf"
        ></base-table>
    </div>
</template>

<script>
import gql from 'graphql-tag'

const QUERY_CATEGORIES = gql`
    query Categories
    {
        categories{
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
        categories: {
            query: QUERY_CATEGORIES
        },
    }
}
</script>
