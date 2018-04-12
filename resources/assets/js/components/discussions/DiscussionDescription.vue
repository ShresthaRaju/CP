<template lang="html">

  <div id="discussion">
    <div class="disc-desc has-text-justified" v-html="formattedDiscussion"></div>
    <!--best reply panel -->
    <nav class="panel m-t-30" v-for="(reply,index) in replies" :key="reply.id" v-if="reply.best_reply==1 || reply.id==isBestReply">
      <p class="panel-heading">
        <span class="is-size-5 has-text-white">Best Reply</span>
        <span class="is-pulled-right is-size-7 has-text-white is-hidden-mobile m-t-5">
          ( As selected by <span class="has-text-black-ter is-uppercase">{{discussion.user.username}}</span> )
        </span>
      </p>
      <div class="panel-block">
        <article class="media m-t-20 m-b-20">
          <figure class="media-left is-hidden-mobile">
            <p class="image is-48x48">
              <a :href="'http://localhost:8000/user/@'+reply.user.username">
                <img src="http://localhost:8000/images/users/userImage.png" alt="User image" v-if="reply.user.display_image===null" class="user-image">
                <img :src="'http://localhost:8000/images/users/'+reply.user.display_image" alt="User image" v-else class="user-image">
              </a>
            </p>
          </figure>

          <div class="media-content">
            <div class="content">
              <span class="title is-6">
                <a :href="'http://localhost:8000/user/@'+reply.user.username" class="m-r-5">{{reply.user.username}}</a>
                <small class="has-text-grey-light is-hidden-mobile">
                  <span class="icon"><i class="fa fa-clock-o"></i></span>{{reply.created_at|formatDate}}
                  <span class="title is-6 m-l-10" id="xp">({{reply.user.experience}} XP)</span>
                </small>
              </span>
              <div class="reply m-t-5 has-text-justified">
                <p v-html="$options.filters.formatReply(reply.reply)"></p>
              </div>
             </div>
           </div>
          </article>
      </div>
    </nav>

    <hr>
    <all-replies :discussion="discussion" :logged-in="loggedIn" :user="user"></all-replies>
  </div>

</template>

<script>
import Replies from '../replies/Replies.vue';
import moment from 'moment';

export default {
  props: ['discussion', 'loggedIn', 'user'],

  components: {
    'all-replies': Replies,
  },

  data() {
    return {
      formattedDiscussion: '',
      replies: [],
      isBestReply: null,
    }
  },

  created() {
    this.formattedDiscussion = this.compiledMarkdown;
    this.$on('repliesLoaded', (replies) => {
      this.replies = replies;
    });
    this.$on('bestReplySelected', (reply) => {
      this.isBestReply = reply.id;
      window.scrollTo({
        left: 0,
        top: 0,
        behavior: "smooth"
      });
    })
  },

  computed: {
    compiledMarkdown: function() {
      return marked(this.discussion.description, {
        sanitize: false
      })
    }
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
