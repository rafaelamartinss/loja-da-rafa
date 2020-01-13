<template>
    <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="#">Loja da Rafa</b-navbar-brand>


        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown text="Cadastros" right>
                <b-dropdown-item :href="routeCategory">Categorias</b-dropdown-item>
                <b-dropdown-item :href="routeProduct">Produtos</b-dropdown-item>
            </b-nav-item-dropdown>

            <form :action="'http:' + logout" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <b-button variant="primary" type="submit" class="mb-2">
                    <b-icon icon="box-arrow-right"></b-icon>
                </b-button>
            </form>
        </b-navbar-nav>
        </b-collapse>
    </b-navbar>
    </div>
</template>

<script>
    export default {
        props: ['username', 'logout', 'csrf', 'routeCategory', 'routeProduct'],
        methods: {
        },
    }
</script>
