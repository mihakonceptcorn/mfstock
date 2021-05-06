<template>
    <div>
        <div class="text-center">
            <h2 v-if="loading" class="section-heading text-uppercase">Category:</h2>
            <h2 v-else class="section-heading text-uppercase">Category: {{ categoryData.title }}</h2>
        </div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <stock-image v-for="stock_image in categoryData.data" :title="stock_image.title" :imagePath="stock_image.path"
                      :key="stock_image.id" :id="stock_image.id"/>
        </div>
        <div class="row">
            <pagination :data="categoryData" @pagination-change-page="getResultsWithPaginate"></pagination>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from "axios";
    import StockImage from "../components/StockImage";
    export default {
        components: {
            Spin,
            StockImage
        },
        data() {
            return {
                loading: true,
                not_found: false,
                categoryData: {},
                id: this.$route.params.id,
            }
        },
        mounted() {
            this.getResultsWithPaginate();
        },
        methods: {
            getResultsWithPaginate(page = 1) {
                axios.get('/api/category/' + this.id + '?page=' + page)
                    .then(response => {
                        this.categoryData = response.data;
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
