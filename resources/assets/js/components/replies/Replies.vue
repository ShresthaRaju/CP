<template lang="html">

  <div class="replies">

    <div v-if="replies.length>0">
      <span class="icon title is-4 m-r-10"><i class="fa fa-comments-o"></i></span><span class="title is-4 has-text-grey">{{replies.length}} {{replies.length>1?'Replies':'Reply'}}</span>

      <article class="media m-b-25" v-for="reply in replies">
        <figure class="media-left is-hidden-mobile">
          <p class="image is-48x48">
            <img src="http://localhost:8000/images/userImage.png">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <span class="title is-6"><a class="m-r-10">{{reply.user.name}}</a><small class="has-text-grey-light">{{reply.created_at|formatDate}}</small></span>
            <div class="replied" v-html="$options.filters.formatReply(reply.reply)"></div>
          </div>
        </div>
      </article>

      <hr>
    </div>

    <form v-if="loggedin" @keydown="errors.clearError($event.target.name)">
      <div class="field">
        <div class="control">
          <textarea :class="['textarea',{'is-danger':errors.hasError('reply')}]" placeholder="I have something to say..." rows="8" name="reply" v-model="reply"></textarea>
        </div>
        <p class="help is-danger" v-if="errors.hasError('reply')">{{errors.getErrorMessage('reply')}}</p>
      </div>

      <button type="button" class="button is-primary is-outlined is-pulled-right m-b-25" @click.prevent="publishReply">Post Your Reply</button>
    </form>

  </div>

</template>

<script>
import moment from 'moment';
import Errors from '../../utilities/errors.js';

export default {

  props: ['discussion', 'loggedin'],

  data() {
    return {
      replies: [],
      reply: '',
      errors: new Errors(),
    }
  },

  methods: {

    fetchAllReplies() {
      axios.get(`/discussion/${this.discussion}/replies`)
        .then(response => this.replies = response.data)
        .catch(error => console.log(error.response.data))
    },

    publishReply() {
      axios.post(`/discussion/${this.discussion}/reply`, {
          reply: this.reply
        })
        .then(response => {
          this.reply = '';
          this.replies.unshift(response.data);
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    }
  },

  created() {
    this.fetchAllReplies();
  },

  filters: {
    formatDate(date) {
      return moment(date).fromNow();
    },

    formatReply(reply) {
      return marked(reply, {
        sanitize: false
      })
    },
  }
}
</script>
