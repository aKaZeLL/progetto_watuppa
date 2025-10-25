<template>
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
            <h2>Ordini a 30 giorni di {{ orders[0].nome_cliente }} {{ orders[0].cognome_cliente }}</h2>
            
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
</template>

<script setup>

    import { ref } from 'vue';

    const email = ref('mario.rossi@example.com');
    const isLoading = ref(false);
    const message = ref('');
    const messageColor = ref('red');
    const orders = ref([]);
    const apiEndpoint = 'http://127.0.0.1/progetto_watuppa/api/order';

    async function searchOrders() {
        isLoading.value = true;
        message.value = '';
        orders.value = [];

        try {
            const response = await fetch(`${apiEndpoint}?email=${encodeURIComponent(email.value)}`, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' }
            });

            if (!response.ok) {
                throw new Error(`Errore HTTP: ${response.status}`);
            }
            
            const data = await response.json();

            if (data.records === 0 || data.error) {
                message.value = data.message;
                messageColor.value = 'orange';
            } else {
                orders.value = data.orders;
            }

        } catch (error) {
            console.error("Errore durante la ricerca:", error);
            message.value = `Errore: ${error.message}`;
            messageColor.value = 'red';
        } finally {
            isLoading.value = false;
        }
    }
</script>