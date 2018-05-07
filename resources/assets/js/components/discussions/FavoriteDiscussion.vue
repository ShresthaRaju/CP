<template lang="html">

  <b-tooltip :label="label"
    type="is-dark"
    position="is-right"
    animated>
    <span @click="favorite">
      <i :class="[{'fa fa-star-o':!favorited},{'fa fa-star':favorited}]"></i>
    </span>
  </b-tooltip>

</template>

<script>
export default {

  props: {
    discussion: {
      required: true
    },
    isFavorited: {
      type: Boolean
    },
  },

  data() {
    return {
      label: "Favorite this discussion",
      favorited: false,
    }
  },

  methods: {
    favorite() {
      axios.post(`/discussion/favorite`, {
          discussion: this.discussion
        })
        .then(response => {
          if (!this.favorited) {
            this.favorited = true;
            this.label = "Unfavorite this discussion";
            this.$toast.open({
              type: 'is-primary',
              message: response.data.message,
              duration: 3000
            });

          } else {
            this.favorited = false;
            this.label = "Favorite this discussion";
            this.$toast.open({
              type: 'is-danger',
              position: 'is-bottom',
              message: "Discussion removed from your favorites",
              duration: 3000
            });
          }
        })
        .catch(error => console.log(error.response.data))
    }
  },

  mounted() {
    if (this.isFavorited) {
      this.favorited = this.isFavorited;
      this.label = "Unfavorite this discussion";
    }
  }
}
</script>
