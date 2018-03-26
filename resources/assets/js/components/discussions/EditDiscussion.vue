<template lang="html">

  <div class="card m-r-100">
    <div class="card-content">
      <form>
        <div class="field">
          <label class="label">Pick a Channel</label>
          <p class="control has-icons-left">
            <span class="select">
              <select name="channel_id" v-model="discussion.channel_id">
                <option v-for="channel in channels" :value="channel.id">{{channel.title}}</option>
              </select>
            </span>
            <span class="icon is-small is-left">
              <i class="fa fa-circle-o-notch"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <label class="label">Provide a title</label>
          <div class="control has-icons-right">
            <input type="text" class="input" placeholder="Title here..." name="title" v-model="discussion.title">
          </div>
        </div>

        <div class="field">
          <label class="label">Ask away</label>
          <div class="control">
            <textarea class="textarea" placeholder="What do you need help with? Be spcefic, so that your peers are better able ot assist you..." rows="8" name="description" v-model="discussion.description" @input="update"></textarea>
          </div>
        </div>

        <button class="button is-primary is-fullwidth" @click.prevent="updateDiscussion">Update Discussion</button>

      </form>
    </div>
  </div>

</template>

<script>
export default {

  props: ['channels', 'discussion'],

  data() {
    return {
      discussion: {
        channel_id: '',
        title: '',
        description: ''
      },
    }
  },

  computed: {
    compiledMarkdown: function() {
      return marked(this.discussion.description, {
        sanitize: false
      })
    }
  },

  methods: {

    changeDescription() {
      this.discussion.description = this.compiledMarkdown;
    },

    updateDiscussion() {
      this.changeDescription();
      axios.put(`/discussion/${this.discussion.id}`, this.discussion)
        .then(response => window.location = response.data.redirect)
        .catch(error => console.log(error.response.data))
    },

    update: _.debounce(function(e) {
      this.discussion.description = e.target.value
    }, 300)
  },



}
</script>
