<template>
    <div>
        <spin v-if="loading"></spin>
        <div class="row" v-else-if="searchResult">
            <stock-image v-for="stock_image in searchData.data" :title="stock_image.title" :imagePath="stock_image.path"
                         :key="stock_image.id" :id="stock_image.id"/>
        </div>
        <div class="row" v-else>
            <h2>No results Found</h2>
        </div>
        <div class="row">
            <pagination :data="searchData" @pagination-change-page="getResultsWithPaginate"></pagination>
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
                searchData: {},
                searchResult: false,
            }
        },
        mounted() {
            this.getResultsWithPaginate();
        },
        methods: {
            getResultsWithPaginate(page = 1) {
                if (this.$route.query.keywords && this.$route.query.keywords.length) {
                    axios.get('/api/search/' + this.$route.query.keywords.replace(/ .*/,'')
                        + '?page=' + page)
                        .then(response => {
                            this.searchData = response.data;
                            this.loading = false;
                            if (this.searchData.data && this.searchData.data.length) {
                                this.searchResult = true;
                            }
                        });
                } else {
                    this.loading = false;
                    this.searchResult = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
