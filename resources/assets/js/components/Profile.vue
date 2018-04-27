<template lang="html">

  <div>
    <section class="hero is-primary is-bold">
      <div class="hero-body">
        <div class="container">
          <div class="columns">
            <div class="column is-one-third-desktop is-one-third-tablet">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="/images/user-profile-icon.jpg" alt="User image" v-if="user.display_image===null">
                    <img :src="'/images/users/'+user.display_image" alt="User image" v-else>
                  </figure>
                </div>
              </div>
            </div>

            <div class="column">
              <div id="user-details">
                <h1 class="title is-4">{{'@'}}{{user.username}}
                  <a :href="'https://github.com/'+user.github" :title="'https://github.com/'+user.github" target="_blank" class="has-text-black-ter" v-if="user.github">
                    <span class="icon"><i class="fa fa-github"></i></span>
                  </a>
                  <a :href="'https://www.linkedin.com/in/'+user.linkedin" :title="'https://www.linkedin.com/in/'+user.linkedin" target="_blank" class="has-text-black-ter" v-if="user.linkedin">
                    <span class="icon"><i class="fa fa-linkedin-square"></i></span>
                  </a>
                </h1>
                <p class="title is-6">Member Since <span class="has-text-weight-bold">{{user.created_at|formatDate}}</span></p>
              </div>
            </div>

            <div class="column has-text-right">
              <div id="xp-details">
                <h1 class="title is-5 has-text-grey is-uppercase">Experience</h1>
                <h4 class="title is-1">{{user.experience}}</h4>
                <p class="title is-5 has-text-weight-semibold">{{user.awards}} Best Reply Awards</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="hero-foot">
        <nav class="tabs is-boxed is-fullwidth">
          <div class="container">
            <ul>
              <li v-for="tab in tabs" :class="{'is-active':tab.isActive}">
                <a :href="tab.href" @click="selectTab(tab)">{{tab.name}}</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </section>

    <div class="tab-body">
      <slot></slot>
    </div>

  </div>

</template>

<script>
import moment from 'moment';
export default {
  props: ['user'],

  data() {
    return {
      tabs: [],
    }
  },

  created() {
    this.tabs = this.$children;
  },

  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = (tab.name == selectedTab.name);
      })
    }
  },

  filters: {
    formatDate(date) {
      return moment(date).fromNow();
    }
  }

}
</script>
