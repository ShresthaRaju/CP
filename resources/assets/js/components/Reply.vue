<template lang="html">
  <div class="reply">
    <h2>This is a reply.</h2>
  </div>
</template>

<script>
export default {

  props: ['discussion'],
  data() {
    return {
      replies: {},
    }
  },

  methods: {
    fetchAllReplies(discussion) {
      axios.get(`/discussion/${discussion}/comments`)
        .then(response => console.log(response))
        .catch(error => error.response.data)
    },

    publishReply(discussion) {
      axios.post(`/discussion/${discussion}/comment`)
        .then(response => console.log(response))
        .catch(error => error.response.data)
    }
  },

  created() {
    fetchAllReplies(this.discussion);
  }

}
</script>
