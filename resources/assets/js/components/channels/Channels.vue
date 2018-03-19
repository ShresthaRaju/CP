<template lang="html">

  <div class="channels">
    <transition name="fade">
      <component :is="activeComponent" @channelViewed="changeComponent($event)"
      :channel="viewedChannel" @compChanged="activeComponent='all-channels'"></component>
    </transition>
  </div>

</template>

<script>
import allChannels from './AllChannels.vue';
import viewChannel from './ViewChannel.vue';

export default {

  components: {
    'all-channels': allChannels,
    'view-channel': viewChannel,
  },

  data() {
    return {
      activeComponent: 'all-channels',
      viewedChannel: {}
    }
  },

  methods: {
    changeComponent(viewedChannel) {
      this.viewedChannel = viewedChannel;
      this.activeComponent = 'view-channel';
    }
  },
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
