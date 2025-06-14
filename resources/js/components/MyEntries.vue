<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Entries</h1>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Type to search entries..." v-model="searchEntry" @keyup="search()">
    </div>
    <div v-if="entries.length > 0">
        <div v-for="item in entries" :key="item.id">
            <p class="text-center">{{ formatDate(item.created_at) }}</p>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ formatTime(item.created_at) }}
                    <div class="row">
                        <div class="col">
                            <i class="text-info" @click="editEntry(item.id)"><font-awesome-icon icon="fa-solid fa-pen" /></i>
                        </div>
                        <div class="col">
                            <i class="text-danger" @click="deleteEntry(item.id)"><font-awesome-icon icon="fa-solid fa-trash" /></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{item.title}}</h5>
                    <p class="card-text ellipsis">{{item.content}}</p>
                    <a @click="viewEntry(item.id)" class="btn btn-primary">See more</a>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
    import { onMounted, ref } from "vue"
    import moment from 'moment'
    import { useRouter } from "vue-router"

    const router = useRouter()

    let entries = ref([])

    let searchEntry = ref([])

    onMounted(async () => {
        getEntries()
    })

    const getEntries = async () => {
        const response = await axios.get('/api/entries')
        //console.log('response', response.data.entries)
        entries.value = response.data.entries
    }

    const search = async () => {
        let response =  await axios.get('/api/entries?search='+searchEntry.value)
        //console.log('response',response.data.entries)

        entries.value = response.data.entries

    }

    const deleteEntry = async (id) => {
        if(confirm('Delete this entry?') == true){
            let response = await axios.delete(`/api/entries/${id}`);
            alert(response.data.message);
            getEntries()
        }
    }

    const viewEntry = (id) => {
        router.push('/view/'+id)
    }

    const editEntry = (id) => {
        router.push('/edit/'+id)
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

i {
    cursor: pointer;
}
</style>
