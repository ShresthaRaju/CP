<template lang="html">

  <section class="section">
    <div class="container m-t-10">
      <div class="columns">
        <div class="column is-one-third is-offset-2">
          <div class="card">
              <div class="card-content">
                <form method="post" @keydown="errors.clearError($event.target.name)">
                  <div class="field">
                    <label class="label">Socialize</label>
                    <div class="control has-icons-right">
                      <input type="text" :class="['input',{'is-danger':errors.hasError('github')}]" placeholder="Github Username..." name="github" v-model="socialize.github">
                      <span class="icon is-small is-right" v-if="errors.hasError('github')">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    </div>
                      <p class="help is-danger" v-if="errors.hasError('github')">{{errors.getErrorMessage('github')}}</p>
                  </div>

                  <div class="field">
                    <div class="control has-icons-right">
                      <input type="text" :class="['input',{'is-danger':errors.hasError('linkedin')}]" placeholder="LinkedIn Username..." name="linkedin" v-model="socialize.linkedin">
                      <span class="icon is-small is-right" v-if="errors.hasError('linkedin')">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    </div>
                      <p class="help is-danger" v-if="errors.hasError('linkedin')">{{errors.getErrorMessage('linkedin')}}</p>
                  </div>

                  <button class="button is-primary is-outlined is-fullwidth m-t-20" @click.prevent="social">Save</button>
                </form>
              </div>
            </div> <!--end of first .card-->

            <div class="card m-t-20">
              <div class="card-content">
                <form method="POST" @keydown="errors.clearError($event.target.name)">
                  <div class="field">
                    <label class="label">Change Password</label>
                    <div class="control has-icons-right">
                      <input type="password" :class="['input',{'is-danger':errors.hasError('current_password')}]" placeholder="Current Password..." name="current_password" v-model="passwords.current_password">
                      <span class="icon is-small is-right" v-if="errors.hasError('current_password')">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    </div>
                      <p class="help is-danger" v-if="errors.hasError('current_password')">{{errors.getErrorMessage('current_password')}}</p>
                      <p class="help is-danger" v-if="passwordError">{{passwordError}}</p>
                  </div>

                  <div class="field">
                    <div class="control has-icons-right">
                      <input type="password" :class="['input',{'is-danger':errors.hasError('new_password')}]" placeholder="New Password..." name="new_password" v-model="passwords.new_password">
                      <span class="icon is-small is-right" v-if="errors.hasError('new_password')">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    </div>
                      <p class="help is-danger" v-if="errors.hasError('new_password')">{{errors.getErrorMessage('new_password')}}</p>
                  </div>

                  <button class="button is-primary is-outlined is-fullwidth m-t-20" @click.prevent="changePassword">Change</button>
                </form>
              </div>
            </div> <!-- end of second .card-->
        </div> <!-- end of .column-->

        <div class="column is-one-third-desktop is-one-third-tablet is-offset-1">
          <div class="card">
            <div class="card-content">
              <div v-if="imageUrl" class="has-text-centered">
                <figure>
                  <p class="image is-1by1">
                    <img :src="imageUrl" :alt="selectedImage.name">
                  </p>
                </figure>
                <p class="title is-6 m-t-5">{{selectedImage.name}}</p>
                <!-- progress bar -->
                <progress class="progress is-small m-t-10 m-b-10" :value="percentUploaded" max="100">{{percentUploaded}}%</progress>

                <button class="button is-small is-dark is-outlined" @click.prevent="uploadPicture">Upload</button>
                <button class="button is-small is-danger" @click.prevent="imageUrl=null">Cancel</button>
              </div>

              <form enctype="multipart/form-data">
                <div class="field m-t-15" v-if="!imageUrl">
                  <div class="file is-info has-name">
                    <label class="file-label">
                      <input class="file-input" type="file" name="display_image" accept="image/*" @change="onImageSelected">
                      <span class="file-cta">
                        <span class="file-icon">
                          <i class="fa fa-upload"></i>
                        </span>
                      </span>
                      <span class="file-name">Upload a picture...</span>
                    </label>
                  </div>
                  <p class="help is-danger" v-if="errors.hasError('display_image')">{{errors.getErrorMessage('display_image')}}</p>
                </div>
              </form>
            </div>
          </div>
        </div> <!--end of last .column-->

      </div>
    </div>
  </section>

</template>

<script>
import Errors from '../utilities/errors.js';

export default {

  props: ['user'],

  data() {
    return {
      errors: new Errors(),
      socialize: {
        github: '',
        linkedin: '',
      },
      passwords: {
        current_password: '',
        new_password: '',
      },
      passwordError: '',

      selectedImage: null,
      imageUrl: null,
      percentUploaded: 0,

    }
  },

  methods: {
    social() {
      axios.put(`/user/${this.user.id}/socialize`, this.socialize)
        .then(response => {
          this.socialize = '';
          this.$toast.open({
            type: 'is-success',
            message: response.data.success,
            duration: 5000
          });
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

    changePassword() {
      axios.put(`/user/${this.user.id}/changepassword`, this.passwords)
        .then(response => {
          if (response.data.error) {
            this.passwordError = response.data.error;
          } else {
            this.passwords = '';
            this.passwordError = '';
            this.$toast.open({
              type: 'is-success',
              message: response.data.success,
              duration: 5000
            });
          }
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

    onImageSelected(event) {
      this.selectedImage = event.target.files[0];
      this.imageUrl = URL.createObjectURL(this.selectedImage);
    },

    uploadPicture() {
      var formData = new FormData();
      formData.append('display_image', this.selectedImage, this.selectedImage.name);
      axios.post(`/user/${this.user.id}/uploadpicture`, formData, {
          onUploadProgress: progressEvent => {
            this.percentUploaded = (Math.round((progressEvent.loaded * 100) / progressEvent.total));
          }
        })
        .then(response => {
          this.percentUploaded = 0;
          this.selectedImage = null;
          this.imageUrl = null;
          this.$toast.open({
            type: 'is-success',
            message: response.data.success,
            duration: 5000
          });
        })
        .catch(error => this.errors.recordErrors(error.response.data.errors))
    },

  }

}
</script>
