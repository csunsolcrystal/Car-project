<template>
  <select class="browser-default custom-select">
    <option selected>Select Year</option>
    <option v-for="year in years">{{ year['Year'] }}</option>
  </select>
</template>
<script>
    export default {
        props: ['years']
    }
</script>
