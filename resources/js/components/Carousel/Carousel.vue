<template>
    <div class="slider container">

        <div class="slider__block-images">
            <carousel-slide class="slider__slide-elem"
                            v-for="(image, data) in imagesArray"
                            :key="id"
                            :index="data"
                            :visibleSlade="visibleSlide"
                            :direction="direction">
                <img class="slider__slide-image"
                     :src="image['name']"
                     alt="photo">
                <div class="slider__slide-hover">
                    <h2>{{ image['description'] }}</h2>
                </div>
            </carousel-slide>
        </div>

        <div class="slider__block-button block-button">
            <button @click="prev" class="block-button__button">
                <svg class="slider__button-logo" viewBox="0 0 284.935 284.936" width="24" height="24">
                    <path
                        d="M110.488,142.468L222.694,30.264c1.902-1.903,2.854-4.093,2.854-6.567c0-2.474-0.951-4.664-2.854-6.563L208.417,2.857 C206.513,0.955,204.324,0,201.856,0c-2.475,0-4.664,0.955-6.567,2.857L62.24,135.9c-1.903,1.903-2.852,4.093-2.852,6.567 c0,2.475,0.949,4.664,2.852,6.567l133.042,133.043c1.906,1.906,4.097,2.857,6.571,2.857c2.471,0,4.66-0.951,6.563-2.857 l14.277-14.267c1.902-1.903,2.851-4.094,2.851-6.57c0-2.472-0.948-4.661-2.851-6.564L110.488,142.468z"/>
                </svg>
            </button>
            <button @click="next" class="block-button__button">
                <svg class="slider__button-logo" viewBox="0 0 792.033 792.033" width="24" height="24">
                    <path
                        d="M617.858,370.896L221.513,9.705c-13.006-12.94-34.099-12.94-47.105,0c-13.006,12.939-13.006,33.934,0,46.874 l372.447,339.438L174.441,735.454c-13.006,12.94-13.006,33.935,0,46.874s34.099,12.939,47.104,0l396.346-361.191 c6.932-6.898,9.904-16.043,9.441-25.087C627.763,386.972,624.792,377.828,617.858,370.896z"/>
                </svg>
            </button>
        </div>


    </div>
</template>

<script>

import CarouselSlide from './CarouselSlide.vue';

export default {
    name: "Carousel",
    components: {
        CarouselSlide,
    },
    props: ['type', 'id'],
    data() {
        return {
            imagesArray: [],
            visibleSlide: 0,
            direction: '',
        }
    },

    computed: {
        imagesArrayLen() {
            return this.imagesArray.length
        }
    },

    methods: {

        fetch() {
            axios.get('/api/carousel/' + this.type + '/' + this.id, {})
                .then(response => {
                    console.log(response);
                    this.imagesArray = response.data
                })
        },

        next() {
            if (this.visibleSlide >= this.imagesArrayLen - 1) {
                this.visibleSlide = 0;
            } else {
                this.visibleSlide++;
            }
            this.direction = 'left';
        },
        prev() {
            if (this.visibleSlide <= 0) {
                this.visibleSlide = this.imagesArrayLen - 1;
            } else {
                this.visibleSlide--;
            }
            this.direction = 'right';
        },
    },
    created() {
        this.fetch()
    }

}
</script>

<style lang="scss">
.slider {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1.5rem;

    &__block-images {
        position: relative;
        min-height: 50vh;
        width: 100%;
        overflow: hidden;
    }

    &__slide-elem {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    &__slide-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    &__slide-hover {
        position: absolute;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        text-align: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--color-background);
        z-index: 0;
        transition: all 0.4s linear;
    }

    &__slide-elem:hover .slider__slide-hover {
        z-index: 3;
    }
}

.block-button {
    display: flex;
    justify-content: space-between;

    &__button {
        width: 40vw;
        height: 50px;
        border: none;
        fill: var(--color-black);
        background-color: rgba(42, 42, 42, 0.14);
        transition: background-color 0.3s linear;

        &:hover {
            background-color: rgba(42, 42, 42, 0.24);
            fill: var(--color-title);
        }
    }

}

</style>
