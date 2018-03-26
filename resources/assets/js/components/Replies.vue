<template lang="html">

  <div class="replies">
    <form method="post">
      <div class="field">
        <div class="control">
          <textarea class="textarea" type="text" placeholder="I have something to say..." rows="8" ref="replyText"></textarea>
        </div>
      </div>

      <button type="button" class="button is-primary" @click.prevent="publishReply">Publish</button>
    </form>
  </div>

</template>

<script>
export default {

  props: ['discussion'],

  data() {
    return {
      reply: ''
    }
  },

  methods: {

    publishReply() {

      console.log(this.$refs);
      // axios.post(`/discussion/${this.discussion}/reply`, {
      //     reply: this.reply
      //   })
      //   .then(response => console.log(response))
      //   .catch(error => console.log(error.response.data))
    }
  },
}
</script>
