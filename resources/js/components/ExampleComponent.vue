<!--<template>
    <div>
      <b-field grouped group-multiline>
        <div class="control is-flex">
          <b-switch v-model="multiColumnSortingEnabled" @input="resetPriority">Sort multiple rows</b-switch>
        </div>
        <div class="control is-flex">
          <span class="button" :disabled="!multiColumnSortingEnabled" @click="resetPriority">Reset sorting</span>
        </div>
        <div class="control is-flex">
          <b-select v-model="customKey" :disabled="!multiColumnSortingEnabled">
            <option :value="null">None</option>
            <option value="shiftKey">Shift</option>
            <option value="altKey">Alt/Option</option>
            <option value="ctrlKey">Control</option>
          </b-select>
        </div>
        <div class="control is-flex">
          <b-switch v-model="backendSortingEnabled" @input="resetPriority">Backend sorting</b-switch>
        </div>
      </b-field>
      <b-table
        :data="data"
        ref="multiSortTable"
        :backend-sorting="backendSortingEnabled"
        @sort="sortPressed"
        @sorting-priority-removed="sortingPriorityRemoved"
  
        :sort-multiple="multiColumnSortingEnabled"
        :sort-multiple-data="sortingPriority"
        :sort-multiple-key="customKey"
      >
  
          <b-table-column field="first_name" label="First name" sortable v-slot="props">
              {{ props.row.first_name }}
          </b-table-column>
          <b-table-column field="last_name" label="Last name" sortable v-slot="props">
              {{ props.row.last_name }}
          </b-table-column>
          <b-table-column field="team" label="Team" sortable v-slot="props">
              {{ props.row.team }}
          </b-table-column>
  
      </b-table>
    </div>
  </template>
  
  <script>
  import orderBy from 'lodash/orderBy'
  
  const dataSource = [
    { 'id': 1, 'first_name': 'Abbie', 'last_name': 'Archer', 'team': 'Team B'},
    { 'id': 2, 'first_name': 'Abbie', 'last_name': 'Smith', 'team': 'Team A'},
    { 'id': 3, 'first_name': 'Jones', 'last_name': 'Smith', 'team': 'Team C'},
    { 'id': 4, 'first_name': 'Abbie', 'last_name': 'Archer', 'team': 'Team A'}
  ]
    export default {
        data() {
            return {
              customKey: null,
              backendSortingEnabled: false,
              multiColumnSortingEnabled: true,
              data: [],
              sortingPriority: []
            }
        },
        methods: {
          resetPriority(){
            this.$refs.multiSortTable.resetMultiSorting()
  
            // reset local backend sorting
            if(this.backendSortingEnabled) {
              this.sortingPriority = []
              this.loadAsyncData()
            }
          },
  
          // Backend sorting
          sortingPriorityRemoved(field){
            this.sortingPriority = this.sortingPriority.filter(
              (priority) => priority.field !== field)
            this.loadAsyncData(this.sortingPriority)
          },
  
          sortPressed(field, order, event) {
            if(this.backendSortingEnabled) {
              if(this.multiColumnSortingEnabled){
                if((this.customKey && event[this.customKey]) || !this.customKey) {
                  let existingPriority = this.sortingPriority.filter(i => i.field === field)[0]
                  if(existingPriority) {
                    existingPriority.order = existingPriority.order === 'desc' ? 'asc' : 'desc'
                  } else {
                    // request sorted data from backend
                    this.sortingPriority.push({field, order})
                  }
                  this.loadAsyncData(this.sortingPriority)
                } else {
                  // request regular sorted data from backend
                  this.sortingPriority = [] // [{field, order}]
                  this.loadAsyncData([{field, order}])
                }
              }
            }
          },
  
          // "API request" for data
          async loadAsyncData(sortingPriority = []) {
            let mockdata = JSON.parse(JSON.stringify(dataSource));
            // get data already sorted from the backend using sortingPriority
            this.data = orderBy(mockdata, sortingPriority.map(i => i.field), sortingPriority.map(i => i.order))
          }
        },
        created () {
          this.data = JSON.parse(JSON.stringify(dataSource));
        }
    }
  </script>
<style sclang="scss" scoped>
    .f-select {
      font-weight: 800;
      font-size: 17px;
      padding: 0 -15px;
      border: none;
      background-color: transparent;
    }
    
    .f-select2 {
      font-size: 13px;
      padding-right: 2px;
    }
    thead {
      border: 2px solid rgb(222, 222, 235);
    }
    table {
      border-collapse: separate;
      border-spacing: 0px 12px;
      border-left-style: 2px;
    }
    tr {
      border: 2px solid rgb(222, 222, 235);
    }
    tr,
    td {
      padding-top: 30px;
      padding-bottom: 30px;
      border-color: rgb(222, 222, 235);
      border-style: solid;
      border-width: 2px;
      border-left-style: none;
      border-right-style: none;
      margin-right: auto;
    }
    td:last-child {
      border-right-style: solid;
      border-left-style: solid;
    }
    td a {
      color: black;
    }
    thead tr th:first-child {
      width: 50px;
      border-left-style: solid;
      border-left-width: 1px;
      border-right-style: solid;
      border-right-width: 1px;
    }
    thead tr th:not(th:last-child) :hover {
      cursor: pointer;
    }
    thead tr:not(td:last-child) :hover {
      cursor: pointer;
    }
    tbody td:first-child {
      border-left-style: solid;
      border-left-width: 1px;
      border-right-style: solid;
      border-right-width: 1px;
    }
    .idcolval {
      font-weight: bolder;
      font-size: 20px;
    }
    .box-stat {
      width: 100px;
      height: 100px;
      border-right-style: solid;
    }
    .box-stat:not(:last-child) {
      border-right-width: 2px;
      border-right-color: rgb(217, 231, 244);
    }
    .box-stat:last-child {
      border-right: none;
    }
    
    .select-input {
      margin: 2px;
      box-sizing: border-box;
    }
    li{
      list-style: none;
    }
    option{
      list-style: none;
    }
    .edit-row{
      min-width: 500px;
    }
    .list-choice{
      max-height:250px;
      overflow:auto;
      list-style: none;
    
    }
    .list-choice input{
    height: 100px;
    }
    </style>  
  -->
  <template>
    <div class="bd-2">
      Pour réaliser mon reve, il aurait fallu que j'en ai un. Celà n'est pas si compliqué que ça.Il faudrait tout de meme 
      changer un peu de paradigme.
      <mana></mana>
    </div>
      
  </template>
  
  <script>
    export default {
  
    }
  </script>
<style sclang="scss" scoped>
    
    </style>  

  
