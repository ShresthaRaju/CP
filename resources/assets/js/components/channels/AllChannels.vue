<template lang="html">

  <div class="all-channels">
    <div class="columns">
      <div class="column is-7">
        <div class="card">
          <div class="card-content">
            <div class="table-responsive">
              <table class="table is-hoverable is-narrow is-fullwidth">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(channel,index) in channels">
                    <th>{{channel.id}}</th>
                    <td>
                      <a @click="viewChannel(channel.id)">{{channel.title}}</a>
                    </td>
                    <td>{{channel.created_at | formatDate}}</td>
                    <td class="has-text-left">
                      <b-tooltip label="Remove this channel"
                        type="is-dark"
                        position="is-left"
                        animated>
                        <a class="has-text-danger" @click="deleteChannel(index,channel.id)"><span class="icon"><i class="fa fa-trash"></i></span></a>
                      </b-tooltip>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--- end of .card-->
      </div> <!-- end of .column-->

      <div class="column is-4 is-offset-1">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              Add New Channel
            </p>
          </header>
          <div class="card-content">
            <form action="localhost:8000/admin/channels" method="post" @keydown="errors.clearError($event.target.name)">
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

              <button type="submit" class="button is-primary is-rounded is-outlined is-fullwidth m-t-25" @click.prevent="addNewChannel" :disabled="errors.hasAnyError()">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import Errors from '../../utilities/errors.js';
import moment from 'moment';
import viewChannel from './ViewChannel.vue';

export default {

  components: {
    'view-channel': viewChannel
  },

  data() {
    return {
      channels: {},
      channel: {
        title: '',
      },
      errors: new Errors(),
      viewedChannel: {},
    }
  },

  created() {
    this.fetchAllChannels();
  },

  methods: {

    fetchAllChannels() {
      axios.get('/admin/channels')
        .then(response => this.channels = response.data)
        .catch(error => console.log(error.response.data))
    },

    addNewChannel() {
      axios.post('/admin/channels', this.channel)
        .then(response => {
          // console.log(response);
          this.channels.push(response.data.channel);
          this.channel.title = '';
          this.$toast.open({
            type: 'is-info',
            message: response.data.status.message,
            duration: 5000
          });
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

    viewChannel(channel) {
      axios.get(`/admin/channels/${channel}`)
        .then(response => {
          // console.log(response.data);
          this.viewedChannel = response.data;
          this.$emit('channelViewed', this.viewedChannel);
        })
        .catch(error => console.log(error.response.data))
    },

    deleteChannel(index, channel) {
      this.$dialog.confirm({
        title: 'Removing Channel',
        message: 'Are you sure you want to <b>remove</b> this channel? This action cannot be undone.',
        confirmText: 'Remove Channel',
        type: 'is-danger',
        hasIcon: true,
        iconPack: 'fa',
        onConfirm: () => axios.delete(`/admin/channels/${channel}`)
          .then(response => {
            this.channels.splice(index, 1);
            this.$toast.open({
              message: response.data,
              duration: 5000
            });
          })
          .catch(error => {
            console.log(error.response.data);
          })
      });
    },

  },

  filters: {
    formatDate(date) {
      return moment(date).format('LL');
    }
  },
}
</script>
