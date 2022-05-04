<template>
    <div class="presentation-block" v-for="sight in sightArray" :key="sight.id">
        <img class="presentation-block__photo" :src="sight.images[0]['name']" alt="достопримечательность города">
    </div>
</template>

<script>
import _ from 'lodash';

export default {

    data() {
        return {
            sightArray: [],
            loading: false,
        }
    },
    methods: {
        fetch(offset = 0) {
            this.loading = true;
            axios.get('/cities/sight', {
                params: {
                    offset: offset
                }
            })
                .then(response => {
                    console.log(response);
                    this.sightArray = this.sightArray.concat(response.data)
                })
                .finally(response => this.loading = false)
        }
    },
    created() {
        this.fetch()
        const eventHandler = () => {
            const block = document.querySelector('.carousel');
            const viewportHeight = window.innerHeight; // размер экрана
            const scrollTopDoc = document.documentElement.scrollTop; // скролл всего документа
            const offsetTop = block.offsetTop; // расстояние от верха до block
            const clientHeight = block.clientHeight; // высота block


            if ((offsetTop + clientHeight - scrollTopDoc) < viewportHeight) {
                console.log('выполняю запрос')
                this.fetch(this.sightArray.length)
            }

        }
        let delayedHandler = _.debounce(eventHandler, 400)
        document.addEventListener('scroll', delayedHandler);

    }
}
</script>


