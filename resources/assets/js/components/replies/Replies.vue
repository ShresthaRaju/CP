<template lang="html">

  <div class="reply-section">
    <div class="replies" v-if="replies.length>0">
      <span class="icon title is-4 m-r-10"><i class="fa fa-comments-o"></i></span>
      <span class="title is-4 has-text-grey">{{replies.length}} {{replies.length>1?'Replies':'Reply'}}</span>

      <article class="media" v-for="(reply,index) in replies" :key="reply.id">
        <figure class="media-left is-hidden-mobile">
          <p class="image is-48x48">
            <a :href="'http://localhost:8000/user/@'+reply.user.username">
              <img src="http://localhost:8000/images/users/userImage.png" alt="User image" v-if="reply.user.display_image===null" class="user-image">
              <img :src="'http://localhost:8000/images/users/'+reply.user.display_image" alt="User image" class="user-image"  v-else>
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
            <div class="reply m-t-5 has-text-justified" v-if="selectedReply!=index">
              <p v-html="$options.filters.formatReply(reply.reply)"></p>
            </div>

            <!-- show text area only if "edit reply" is clicked -->
            <div class="edit-reply m-t-10" v-if="selectedReply==index">
              <form @keydown="errors.clearError($event.target.name)">
                <div class="field">
                  <div class="control">
                    <textarea :class="['textarea',{'is-danger':errors.hasError('reply')}]" placeholder="I have something to say..." rows="8" name="reply" v-model="updatedReply"></textarea>
                  </div>
                  <p class="help is-danger" v-if="errors.hasError('reply')">{{errors.getErrorMessage('reply')}}</p>
                </div>
                <div class="reply-section-buttons is-pulled-right">
                  <button class="button is-small is-outlined is-danger" @click.prevent="cancel">Cancel</button>
                  <button class="button is-small is-outlined is-primary" @click.prevent="updateReply(index,reply.id)">Update Your Reply</button>
                </div>
              </form>
            </div>
          </div>

          <nav class="level is-mobile" id="best-reply" v-if="loggedIn && user==discussion.user.id">
           <div class="level-left">
             <b-tooltip label="Mark as best reply"
               type="is-dark"
               position="is-right"
               animated>
               <a class="level-item" @click.prevent="markBestReply(index,discussion.id,reply)">
                 <span class="icon has-text-grey">
                   <!-- <i :class="[{'fa fa-check-circle-o fa-lg':true},{'fa fa-check-circle fa-lg':reply.best_reply==1}]"></i> -->
                   <i class="fa fa-check-circle fa-lg" v-if="reply.best_reply==1 || index==bestReply"></i>
                   <i class="fa fa-check-circle-o fa-lg" v-else></i>
                 </span>
               </a>
             </b-tooltip>
           </div>
         </nav>

       </div> <!-- end of .content-->

        <div class="media-right" v-if="loggedIn && user==reply.user.id">
          <b-tooltip label="Edit your reply"
            type="is-dark"
            position="is-left"
            animated>
            <a @click.prevent="editReply(index,reply.reply)">
              <span class="icon has-text-grey"><i class="fa fa-pencil"></i></span>
            </a>
          </b-tooltip>
          <b-tooltip label="Delete this reply"
            type="is-dark"
            position="is-left"
            animated>
            <a @click.prevent="deleteReply(index,reply.id)">
              <span class="icon has-text-danger"><i class="fa fa-trash"></i></span>
            </a>
          </b-tooltip>
        </div>

      </article>
      <hr>
    </div>

    <div class="add-reply" v-if="loggedIn">
      <form @keydown="errors.clearError($event.target.name)">
        <div class="field">
          <div class="control">
            <textarea :class="['textarea',{'is-danger':errors.hasError('reply')}]" placeholder="I have something to say..." rows="8" name="reply" v-model="reply"></textarea>
          </div>
          <p class="help is-danger" v-if="errors.hasError('reply')">{{errors.getErrorMessage('reply')}}</p>
        </div>
        <button type="button" class="button is-primary is-outlined is-pulled-right m-b-25" @click.prevent="publishReply">Post Your Reply</button>
      </form>
      <small class="is-hidden-mobile">Use Markdown with <a href="https://github.github.com/gfm/" target=_blank>Github-flavored</a> code blocks.</small>
    </div>

  </div>

</template>

<script>
import moment from 'moment';
import Errors from '../../utilities/errors.js';

export default {

  props: ['discussion', 'loggedIn', 'user'],

  data() {
    return {
      replies: [],
      reply: '',
      errors: new Errors(),
      selectedReply: null,
      updatedReply: '',
      bestReply: null,
    }
  },

  methods: {

    fetchAllReplies() {
      axios.get(`/discussion/${this.discussion.id}/replies`)
        .then(response => {
          this.replies = response.data;
          this.$parent.$emit('repliesLoaded', this.replies);
        })
        .catch(error => console.log(error.response.data))
    },

    publishReply() {
      axios.post(`/discussion/${this.discussion.id}/reply`, {
          reply: this.reply
        })
        .then(response => {
          this.reply = '';
          this.replies.unshift(response.data);
          window.scrollTo({
            left: 0,
            top: 0,
            behavior: "smooth"
          });
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

    //triggered everytime a new reply is created [for real-time commenting system]
    listenToReply() {
      Echo.channel('discussion.' + this.discussion.id)
        .listen('NewReply', (reply) => {
          this.replies.unshift(reply.reply);
        })
    },

    editReply(index, reply) {
      this.selectedReply = index;
      this.updatedReply = reply;
    },

    cancel() {
      this.selectedReply = null;
      this.updatedReply = "";
    },

    updateReply(index, reply) {
      axios.put(`/discussion/replied/${reply}`, {
          reply: this.updatedReply
        })
        .then(response => {
          this.updatedReply = "";
          this.selectedReply = null;
          this.$snackbar.open(response.data.status);
          this.replies.splice(index, 1, response.data.updatedReply);
          // console.log(response.data.updatedReply);
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

    deleteReply(index, reply) {
      axios.delete(`/discussion/replied/${reply}`)
        .then(response => {
          this.replies.splice(index, 1);
          this.$snackbar.open(response.data);
        })
        .catch(error => console.log(error.response.data))
    },

    markBestReply(replyIndex, discussion, reply) {
      axios.put(`/discussion/${discussion}/replied/best/${reply.id}`, {
          discussion: discussion,
          reply: reply.reply
        })
        .then(response => {
          this.bestReply = replyIndex;
          this.$snackbar.open("Reply maked as best");
          this.$parent.$emit('bestReplySelected', reply);
        })
        .catch(error => console.log(error.response.data))
    }

  },

  mounted() {
    this.fetchAllReplies();
    this.listenToReply();
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
