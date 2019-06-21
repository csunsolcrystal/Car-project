<template>
<div class="form-group">
<div class="row">
  <div class="col-md-3">
  <h2 class="">Year</h2>
  <select class="browser-default custom-select" v-model="$root.year" @change="getMakers()">
    <option selected value ="0">Select Year</option>
    <option v-for="year in years" :value='year.Year'>{{ year.Year }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Make</h2>
  <select class="browser-default custom-select" v-model="$root.maker" @change="getModels()">
    <option selected value ="0">Select Maker</option>
    <option v-for="maker in this.$root.makers" :value='maker.Make'>{{ maker.Make }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Model</h2>
  <select class="browser-default custom-select" v-model="$root.model" @change="getTrims()">
    <option selected value ="0">Select Model</option>
    <option v-for="model in this.$root.models" :value='model.Model'>{{ model.Model }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Trim</h2>
  <select class="browser-default custom-select" v-model="$root.trim" @change="getVinyl()">
  <option selected value ="0">Select Trim</option>
    <option v-for="trim in this.$root.trims" :value='trim.Trim'>{{ trim.Trim }}</option>
  </select>
  </div>
  </div>
  <div class="container mt-5" v-if="this.$root.vinyls != ''">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center pb-2">Vinyl Wrap&nbsp;<small class="text-muted"><br>The length of the vinyl wrap needed is an approximation based on skilled level</small></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered ">
            <thead class="thead-dark">
              <tr>
                <th>Tier List (Skill level)</th>
                <th>Approximate Length (in Feet)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Novice</th>
                <td>{{ this.$root.vinyls[0] }} ft</td>
              </tr>
              <tr>
                <th>Intermediate</th>
                <td>{{ this.$root.vinyls[1] }} ft</td>
              </tr>
              <tr>
                <th scope="row" contenteditable="true">Professional</th>
                <td>{{ this.$root.vinyls[2] }} ft</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
            vinyls: '',
            searchquery: '',
            data_results: [],
        };
    },
    methods: {
        getYears() {
            axios.get('/api/years/', {
                years: this.$root.years
            })
            .then((res) => {
                    this.$root.years = res.data;
                    this.$root.makers = '';
                    this.$root.maker = 0;
                    this.$root.models = '';
                    this.$root.model = 0;
                    this.$root.trim = 0;
                    this.$root.vinyls = '';
            });
        },
        getMakers() {
            axios.get('/api/makers/' + this.$root.year, {
                makers: this.$root.makers
            })
            .then((res) => {
                    this.$root.makers = res.data;
                    this.$root.maker = 0;
                    this.$root.models = '';
                    this.$root.model = 0;
                    this.$root.trims = '';
                    this.$root.trim = 0;
                    this.$root.vinyls = '';
            });
        },
        getModels() {
            axios.get('/api/makers/' + this.$root.year + '/'+ this.$root.maker, {
                models: this.$root.models
            })
            .then((res) => {
                    this.$root.models = res.data;
                    this.$root.model = 0;
                    this.$root.trims = '';
                    this.$root.trim = 0;
                    this.$root.vinyls = '';
            });
        },
        getTrims() {
            axios.get('/api/makers/' + this.$root.year + '/'+ this.$root.maker + '/'+ this.$root.model, {
                trims: this.$root.trims
            })
            .then((res) => {
                    this.$root.trims = res.data;
                    this.$root.vinyls ='';
            });
        },
        getVinyl() {
            axios.get('/api/makers/' + this.$root.year + '/'+ this.$root.maker + '/'+ this.$root.model +'/'+ this.$root.trim, {
                vinyls: this.$root.vinyls
            })
            .then((res) => {
                    this.$root.vinyls = res.data;
                    vinyls: res.data;
            });
        },
    }
}
</script>
