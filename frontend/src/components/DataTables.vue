<template>
  <div id="datatable">
    <div class="row mb-3">
      <div class="col-md-3">
        <div class="input-group">
          <input 
            v-model="search"
            class="form-control"
            placeholder="Search..."
            type="text"
          />
          
          <div class="input-group-append">
            <button 
              class="btn btn-primary"
              type="button"
              @click.prevent="handleSearch"
            >
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> Show </span>
          </div>

          <select
            class="form-control"
            v-model="perPage"
            @change="handlePerPage"
            id="pageOptions"
          >
            <option
              v-for="page in pageOptions"
              :key="page"
              :value="page"
            >
              {{ page }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <table v-bind:class="tclass">
      <thead>
        <tr>
          <th v-for="column in columnList" :key="column" @click="sortByColumn(column)"> 
            {{ column.toUpperCase() }} 
            
            <span v-if="column === sortField">
              <i v-if="sortOrder === 'asc'" class="fa fa-arrow-up"></i> 
              <i v-else class="fa fa-arrow-down"></i> 
            </span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="tableData.length == 0">
          <td colspan="100%" class="text-center m-4 w-100">
            No records found
          </td>
        </tr>
        <tr v-for="data in tableData" :key="data.data">
          <td v-for="col in data" :key="col"> {{ col }} </td>
        </tr>
      </tbody>
    </table>

    <PaginatorTable 
      v-if="tableData.length > 0"
      :pagination="pagination"
      :total="tableData.length"
      @pageChanged="handlePageChange"
    /> 
  </div>
</template>

<script>
import axios from 'axios'
import PaginatorTable from './PaginatorTable.vue'

export default {
  name: 'DatatablesComponent',
  components: {
    PaginatorTable
  },
  props: {
    columns: { type: Array, required: true },
    tclass: { type: Number, required: true },
    url: { type: String, required: true },
    useNumber: { type: Boolean, required: false }
  },
  data() {
    return {
      tableData: [],
      sortField: this.columns[1],
      sortOrder: "asc",
      search: null,
      pageOptions: [5, 10, 20, 50],
      perPage: 5,
      pagination: { to: 1, from: 1  },
      page: 1,
      total: 1,
      columnList: this.columns,
      number: this.useNumber
    }
  },
  created() {
    // if (this.number) {
    //   for (let i = 0; i < this.pagination.total; i++) {
    //     this.columnList[i].unshift({no: i})
    //   }
    // }

    this.fetchData()
},
  methods: {
    async fetchData() {
      try {
        const params = {
          field: this.sortField,
          order: this.sortOrder,
          search: this.search,
          per_page: this.perPage,
          page: this.page
        }

        const {data} = await axios.get(this.url, {params})
        this.tableData = data.data 
        this.pagination = data.meta

        // if (this.number) {
        //   this.columnList.unshift('no')
        //   console.log(this.columnList)
          
        //   data.data.forEach((i) => {
        //     console.log(i)
        //   })
        // }
        
      } catch (e) {
        console.log(e)
      }
    },
    sortByColumn(col) {
      if (col === this.sortField) {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc'
      } else {
        this.sortField = col
      }

      this.fetchData()
    },
    handleSearch() {
      this.sortField = this.columns[0]
      this.sortOrder = "asc"
      this.page = 1
      this.fetchData()
    },
    handlePerPage(e) {
      this.perPage = e.target.value
      this.fetchData()
    },
    handlePageChange(number) {
      this.page = number
      this.fetchData()      
    }
  }
}
</script>

<style scoped>
thead tr th {
  cursor: pointer;
}

tr {
  min-height: 60px;
  vertical-align: middle; 
}


.btn {
  border-radius: 0 0.25rem 0.25rem 0;
}
</style>