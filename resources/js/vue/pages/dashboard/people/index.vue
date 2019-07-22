<template>
    <a-table :columns="columns"
    :rowKey="record => record.login.uuid"
    :dataSource="data"
    :pagination="pagination"
    :loading="loading"
    @change="handleTableChange"
  >
    <template slot="name" slot-scope="name">
      {{name.first}} {{name.last}}
    </template>
    <span slot="action" slot-scope="text, record">
      <a href="javascript:;">Detalhes</a>
      <a-divider type="vertical" />
      <a href="javascript:;">Edit</a>
      <a-divider type="vertical" />
      <a href="javascript:;">Delete</a>
    </span>
 
  </a-table>
</template>
<script>
const columns = [
  {
    title: 'Nome',
    dataIndex: 'name',
    sorter: true,
    width: '20%',
    scopedSlots: { customRender: 'name' },
  }, 
  {
    title: 'Aniversário',
    dataIndex: 'birth_date',
    width: '20%',
  },
  {
    title: 'Action',
    key: 'action',
    scopedSlots: { customRender: 'action' },
  }
];

export default {
  mounted() {
    this.fetch();
  },
  data() {
    return {
      data: [],
      pagination: {},
      loading: false,
      columns,
    }
  },
  methods: {
    handleTableChange (pagination, filters, sorter) {
      console.log(pagination);
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      this.fetch({
        results: pagination.pageSize,
        page: pagination.current,
        sortField: sorter.field,
        sortOrder: sorter.order,
        ...filters,
      });
    },
    fetch (params = {}) {
      console.log('params:', params);
      this.loading = true
      /*
      reqwest({
        url: 'https://randomuser.me/api',
        method: 'get',
        data: {
          results: 10,
          ...params,
        },
        type: 'json',
      }).then((data) => {
        const pagination = { ...this.pagination };
        // Read total count from server
        // pagination.total = data.totalCount;
        pagination.total = 200;
        this.loading = false;
        this.data = data.results;
        this.pagination = pagination;
      });
      */
    }
  },
}
</script>
<style lang="scss" scoped>

</style>
