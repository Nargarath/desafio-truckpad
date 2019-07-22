<template>
    <a-table :columns="columns"
    :rowKey="record => record.id"
    :dataSource="data"
    :pagination="pagination"
    :loading="loading"
    @change="handleTableChange"
    bordered
  >
    <template slot="birth_date" slot-scope="birth_date">
      {{ birth_date | formatDate }}
    </template>
    <span slot="action" >
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
    sorter: true,
    width: '20%',
    scopedSlots: { customRender: 'birth_date' },
  },
  {
    title: '',
    key: 'action',
    scopedSlots: { customRender: 'action' },
  }
];
import ApiService from "../../../services/api.service"
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
      	ApiService
				.get('people.datatable',{
          ...params,
        })
				.then(({data}) => {
          console.log(data);
          this.data = data.data;
          this.loading = false;
					resolve(data);
				})
				.catch(error => {
					reject(error);
				})
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
