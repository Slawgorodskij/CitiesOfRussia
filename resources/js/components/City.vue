<template>

    <div class="presentation-block" v-for="city in cityArray" :key="city.id">
        <img class="presentation-block__photo" :src="city.images[0]['name']" alt="фотография города">
        <div class="presentation-block__text">
            {{ city.name }}
        </div>
        <div class="presentation-block__hover">
            <a class="presentation-block__hover_link" :href="'cities/' + city.slug">
                <h3>{{ city.description }}</h3>
            </a>
        </div>
    </div>

    <div v-show="loading"><span>LOADING...</span></div>
</template>

<script>

import _ from 'lodash';

export default {
    data() {
        return {
            cityArray: [],
            loading: false,
        }
    },
    methods: {
        fetch(offset = 0) {
            this.loading = true;
            axios.get('/api/cities', {
                params: {
                    offset: offset
                }
            })
                .then(response => {
                    console.log(response);
                    this.cityArray = this.cityArray.concat(response.data)
                })
                .finally(response => this.loading = false)
        }
    },
    created() {
        this.fetch()

        const eventHandler = () => {
            const block = document.querySelector('.presentation');
            const viewportHeight = window.innerHeight; // размер экрана
            const scrollTopDoc = document.documentElement.scrollTop; // скролл всего документа
            const offsetTop = block.offsetTop; // расстояние от верха до block
            const clientHeight = block.clientHeight; // высота block


            if ((offsetTop + clientHeight - scrollTopDoc) < viewportHeight) {
                console.log('выполняю запрос')
                this.fetch(this.cityArray.length)
            }

        }
        let delayedHandler = _.debounce(eventHandler, 400)
        document.addEventListener('scroll', delayedHandler);
    }
}
</script>


