<template lang="html">

  <div class="navbar-item">
    <div class="dropdown is-right" :class="{'is-active':isActive}" id="notification-dropdown">
      <div class="dropdown-trigger" @click="markNotificationsAsRead">
        <span class="badge is-badge-danger is-badge-small" :data-badge="unreads.length">
          <span class="icon"><i class="fa fa-bell"></i></span>
        </span>
      </div>
      <div class="dropdown-menu" id="dropdown-menu" role="menu">
        <div class="dropdown-content">
          <p class="has-text-centered">Notifications</p>
          <hr class="dropdown-divider">
          <div class="notifications">
            <notification-item v-for="notification in allNotifications" :key="notification.id"
            :notification="notification"></notification-item>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import NotificationItem from './NotificationItem.vue';

export default {

  props: ['userId', 'notifications', 'unreadNotifications'],

  components: {
    'notification-item': NotificationItem
  },

  data() {
    return {
      allNotifications: this.notifications,
      unreads: this.unreadNotifications,
      isActive: false,
    }
  },

  mounted() {
    Echo.private('App.User.' + this.userId)
      .notification((notification) => {
        let newNotification = {
          /*database sends the value of the "data" column
          by wrapping in an object named "data"
          therefore we also need to wrap the broadcasted value(in this case 'notification') in a "data object"
          as shown below*/
          data: {
            discussion: {
              title: notification.discussion.title,
              slug: notification.discussion.slug,
            },
            user: {
              username: notification.user.username,
              display_image: notification.user.display_image,
            }
          }
        }
        this.allNotifications.unshift(newNotification);
        this.unreads.unshift(newNotification);
      });
  },

  methods: {
    markNotificationsAsRead() {
      this.isActive = !this.isActive;
    }
  }

}
</script>

<style lang="css" scoped>
  .dropdown-trigger{
    cursor:pointer;
  }
</style>
