<template>
  <div class="auctions">
    <h3>List of current Auctions</h3>
    <div class="tableFilters">
      <input class="input form-control" type="text" v-model="tableData.search" placeholder="Search auction"
             @input="getAuctions()">
    </div>
    <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
      <tbody>
      <tr v-for="auction in auctions" :key="auction.id">
        <td>{{auction.id}}</td>
        <td>{{auction.title}}</td>
        <td>{{auction.description}}</td>
        <td>{{auction.price}}</td>
        <td><button @click="detailPage(auction.id)" type="button" class="btn btn-success">Bid Now</button></td>
      </tr>
      </tbody>
    </datatable>
    <div class="control">
      <div class="select">
        <select class="w-8 form-control" v-model="tableData.length" @change="getAuctions()">
          <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
        </select>
      </div>
    </div>
    <pagination :pagination="pagination"
                @prev="getAuctions(pagination.prevPageUrl)"
                @next="getAuctions(pagination.nextPageUrl)">
    </pagination>
  </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';
export default {
  components: { datatable: Datatable, pagination: Pagination },
  created() {
    this.getAuctions();
  },
  data() {
    let sortOrders = {};
    let columns = [
      {width: '10%', label: '#', name: 'id'},
      {width: '20%', label: 'Title', name: 'title'},
      {width: '30%', label: 'Description', name: 'description'},
      {width: '10%', label: 'Price ($)', name: 'price'}
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      auctions: [],
      columns: columns,
      sortKey: 'id',
      sortOrders: sortOrders,
      perPage: ['10', '20', '30'],
      tableData: {
        draw: 0,
        length: 10,
        search: '',
        column: 0,
        dir: 'asc',
      },
      pagination: {
        lastPage: '',
        currentPage: '',
        total: '',
        lastPageUrl: '',
        nextPageUrl: '',
        prevPageUrl: '',
        from: '',
        to: ''
      },
    }
  },
  methods: {
    getAuctions(url = '/getAuctionItems') {
      this.tableData.draw++;
      axios.get(url, {params: this.tableData})
          .then(response => {
            let data = response.data;
            if (this.tableData.draw == data.draw) {
              this.auctions = data.data.data;
              this.configPagination(data.data);
            }
          })
          .catch(errors => {
            console.log(errors);
          });
    },
    configPagination(data) {
      this.pagination.lastPage = data.last_page;
      this.pagination.currentPage = data.current_page;
      this.pagination.total = data.total;
      this.pagination.lastPageUrl = data.last_page_url;
      this.pagination.nextPageUrl = data.next_page_url;
      this.pagination.prevPageUrl = data.prev_page_url;
      this.pagination.from = data.from;
      this.pagination.to = data.to;
    },
    sortBy(key) {
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
      this.tableData.column = this.getIndex(this.columns, 'name', key);
      this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
      this.getAuctions();
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value)
    },
    detailPage(auctionID) {
      window.location.href = '/detail?id=' + auctionID;
    }
  }
};
</script>