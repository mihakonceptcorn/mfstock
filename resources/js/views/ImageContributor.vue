<template>
    <div>
        <div class="text-center">
            <h2 v-if="loading" class="section-heading text-uppercase">images</h2>
            <h2 v-else class="section-heading text-uppercase">{{ contributorData.name }}'s images</h2>
        </div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <stock-image v-for="stock_image in contributorData.data" :title="stock_image.title" :imagePath="stock_image.path"
                         :key="stock_image.id" :id="stock_image.id"/>
        </div>
        <div class="row">
            <pagination :data="contributorData" @pagination-change-page="getResultsWithPaginate"></pagination>
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
                contributorData: {},
                id: this.$route.params.id,
            }
        },
        mounted() {
            this.getResultsWithPaginate();
        },
        methods: {
            getResultsWithPaginate(page = 1) {
                axios.get('/api/contributor/' + this.id + '?page=' + page)
                    .then(response => {
                        this.contributorData = response.data;
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
