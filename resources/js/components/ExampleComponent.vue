<template>
  <select class="browser-default custom-select" @change="getYears()">
    <option selected>Select Year</option>
    <option v-for="year in years">{{ year['Year'] }}</option>
  </select>
</template>
<script type="text/javascript">
export default {
    props: ['initialYears'],
    data() {
        return {
            years: _.cloneDeep(this.initialYears),
            feedback: ''
        };
    },
    methods: {
        getYears() {
            axios.get('/api/years/', {
                years: this.years
            })
            .then((res) => {
                    this.years = res.data;
            });
        }
    }
}
</script>
