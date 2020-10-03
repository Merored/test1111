<template>
    <div>
        <div class="row">
            <div class="col-11">
                <b-form-input v-model="search" placeholder="Поиск по базе"></b-form-input>
            </div>
            <div class="col-1">
                <b-button variant="success" @click="searchItems()">Искать</b-button>
            </div>
        </div>
        
        
        <b-table striped :fields="fields" :items="items"></b-table>
        <b-pagination ref="Page" align="center"
            @change="nextPage()"
            :total-rows="total"
            v-model="currentPage"
            :per-page="perPage">
        </b-pagination>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: [
            {
                key: 'id',
                label: 'ID',
                sortable: true
            },
            {
                key: 'name',
                label: 'Имя',
            },
            {
                key: 'surname',
                label: 'Фамилия',
            },
            {
                key: 'country',
                label: 'Страна',
            },
            {
                key: 'company',
                label: 'Компания',
            },
            {
                key: 'phone',
                label: 'Телефон',
            }
        ],
        items: [], 
        search:'',
        searchCurrent:'',
        total: 0,
        perPage: 0,
        currentPage: 1,
      }
    },
    mounted() {
        this.loadItems()
    },
    methods: {
        searchItems: function () {
            this.items = []
            axios.get('/api/customers', {
                params: {page: this.$refs.Page.currentPage, search_str: this.search}
            }).then((response) => {                    
                this.items = response.data.data;
                this.total = response.data.total;
                this.perPage = response.data.per_page;
                this.currentPage = response.data.current_page;
                this.searchCurrent = this.search;
            })
        },
        nextPage: function () {
            this.items = []
            axios.get('/api/customers', {
                params: {page: this.$refs.Page.currentPage, search_str: this.searchCurrent}
            }).then((response) => {                    
                this.items = response.data.data;
                this.total = response.data.total;
                this.perPage = response.data.per_page;
                this.currentPage = response.data.current_page;
            })
        },
        loadItems() {
            this.items = []
            axios.get('/api/customers').then((response) => {                    
                this.items = response.data.data;
                this.total = response.data.total;
                this.perPage = response.data.per_page;
                this.currentPage = response.data.current_page;
            })
        },
    }
  }
</script>