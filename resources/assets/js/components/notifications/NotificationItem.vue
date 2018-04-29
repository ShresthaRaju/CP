<template lang="html">

  <div id="notification-item" :class="{'read':read}">
    <a :href="'/discussion/'+notificationItem.data.discussion.slug" class="dropdown-item" @click="markAsRead(notificationItem)">
      <article class="media">
        <figure class="media-left m-r-10">
          <span class="image is-24x24">
            <img src="/images/userImage.png" alt="User image" v-if="notificationItem.data.user.display_image===null">
            <img :src="'/images/users/'+notificationItem.data.user.display_image" alt="User image" class="nav-user-img" v-else>
          </span>
        </figure>

        <div class="media-content">
          <div class="content is-size-7">
            <span class="is-uppercase has-text-weight-bold">
              {{notificationItem.data.user.username}}
            </span>
            
             {{notification.data.message}}:

            <span class="has-text-weight-bold">
              {{notificationItem.data.discussion.title.substring(0,20)}}{{notificationItem.data.discussion.title.length>20?'...':''}}
            </span>
            <p>{{notificationItem.created_at |formatDate}}</p>
          </div>
        </div>
      </article>
    </a>
    <hr class="dropdown-divider">
  </div>

</template>

<script>
import moment from 'moment';

export default {
  props: ['notification'],

  data() {
    return {
      notificationItem: this.notification,
      read: false,
    }
  },

  filters: {
    formatDate(date) {
      return moment(date).fromNow();
    }
  },


  methods: {
    markAsRead(notification) {
      axios.post(`/notification/${notification.id}/markasread`, {
          notification: notification.id
        })
        .then(response => console.log('done'))
        .catch(error => console.log(error.response.data))
    }
  },

  mounted() {
    if (this.notification.read_at !== null) {
      this.read = true;
    }
  }

}
</script>

<style lang="css" scoped>
  #notification-item{
    background-color:#f4f6fc;
  }

  #notification-item hr{
    margin: 0;
  }

  #notification-item.read{
    background-color:#fff;
  }
</style>
