<template lang="html">

  <nav class="pagination is-rounded is-small is-centered m-t-25" role="navigation" aria-label="pagination">
    <a class="pagination-previous" @click="$parent.fetchAll(pagination.prevPageUrl)" :disabled="!pagination.prevPageUrl">
      <span class="icon"><i class="fa fa-arrow-left"></i></span>
    </a>
    <a class="pagination-next" @click="$parent.fetchAll(pagination.nextPageUrl)" :disabled="!pagination.nextPageUrl">
      <span class="icon"><i class="fa fa-arrow-right"></i></span>
    </a>
    <ul class="pagination-list">
      <li v-for="i in pagination.lastPage">
        <a :class="['pagination-link',{'is-current':i==pagination.currentPage}]" @click="$parent.fetchAll(`/admin/users?page=${i}`)">{{i}}</a>
      </li>
    </ul>
  </nav>

</template>

<script>
export default {
  props: ['pagination'],
}
</script>
