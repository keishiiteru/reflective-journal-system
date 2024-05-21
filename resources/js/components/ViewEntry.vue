<template>
    <div class="card mt-3">
        <div class="card-header text-center">
            {{ formatDate(entry.created_at) }}
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">{{ entry.title }}</h5>
            <p class="card-text">{{ entry.content }}</p>
        </div>
        <div class="card-footer text-muted text-center">
            {{ formatTime(entry.created_at) }}

        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from "vue"
    import { useRoute } from 'vue-router';
    import moment from 'moment'

    const route = useRoute();
    const id = route.params.id;
    const entry = ref({
        created_at: '',
        title: '',
        content: ''
    });

    const getEntry = async (id) => {
        let response = await axios.get(`/api/entries/${id}`)
        //console.log('data',response.data.entry)
        entry.value = response.data.entry;
    }

    const formatDate = (dateString) => {
        return moment(dateString).format('LL') + " - " + moment(dateString).format('dddd');
    };

    const formatTime = (dateString) => {
        return moment(dateString).format('LT');
    };

    onMounted(async () => {
        await getEntry(id)
    })

</script>
