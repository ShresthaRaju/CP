<template lang="html">

  <div id="create-discussion">
    <div class="card">
      <div class="card-content">
        <form @keydown="errors.clearError($event.target.name)">
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
              <input type="text" :class="['input',{'is-danger':errors.hasError('title')}]" placeholder="Title here..." name="title" v-model="discussion.title">
              <span class="icon is-small is-right" v-if="errors.hasError('title')">
                <i class="fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <p class="help is-danger" v-if="errors.hasError('title')">{{errors.getErrorMessage('title')}}</p>
          </div>

          <div class="field">
            <label class="label">Ask away</label>
            <div class="control">
              <textarea :class="['textarea',{'is-danger':errors.hasError('description')}]" placeholder="What do you need help with? Be spcefic, so that your peers are better able ot assist you..." rows="8" name="description" v-model="discussion.description"></textarea>
            </div>
            <p class="help is-danger" v-if="errors.hasError('description')">{{errors.getErrorMessage('description')}}</p>
          </div>

          <button class="button is-primary is-fullwidth" @click.prevent="publishDiscussion">Publish Discussion</button>

        </form>
      </div>
    </div>

    <div class="is-hidden-mobile m-t-25 has-text-centered">
      <small>
        Use Markdown with <a href="https://github.github.com/gfm/" target=_blank>Github-flavored</a> code blocks.
      </small>
    </div>

  </div>

</template>

<script>
import Errors from '../../utilities/errors.js';

export default {

  props: ['channels'],

  data() {
    return {
      discussion: {
        channel_id: 1,
        title: '',
        description: '',
      },
      errors: new Errors(),
    }
  },

  methods: {
    publishDiscussion() {
      axios.post(`/discussion`, this.discussion)
        .then(response => window.location = response.data.redirect)
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },
  },

}
</script>
