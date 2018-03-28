<template lang="html">

  <div class="discussions">
    <div class="columns">
      <div class="column">
        <div class="card">
          <div class="card-content">
            <div class="table-responsive">
              <table class="table is-hoverable is-narrow is-fullwidth">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Channel</th>
                    <th>Posted By</th>
                    <th>Posted On</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(discussion,index) in discussions">
                    <td>{{discussion.id}}</td>
                    <td>{{discussion.title.substring(0,15)}}{{discussion.title.length>15?'...':''}}</td>
                    <td>{{(discussion.description.replace(/(<([^>]+)>)/ig,"")).substring(0,70)}}{{discussion.description.length>70?'...':''}}</td>
                    <td><span class="tag is-light">{{discussion.channel.title}}</span></td>
                    <td>{{discussion.user.name}}</td>
                    <td>{{discussion.created_at | formatDate}}</td>
                    <td class="has-text-left">
                      <b-tooltip label="Delete this discussion"
                        type="is-dark"
                        position="is-left"
                        animated>
                        <a class="has-text-danger" @click.prevent="deleteDiscussion(index,discussion.id)"><span class="icon"><i class="fa fa-trash"></i></span></a>
                      </b-tooltip>
                     </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--- end of .card-->

        <!-- pagination -->
        <Pagination :pagination="pagination" @pageLinkClicked="fetchDiscussionsFrom($event)" v-if="pagination.lastPage>1"></Pagination>
      </div>
    </div> <!-- end of .columns-->
  </div>

</template>

<script>
import Pagination from '../Pagination.vue';
import moment from 'moment';

export default {

  created() {
    this.fetchAll();
  },

  components: {
    'Pagination': Pagination,
  },

  data() {
    return {
      discussions: {},
      pagination: {},
    }
  },

  methods: {
    fetchAll(page_url) {
      page_url = page_url || `/admin/discussions`
      axios.get(page_url)
        .then(response => {
          // console.log(response.data);
          this.discussions = response.data.data;
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

    deleteDiscussion(index, discussion) {
      this.$dialog.confirm({
        title: 'Deleting Discussion',
        message: 'Are you sure you want to <b>delete</b> this discussion? This action cannot be undone.',
        confirmText: 'Delete Discussion',
        type: 'is-danger',
        hasIcon: true,
        iconPack: 'fa',
        onConfirm: () => axios.delete(`/admin/discussions/${discussion}`)
          .then(response => {
            this.discussions.splice(index, 1);
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

    fetchDiscussionsFrom(pageNo) {
      this.fetchAll(`/admin/discussions?page=${pageNo}`);
    }

  },

  filters: {
    formatDate(date) {
      return moment(date).format('LL');
    }
  },
}
</script>
