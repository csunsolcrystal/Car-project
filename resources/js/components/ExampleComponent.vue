<template>
<div class="form-group">
  <select class="browser-default custom-select" v-model="year" @change="getMakers()">
    <option selected>Select Year</option>
    <option v-for="year in years" :value='year.Year'>{{ year.Year }}</option>
  </select>
  <select class="browser-default custom-select" v-model="maker" @change="getModels()">
    <option selected>Select Maker</option>
    <option v-for="make in makers" :value='make.Make'>{{ make.Make }}</option>
  </select>
  <select class="browser-default custom-select" v-model="model" @change="getModels()">
    <option selected>Select Model</option>
    <option v-for="model in models" :value='model.Model'>{{ model.Model }}</option>
  </select>
  </div>
</template>
<script type="text/javascript">
export default {
    props: ['initialYears'],
    data() {
        return {
            years: _.cloneDeep(this.initialYears),
            year: '',
            makers: '',
            make: '',
            models: '',
            model: '',
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
        },
        getMakers() {
            axios.get('/api/makers/' + this.year, {
                makers: this.makers
            })
            .then((res) => {
                    this.makers = res.data;
            });
        },
        getModels() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker, {
                models: this.models
            })
            .then((res) => {
                    this.models = res.data;
            });
        },
    }
}
</script>
