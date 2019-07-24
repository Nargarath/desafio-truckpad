<template>
  <div>
    <a-row justify='space-between'>
      <a-col :sm="24" :md="12">
        <a-form
          :form="searchForm"
          layout="inline"
          @submit="handleSearchSubmit"
        >
        <a-form-item label="Search">
          <a-input 
            v-decorator="[
              'search',
              {rules: [{ required: true, message: 'Please input the text you are searching!' }]}
            ]"
          placeholder="something" />
        </a-form-item>
        <a-form-item label="Column">
          <a-select
            v-decorator="[
              'searchable',
              {rules: [{ required: true, message: 'Please select the column to search!' }]}
            ]"
            placeholder="column to search"
          >
            <a-select-option :value="search.searchable" v-for="search in searchables" :key="search.searchable" @click="selectSearch(search)">
              {{search.searchable}}
            </a-select-option>
          </a-select>
        </a-form-item>
        
        <a-form-item
          :wrapper-col="{ span: 12, offset: 6 }"
        >
          <a-button icon="search" html-type="submit">Search</a-button>
        </a-form-item>
        <a-form-item
          :wrapper-col="{ span: 12, offset: 6 }"
        >
          <a-button icon="delete" @click="cleanForm" type="danger">Clean</a-button>
        </a-form-item>
      </a-form>
      </a-col>
      <a-col :sm="24" :md="12">
        <div class="buttom-create">
          <a-button icon="plus" type="primary"></a-button>
        </div>
      </a-col>
    </a-row>
     
  
    <a-table :columns="columns"
    :rowKey="record => record.id"
    :dataSource="data"
    :pagination="pagination"
    :loading="loading"
    @change="handleTableChange"
    :scroll="{ x: 400}"
    bordered
    >
      <div slot="filterDropdown" slot-scope="{ setSelectedKeys, selectedKeys, confirm, clearFilters, column }" class='custom-filter-dropdown'>
        <a-input
          v-ant-ref="c => searchInput = c"
          :placeholder="`Search ${column.dataIndex}`"
          :value="selectedKeys[0]"
          @change="e => setSelectedKeys(e.target.value ? [e.target.value] : [])"
          @pressEnter="() => handleSearch(selectedKeys, confirm)"
          style="width: 188px; margin-bottom: 8px; display: block;"
        />
        <a-button
          type='primary'
          @click="() => handleSearch(selectedKeys, confirm)"
          icon="search"
          size="small"
          style="width: 90px; margin-right: 8px"
        >Search</a-button>
        <a-button
          @click="() => handleReset(clearFilters)"
          size="small"
          style="width: 90px"
        >Reset</a-button>
      </div>
      <template slot="birth_date" slot-scope="birth_date">
        {{ birth_date | formatDate }}
      </template>
      <span slot="action" slot-scope="action">
        <a-button shape="circle" icon="eye" />
        <a-divider type="vertical" />
        <a-button shape="circle" icon="form" type="primary" />
        <a-divider type="vertical" />
        <a-button shape="circle" icon="delete" type="danger" />
      </span>
    </a-table>
  </div>
</template>
<script>
const columns = [
  {
    title: 'Nome',
    dataIndex: 'name',
    sorter: true,
    key: 'name',
    width: '30%',
    scopedSlots: { 
      customRender: 'name',
      filterDropdown: 'filterDropdown',
      filterIcon: 'filterIcon'
    },
    onFilter: (value, record) => record.name.toLowerCase().includes(value.toLowerCase()),
    onFilterDropdownVisibleChange: (visible) => {
      if (visible) {
        setTimeout(() => {
          this.searchInput.focus()
        },0)
      }
    },
  },
  {
    title: 'Aniversário',
    dataIndex: 'birth_date',
    sorter: true,
    key: 'birth_date',
    width: '100%',
    scopedSlots: { customRender: 'birth_date' },
  },
  {
    title: '',
    key: 'action',
    fixed: 'right',
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
      searchInput: null,
      searchables: [
        {
          searchable: 'name',
          search: ''
        }
      ],
      searchSelected: {
        
      },
      searchForm: this.$form.createForm(this),
      sorter: {
        order: '',
        field: ''
      }

    }
  },
  methods: {
    handleTableChange (pagination, filters, sorter) {
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      this.sorter = sorter;
      this.fetch({
        results: pagination.pageSize,
        page: pagination.current,
        sortField: sorter.field,
        sortOrder: this.fixOrderName(sorter.order),
        search: filters,
      });
    },
    fetch (params = {}) {
      this.loading = true
      	ApiService
				.get('people.datatable',{
          params,
        })
				.then(({data}) => {
          const pagination = {...this.pagination};
          pagination.total = data.total;
          pagination.current = data.current_page;
          this.data = data.data;
          this.loading = false;
          this.pagination = pagination;
				})
				.catch(error => {
					console.log(error);
				})
    },
    fixOrderName(value){
      return this.$options.filters.sortOrder(value) 
    },
    handleSearch (selectedKeys, confirm) {
      confirm()
      this.searchText = selectedKeys[0]
    },

    handleReset (clearFilters) {
      clearFilters()
      this.searchText = ''
    },
    selectSearch(searchObj){
      this.searchSelected = searchObj;
    },
    handleSearchSubmit(e){
      e.preventDefault();
      this.searchForm.validateFields((err, values) => {
        if (!err) {
          this.searchSelected = values;
          this.handleTableChange({results: 10,page: this.pagination.current}, this.searchSelected, this.sorter)
        }
      });
    },
    cleanForm(){
      this.searchForm.setFieldsValue({
        search: '',
        searchable: ''
      });
    }
  },
}
</script>
<style lang="scss">
.ant-table-fixed-columns-in-body{
  display: none;
}
.ant-table-row.ant-table-row-level-0{
  height: 65px;
}
[role="combobox"]{
  width: 150px;
}
.ant-form-inline{
  margin-bottom: 1rem;
}
.ant-layout-content{
  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.1);
}
.buttom-create{
  display: flex;
  align-items: center;
  justify-content: flex-end;
}
</style>