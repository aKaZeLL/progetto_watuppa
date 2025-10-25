<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Progetto Watuppa</title>
    
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

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

        h1 {
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
            font-family: 'Stencil';
            font-weight: normal;
            color: #fff;
        }

        .results-table th {
            background-color: #003150;
            font-family: sans-serif;
            font-weight: bold;
            color: #fff;
        }

        .results-table tbody tr:nth-child(even) {
            background-color: #014772ff;
        }
    </style>
</head>
<body>

    <div id="app">
        <div class="container">
            <h1>Ricerca ordini</h1>
            <email-order-search />
        </div>
    </div>

    <script>

      const EmailOrderSearch = {
          template: `
              <div>
                  <form @submit.prevent="searchOrders" class="search-form" :style="{ padding: 0, backgroundColor: 'transparent' }">
                      <input 
                          type="email" 
                          id="email" 
                          v-model="email" 
                          placeholder="Inserisci la tua email" 
                          required 
                      >
                      <button type="submit" :disabled="isLoading">
                          </button>
                  </form>
                  
                  <div style="margin-top: 20px; text-align: center;">
                      <p v-if="isLoading" style="color: #007bff; font-weight: bold;">Caricamento ordini in corso...</p>
                      <p v-else-if="message" :style="{ color: messageColor }">{{ message }}</p>
                  </div>

                  <div v-if="orders.length > 0" class="results-table">
                      <h2>Ordini trovati per {{ orders[0].nome_cliente }} {{ orders[0].cognome_cliente }}</h2>
                      
                      <table>
                          <thead>
                              <tr>
                                  <th>Ordine #</th>
                                  <th>Data</th>
                                  <th>Stato</th>
                                  <th>Prodotto</th>
                                  <th>Prezzo</th>
                                  <th>Qtà</th>
                                  <th>Costo Totale</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(orderItem, index) in orders" :key="index">
                                  <td>{{ orderItem.numero_ordine }}</td>
                                  <td>{{ orderItem.data_ordine.substring(0, 10) }}</td>
                                  <td>{{ orderItem.stato_ordine }}</td>
                                  <td>{{ orderItem.nome_prodotto }}</td>
                                  <td>€ {{ parseFloat(orderItem.prezzo).toFixed(2) }}</td>
                                  <td>{{ orderItem.qt_prodotto }}</td>
                                  <td>€ {{ parseFloat(orderItem.costo).toFixed(2) }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          `,

          data() {
              return {
                  email: 'mario.rossi@test.it',
                  isLoading: false,
                  message: '',
                  messageColor: 'red',
                  orders: [],
                  apiEndpoint: '../api/order'
              };
          },

          methods: {
              async searchOrders() {
                  this.isLoading = true;
                  this.message = '';
                  this.orders = [];

                  // fetch al Backend PHP
                  try {
                      const response = await fetch(`${this.apiEndpoint}?email=${encodeURIComponent(this.email)}`, {
                          method: 'GET',
                          headers: {
                              'Content-Type': 'application/json'
                          }
                      });

                      // Gestione di risposte non-OK (es. 404, 500)
                      if (!response.ok) {
                          // Controlla il codice di stato HTTP per errori
                          throw new Error(`Errore HTTP: ${response.status}. Controlla il tuo backend.`);
                      }
                      
                      // Parsing dei dati
                      const data = await response.json();

                      // 4. nessun record da backend
                      if (data.records == 0) {
                          this.message = data.message;
                          this.messageColor = 'orange';
                          this.orders = [];
                      } else {
                          // Dati trovati
                          this.orders = data.orders;
                          console.log(this.orders);
                          
                      }

                  } catch (error) {
                      // Gestione di errori di rete o parsing
                      console.error("Errore durante la ricerca:", error);
                      this.message = `Errore di connessione: ${error.message}`;
                      this.messageColor = 'red';
                  } finally {
                      // 5. Fine Caricamento
                      this.isLoading = false;
                  }
              },
          }
      };

      // --- 4.2 Montaggio dell'Applicazione Vue ---
      const app = Vue.createApp({});
      app.component('email-order-search', EmailOrderSearch);
      app.mount('#app');
    </script>
</body>
</html>