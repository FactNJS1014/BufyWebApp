<template>
    <div class="flex justify-center">
        <section class="w-[50%]">
            <p class="content"><b>Selected:</b> {{ selected }}</p>
            <b-field label="Find a food">
                <b-autocomplete v-model="name" :data="filteredData" field="WON" open-on-focus :loading="isLoading"
                    @select="option => (selected = option.WON)" />
            </b-field>
        </section>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            name: '',
            selected: null,
            filteredData: [],
            isLoading: false,
        };
    },
    watch: {
        name(newVal) {
            if (newVal.length >= 2) { // เริ่มค้นหาหลังจากพิมพ์ 2 ตัวอักษรขึ้นไป
                this.fetchData(newVal);
            } else {
                this.filteredData = [];
            }
        }
    },
    methods: {
        fetchData(query) {
            this.isLoading = true;
            axios.get('/api/get-won', { params: { q: query } })
                .then(res => {
                    this.filteredData = res.data;
                    this.isLoading = false;
                })
                .catch(() => {
                    this.filteredData = [];
                    this.isLoading = false;
                });
        }
    }
}
</script>
