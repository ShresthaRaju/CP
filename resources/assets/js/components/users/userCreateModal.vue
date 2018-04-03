<template lang="html">
  <transition name="fade">
    <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title"> Create New User</p>
        <button class="delete" aria-label="close" @click="closeModal"></button>
      </header>
      <section class="modal-card-body">

        <form action="localhost:8000/admin/users" method="post" @keydown="errors.clearError($event.target.name)">
          <div class="field">
            <label class="label">Fullname</label>
            <div class="control has-icons-left has-icons-right">
              <input type="text" :class="['input',{'is-danger':errors.hasError('name')}]" name="name" v-model="user.name">
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
              <span class="icon is-small is-right" v-if="errors.hasError('name')">
                <i class="fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <p class="help is-danger" v-if="errors.hasError('name')">{{errors.getErrorMessage('name')}}</p>
          </div>

          <div class="field">
            <label class="label">E-mail Address</label>
            <div class="control has-icons-left has-icons-right">
              <input type="email" :class="['input',{'is-danger':errors.hasError('email')}]" name="email" v-model="user.email">
              <span class="icon is-small is-left">
                <i class="fa fa-envelope"></i>
              </span>
              <span class="icon is-small is-right" v-if="errors.hasError('email')">
                <i class="fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <p class="help is-danger" v-if="errors.hasError('email')">{{errors.getErrorMessage('email')}}</p>
          </div>

          <div class="field">
            <label class="label">Username</label>
            <div class="control has-icons-left has-icons-right">
              <input type="text" :class="['input',{'is-danger':errors.hasError('username')}]" name="username" v-model="user.username">
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
              <span class="icon is-small is-right" v-if="errors.hasError('username')">
                <i class="fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <p class="help is-danger" v-if="errors.hasError('username')">{{errors.getErrorMessage('username')}}</p>
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control has-icons-left has-icons-right">
              <input type="password" :class="['input',{'is-danger':errors.hasError('password')}]" name="password" v-model="user.password">
              <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
              <span class="icon is-small is-right" v-if="errors.hasError('password')">
                <i class="fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <p class="help is-danger" v-if="errors.hasError('password')">{{errors.getErrorMessage('password')}}</p>
          </div>

          <div class="field">
            <label class="label">Status</label>
            <b-switch type="is-info" name="active" v-model="user.active"
            true-value="Active" false-value="Inactive">{{user.active}}</b-switch>
          </div>

          <button type="submit" class="button is-primary is-fullwidth" @click.prevent="createNewUser" :disabled="errors.hasAnyError()">Create</button>
        </form>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-danger is-pulled-right" @click="closeModal">Cancel</button>
      </footer>
    </div>
  </div>
  </transition>
</template>

<script>
import Errors from '../../utilities/errors.js';

export default {

  data() {
    return {
      user: {
        name: '',
        email: '',
        username: '',
        password: '',
        active: 'Inactive'
      },
      errors: new Errors()
    }
  },

  methods: {

    createNewUser() {
      axios.post('/admin/users', this.user)
        .then(response => {
          // console.log(response);
          this.closeModal();
          this.$emit('success', response.data.user); // .user is received from "UsersController"
          this.clearForm();
          this.$toast.open({
            type: 'is-info',
            message: response.data.status.message, // .status is received from 'UsersController'
            duration: 5000
          });
        })
        .catch(error => {
          // console.log(error.response.data);
          this.errors.recordErrors(error.response.data.errors); //pass the errors returned from server to recordErrors() function
        })
    },

    clearForm() {
      this.user = '';
    },

    closeModal() {
      this.$emit('modalClosed');
    },
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.7s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
