<template lang="html">

  <div class="disc-desc has-text-justified" v-html="formattedDiscussion"></div>

</template>

<script>
export default {
  props: ['discussion'],

  data() {
    return {
      formattedDiscussion: ''
    }
  },

  created() {
    this.formattedDiscussion = this.compiledMarkdown;
  },

  computed: {
    compiledMarkdown: function() {
      return marked(this.discussion, {
        sanitize: false
      })
    }
  },
}
</script>
