<script setup>
  import SearchOrders from './components/SearchOrders.vue';
</script>

<template>
  <div class="container">
    <h1>Ricerca ordini</h1>
    <SearchOrders></SearchOrders>
  </div>
</template>

<style>
    body {
        font-family: 'Lyon Text OSF Web', 'Georgia', 'Times New Roman', Times, serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #f8f8f8;
    }

    .container {
        background-color: #003150;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    h1, h2 {
        font-family: "Stencil",Georgia,"Times New Roman",Times,serif;
        color: #fff;
        border-bottom: 2px solid #007bb5;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-weight: normal;
        text-transform: none;
        letter-spacing: normal;
        text-decoration: none;
        font-size: 28px;
        line-height: 40px;
        letter-spacing: 0.5px;
        display: block;
    }

    .search-form {
        position: relative;
        padding: 30px;
        background-color: #003150;
    }

    .search-form input {
        padding: 10px;
        background-color: #fcb400;
        border-width: 0;
        text-align: center;
        color: black;
        border-radius: 3px;
        font-size: 1.2em;
        width: 100%;
        box-sizing: border-box;
        outline: none;
        padding-right: 40px;
    }

    .search-form button {
        position: absolute;
        top: 50%;
        right: 30px;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: transparent url('https://static.internazionale.it/assets/img/icons/cerca_b.svg') no-repeat center center;
        background-size: contain;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .results-table {
        margin-top: 10px;
        overflow-x: auto;
    }

    .results-table h2 {
        font-size: 1.5em;
        color: #fcb400;
        margin-bottom: 15px;
    }

    .results-table table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9em;
    }

    .results-table th, 
    .results-table td {
        padding: 10px;
        border: 1px solid #fcb400;
        text-align: left;
    }

    .results-table td {
        font-family: 'sans-serif';
        font-weight: normal;
        color: #fff;
    }

    .results-table th {
        background-color: #003150;
        font-family: sans-serif;
        font-weight: bold;
        color: #fff;
    }

    .results-table tbody tr:nth-child(odd) {
        background-color: #014772ff;
    }
</style>