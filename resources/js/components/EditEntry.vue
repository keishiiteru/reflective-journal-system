<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Entry</h1>
    </div>
    <form @submit.prevent="submitForm">
        <div class="form-group mb-3">
            <label class="fs-4">Title</label>
            <input type="text" class="form-control" v-model="form.title">
        </div>
        <div class="form-group mb-3">
            <label class="fs-4">Content</label>
            <textarea class="form-control" rows="3" v-model="form.content"></textarea>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</template>

<script setup>
    import { onMounted, ref } from "vue"
    import { useRouter, useRoute } from "vue-router"

    const router = useRouter()
    const route = useRoute()
    const id = route.params.id

    const form = ref({
        title: '',
        content: ''
    })

    const getEntry = async (id) => {
        let response = await axios.get(`/api/entries/${id}`)
        form.value = response.data.entry
    }

    const submitForm = async() => {
        try {
            const response = await axios.put(`/api/entries/${id}`,form.value)
            alert(response.data.message)
            router.push('/');
        } catch (error) {
            console.error(error)
        }
    }

    onMounted(async () => {
        await getEntry(id)
    })


</script>
