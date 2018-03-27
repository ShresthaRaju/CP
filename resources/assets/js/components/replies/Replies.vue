<template lang="html">

  <div class="replies">

    <div v-if="replies.length>0">
      <span class="icon title is-4 m-r-10"><i class="fa fa-comments-o"></i></span><span class="title is-4 has-text-grey">{{replies.length}} {{replies.length>1?'Replies':'Reply'}}</span>

      <article class="media m-b-25" v-for="reply in replies">
        <figure class="media-left">
          <p class="image is-48x48">
            <img src="http://localhost:8000/images/userImage.png">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <span class="title is-6"><a class="m-r-10">{{reply.user.name}}</a><small class="has-text-grey-light">{{reply.created_at|formatDate}}</small></span>
            <p v-html="reply.reply"></p>
          </div>
        </div>
      </article>

      <hr>
    </div>

    <form v-if="loggedin">
      <div class="field">
        <div class="control">
          <textarea class="textarea" placeholder="I have something to say..." rows="8" v-model="reply"></textarea>
        </div>
      </div>

      <button type="button" class="button is-primary is-outlined is-pulled-right " @click.prevent="publishReply">Post Your Reply</button>
    </form>

  </div>

</template>

<script>
import moment from 'moment';
export default {

  props: ['discussion', 'loggedin'],

  data() {
    return {
      reply: '',
      formattedReply: '',
      replies: [],
    }
  },

  computed: {
    compiledMarkdown: function() {
      return marked(this.reply, {
        sanitize: false
      })
    }
  },

  methods: {

    fetchAllReplies() {
      axios.get(`/discussion/${this.discussion}/replies`)
        .then(response => this.replies = response.data)
        .catch(error => console.log(error.response.data))
    },

    changeReply() {
      this.formattedReply = this.compiledMarkdown;
    },

    publishReply() {
      this.changeReply();
      axios.post(`/discussion/${this.discussion}/reply`, {
          reply: this.formattedReply
        })
        .then(response => {
          this.reply = '';
          this.replies.unshift(response.data);
        })
        .catch(error => console.log(error.response.data))
    }
  },

  created() {
    this.fetchAllReplies();
  },

  filters: {
    formatDate(date) {
      return moment(date).fromNow();
    }
  }
}
</script>
