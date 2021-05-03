<template>
    <div>
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Category: {{ category.title }}</h2>
        </div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <stock-image v-for="stock_image in category.images" :title="stock_image.title" :imagePath="stock_image.path"
                      :key="stock_image.id" :id="stock_image.id"/>
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
                category: [],
            }
        },
        mounted() {
            this.loadImagesByCategoryId(this.$route.params.id);
        },
        methods: {
            loadImagesByCategoryId(id) {
                axios.get('/api/category/' + id)
                .then(response => {
                    console.log(response.data);
                    this.category = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    this.not_found = true;
                    this.loading = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>
