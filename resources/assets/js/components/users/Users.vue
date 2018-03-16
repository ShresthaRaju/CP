<template lang="html">

  <div>
    <div class="columns">
      <div class="column has-text-centered">
        <button class="button is-primary" @click="isCreateUserModalActive=true"><span class="icon"><i class="fa fa-user-plus"></i></span><span>Create New User</span></button>
      </div>
    </div>

    <div class="columns">
      <div class="column is-10 is-offset-1">
        <div class="card">
          <div class="card-content">
            <div class="table-responsive">
              <table class="table is-striped is-hoverable is-narrow is-fullwidth">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Joined on</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(user,index) in users">
                    <td>{{user.id}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at | formatDate}}</td>
                    <td>
                      <span class="tag is-info" v-if="user.active==1">Active</span>
                      <span class="tag is-danger" v-else>Inactive</span>
                    </td>
                    <td>
                      <a class="is-pulled-right has-text-danger" @click.prevent="deleteUser(index,user.id)"><span class="icon"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--- end of .card-->

        <!-- pagination -->
        <nav class="pagination is-rounded is-small is-centered m-t-25" role="navigation" aria-label="pagination">
          <a class="pagination-previous" @click="fetchAllUsers(pagination.prevPageUrl)" :disabled="!pagination.prevPageUrl">
            <span class="icon"><i class="fa fa-arrow-left"></i></span>
          </a>
          <a class="pagination-next" @click="fetchAllUsers(pagination.nextPageUrl)" :disabled="!pagination.nextPageUrl">
            <span class="icon"><i class="fa fa-arrow-right"></i></span>
          </a>
          <ul class="pagination-list">
            <li v-for="i in pagination.lastPage">
              <a :class="['pagination-link',{'is-current':i==pagination.currentPage}]" @click="fetchAllUsers(`/admin/users?page=${i}`)">{{i}}</a>
            </li>
          </ul>
        </nav>
      </div>

    </div> <!-- end of second .columns-->

    <!-- new user create modal -->
    <userCreateModal v-if="isCreateUserModalActive" @modalClosed="isCreateUserModalActive=false" @success="addUserToTable"></userCreateModal>

  </div>

</template>

<script>
import userCreateModal from './userCreateModal.vue';
import moment from 'moment';
export default {

  created() {
    this.fetchAllUsers();
  },

  components: {
    userCreateModal
  },

  data() {
    return {
      users: {},
      pagination: {},
      isCreateUserModalActive: false,
    }
  },

  methods: {
    fetchAllUsers(page_url) {
      page_url = page_url || '/admin/users'
      axios.get(page_url)
        .then(response => {
          // console.log(response.data);
          this.users = response.data.data;
          this.makePagination(response.data);
        })
        .catch(error => {
          console.log(error);
        });
    },

    makePagination(paginationData) {

      let pagination = {
        currentPage: paginationData.current_page,
        lastPage: paginationData.last_page, //gives total number of pages
        nextPageUrl: paginationData.next_page_url,
        prevPageUrl: paginationData.prev_page_url,
      }
      this.pagination = pagination;
    },

    deleteUser(index, user) { //index is for removing the deleted user from the users object above
      this.$dialog.confirm({
        title: 'Deleting User',
        message: 'Are you sure you want to <b>delete</b> this user? This action cannot be undone.',
        confirmText: 'Delete User',
        type: 'is-danger',
        hasIcon: true,
        iconPack: 'fa',
        onConfirm: () => axios.delete(`users/${user}`)
          .then(response => {
            this.users.splice(index, 1); // [splice(at which index, how many item to remove)]
            this.$toast.open({
              duration: 5000,
              message: response.data.message,
              type: 'is-success'
            });

          })
          .catch(error => {
            console.log(error);
          })
      });
    },

    addUserToTable(user) {
      this.users.unshift(user);
    }

  },

  filters: {
    formatDate(date) {
      return moment(date).format('LL');
    }
  },

}
</script>
