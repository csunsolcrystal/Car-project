<template>
<div class="form-group">
<div class="row">
  <div class="col-md-3">
  <h2 class="">Year</h2>
  <select class="browser-default custom-select" v-model="year" @change="getMakers()">
    <option selected value ="0">Select Year</option>
    <option v-for="year in years" :value='year.Year'>{{ year.Year }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Make</h2>
  <select class="browser-default custom-select" v-model="maker" @change="getModels()">
    <option selected value ="0">Select Maker</option>
    <option v-for="maker in makers" :value='maker.Make'>{{ maker.Make }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Model</h2>
  <select class="browser-default custom-select" v-model="model" @change="getTrims()">
    <option selected value ="0">Select Model</option>
    <option v-for="model in models" :value='model.Model'>{{ model.Model }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Trim</h2>
  <select class="browser-default custom-select" v-model="trim">
  <option selected value ="0">Select Trim</option>
    <option v-for="trim in trims" :value='trim.Trim'>{{ trim.Trim }}</option>
  </select>
  </div>
  </div>
  </div>
</template>
<script type="text/javascript">
export default {
    props: ['initialYears'],
    data() {
        return {
            years: _.cloneDeep(this.initialYears),
            year: 0,
            makers: '',
            maker: 0,
            models: '',
            model: 0,
            trims: '',
            trim: 0,
        };
    },
    methods: {
        getYears() {
            axios.get('/api/years/', {
                years: this.years
            })
            .then((res) => {
                    this.years = res.data;
                    this.makers = '';
                    this.maker = 0;
                    this.models = '';
                    this.model = 0;
                    this.trim = 0;
            });
        },
        getMakers() {
            axios.get('/api/makers/' + this.year, {
                makers: this.makers
            })
            .then((res) => {
                    this.makers = res.data;
                    this.maker = 0;
                    this.models = '';
                    this.model = 0;
                    this.trims = '';
                    this.trim = 0;
            });
        },
        getModels() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker, {
                models: this.models
            })
            .then((res) => {
                    this.models = res.data;
                    this.model = 0;
                    this.trims = '';
                    this.trim = 0;
            });
        },
        getTrims() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker + '/'+ this.model, {
                trims: this.trims
            })
            .then((res) => {
                    this.trims = res.data;
            });
        },
    }
}
</script>
