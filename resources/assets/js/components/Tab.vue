<template lang="html">

  <div v-if="isActive">
    <slot></slot>
  </div>

</template>

<script>
export default {

  props: {
    name: {
      required: true,
    },

    active: {
      default: false
    }
  },

  data() {
    return {
      isActive: false,
    }
  },

  mounted() {
    this.isActive = this.active;
  },

  computed: {
    href() {
      return '#' + this.name.toLowerCase().replace(/ /g, '-');
    }
  }

}
</script>
