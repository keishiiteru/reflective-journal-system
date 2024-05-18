<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Entries</h1>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Type to search entries..." aria-label="Recipient's username" aria-describedby="button-addon2">
    </div>
    <div v-if="entries.length > 0">
        <div v-for="item in entries" :key="item.id">
            <p class="text-center">{{ formatDate(item.created_at) }}</p>
            <div class="card mb-3">
                <div class="card-header">
                    {{ formatTime(item.created_at) }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{item.title}}</h5>
                    <p class="card-text ellipsis">{{item.content}}</p>
                    <a href="#" class="btn btn-primary">See more</a>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
    import { onMounted, ref } from "vue"
    import moment from 'moment'

    const entries = ref([])

    onMounted(async () => {
        getEntries()
    })

    const getEntries = async () => {
        const response = await axios.get('/api/entries')
        //console.log('response', response.data.entries)
        entries.value = response.data.entries
    }

    const formatDate = (dateString) => {
        return moment(dateString).format('LL') + " - " + moment(dateString).format('dddd');
    };

    const formatTime = (dateString) => {
        return moment(dateString).format('LT');
    };
</script>

<style>
/* Add any necessary styles here */

.card-text.ellipsis {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%; /* or a specific width you want */
}
</style>
