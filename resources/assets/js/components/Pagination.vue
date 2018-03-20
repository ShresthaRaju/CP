<template lang="html">

  <nav class="pagination is-rounded is-small is-centered m-t-25" role="navigation" aria-label="pagination">
    <a class="pagination-previous" @click="$parent.fetchAll(pagination.prevPageUrl)" :disabled="!pagination.prevPageUrl">
      &lsaquo;&lsaquo;
    </a>
    <a class="pagination-next" @click="$parent.fetchAll(pagination.nextPageUrl)" :disabled="!pagination.nextPageUrl">
      &rsaquo;&rsaquo;
    </a>
    <ul class="pagination-list">
      <li v-for="i in pagination.lastPage">
        <a :class="['pagination-link',{'is-current':i==pagination.currentPage}]" @click="$emit('pageLinkClicked',i)">{{i}}</a>
      </li>
    </ul>
  </nav>

</template>

<script>
export default {
  props: ['pagination'],
}
</script>
