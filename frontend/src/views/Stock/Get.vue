<template>
    <div class="home">
        <div class="jumbotron">
            <h1>{{ stock.title }}</h1>
        </div>
    </div>
    <div>
        <md-field>
            <label>Initial Value</label>
            <md-input v-model="initial"></md-input>
        </md-field>
    </div>
</template>

<script>
    import axios from "axios";

    export default {

        data() {
            return {
                stock: null
            }
        },
        mounted() {
            axios.get('/v1/stock').then(response => {
                this.stock = response.data;
            });
        },
    }

</script>

<style lang="scss">
    .jumbotron {
        padding: 2rem;

        p:last-of-type {
            margin-bottom: 0;
        }
    }
</style>
