<template lang="html">

  <div class="users">
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
              <table class="table is-hoverable is-narrow is-fullwidth">
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
                    <th>{{user.id}}</th>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at | formatDate}}</td>
                    <td>
                      <span class="tag is-info" v-if="user.active==1">Active</span>
                      <span class="tag is-danger" v-else>Inactive</span>
                    </td>
                    <td class="has-text-centered">
                      <b-tooltip label="Delete this user"
                        type="is-dark"
                        position="is-left"
                        animated>
                        <a class="has-text-danger" @click.prevent="deleteUser(index,user.id)"><span class="icon"><i class="fa fa-trash"></i></span></a>
                      </b-tooltip>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--- end of .card-->

        <!-- pagination -->
        <Pagination :pagination="pagination" @pageLinkClicked="fetchUsersFrom($event)" v-if="pagination.lastPage>1"></Pagination>

      </div>

    </div> <!-- end of second .columns-->

    <!-- new user create modal -->
    <user-create-modal v-if="isCreateUserModalActive" @modalClosed="isCreateUserModalActive=false" @success="addUserToTable($event)"></user-create-modal>

  </div>

</template>

<script>
import Pagination from '../Pagination.vue';
import userCreateModal from './UserCreateModal.vue';
import moment from 'moment';

export default {

  created() {
    this.fetchAll();
  },

  components: {
    'Pagination': Pagination,
    'user-create-modal': userCreateModal
  },

  data() {
    return {
      users: {},
      pagination: {},
      isCreateUserModalActive: false,
    }
  },

  methods: {
    fetchAll(page_url) {
      page_url = page_url || `/admin/users`
      axios.get(page_url)
        .then(response => {
          // console.log(response.data);
          this.users = response.data.data;
          this.makePagination(response.data);
        })
        .catch(error => {
          console.log(error.response.data);
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
        onConfirm: () => axios.delete(`/admin/users/${user}`)
          .then(response => {
            this.users.splice(index, 1); // [splice(at which index, how many item to remove)]
            this.$toast.open({
              message: response.data,
              duration: 5000,
            });

          })
          .catch(error => {
            console.log(error.response.data);
          })
      });
    },

    addUserToTable(user) {
      this.users.unshift(user);
    },

    fetchUsersFrom(pageNo) {
      this.fetchAll(`/admin/users?page=${pageNo}`);
    }

  },

  filters: {
    formatDate(date) {
      return moment(date).format('LL');
    }
  },
}
</script>
