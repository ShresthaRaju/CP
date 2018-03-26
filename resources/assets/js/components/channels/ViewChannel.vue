<template lang="html">

  <div class="channel">
    <div class="columns">
      <div class="column is-7">
        <div class="card">
          <div class="card-content">
            <span class="channel-title m-r-5">{{channel.title}}</span>
            <b-tooltip label="Edit this channel"
              type="is-dark"
              position="is-right"
              animated>
              <a @click="showChannelEditCard=true"><span class="icon"><i class="fa fa-edit"></i></span></a>
            </b-tooltip>
            <span class="has-text-grey is-italic is-pulled-right m-t-10">[{{channel.discussions.length}} Discussions]</span>
            <hr>
            <h1 class="title is-5 is-italic has-text-centered has-text-grey" v-if="channel.discussions.length==0">No any discussion yet !</h1>

            <div class="table-responsive" v-else>
              <table class="table is-hoverable is-narrow is-fullwidth">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Comments</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(discussion,index) in channel.discussions">
                    <th>{{index+1}}</th>
                    <td><a>{{discussion.title}}</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--- end of .card-->
      </div> <!-- end of .column-->

      <div class="column is-4 is-offset-1">
        <transition name="fade">
          <div class="card m-b-20" v-if="showChannelEditCard">
          <header class="card-header">
            <p class="card-header-title">
              Edit
            </p>
          </header>
          <div class="card-content">
            <form @keydown="errors.clearError($event.target.name)">
              <div class="field">
                <label class="label">Title</label>
                <div class="control has-icons-left has-icons-right">
                  <input type="text" :class="['input',{'is-danger':errors.hasError('title')}]" name="title" v-model="channel.title">
                  <span class="icon is-small is-left">
                    <i class="fa fa-circle-o-notch"></i>
                  </span>
                  <span class="icon is-small is-right" v-if="errors.hasError('title')">
                    <i class="fa fa-exclamation-triangle"></i>
                  </span>
                </div>
                <p class="help is-danger" v-if="errors.hasError('title')">{{errors.getErrorMessage('title')}}</p>
              </div>

              <button class="button is-primary is-rounded is-outlined is-fullwidth m-t-25" @click.prevent="updateChannel(channel.id)" :disabled="errors.hasAnyError()">Save</button>
            </form>
          </div>
        </div> <!-- end of .card -->
        </transition>
        <button class="button is-black is-outlined is-fullwidth m-b-20" @click="$emit('compChanged')">
          <span class="icon"><i class="fa fa-angle-double-left"></i>
          </span><span>Back To Channels</span>
        </button>
      </div>
    </div> <!-- end of .columns-->
  </div>

</template>

<script>
import Errors from '../../utilities/errors.js';
export default {
  props: ['channel'],

  data() {
    return {
      showChannelEditCard: false,
      errors: new Errors(),
    }
  },

  methods: {
    updateChannel(channel) {
      axios.put(`/admin/channels/${channel}`, this.channel)
        .then(response => {
          this.$toast.open({
            type: 'is-primary',
            message: response.data,
            duration: 5000
          });
          this.showChannelEditCard = false;
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    }
  },
}
</script>

<style scoped>
.channel-title {
  font-size: 27px;
}

.fa-edit {
  font-size: 20px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
