<template>
    <div class="my-select">
        <svg
            class="my-select__arrow"
            @click="visibleItem = !visibleItem"
            :class="visibleItem ? 'dropdown' : ''"
            viewBox="0 0 284.935 284.936" width="24"
            height="24">
            <path
                d="M110.488,142.468L222.694,30.264c1.902-1.903,2.854-4.093,2.854-6.567c0-2.474-0.951-4.664-2.854-6.563L208.417,2.857 C206.513,0.955,204.324,0,201.856,0c-2.475,0-4.664,0.955-6.567,2.857L62.24,135.9c-1.903,1.903-2.852,4.093-2.852,6.567 c0,2.475,0.949,4.664,2.852,6.567l133.042,133.043c1.906,1.906,4.097,2.857,6.571,2.857c2.471,0,4.66-0.951,6.563-2.857 l14.277-14.267c1.902-1.903,2.851-4.094,2.851-6.57c0-2.472-0.948-4.661-2.851-6.564L110.488,142.468z"/>
        </svg>
        <input
            class="my-select__input"
            v-if="selectedItem === '' "
            v-model="searchCity"
            type="text"
            placeholder="В ведите название города"
        >
        <input
            class="my-select__input"
            v-else
            type="text"
            name="departure_city"
            :value="selectedItem"
        >
        <div
            class="my-select__item"
            v-show="visibleItem"
            @click="selectedCity(city.name)"
            v-for="city in filterCity"
            :key="city.id">
            <p>{{ city.name }}</p>

        </div>

    </div>

</template>

<script>

export default {
    name: "MySelect",
    data() {
        return {
            cityArray: [],
            visibleItem: false,
            searchCity: '',
            selectedItem: '',
        }
    },
    computed: {
        filterCity() {
            if (this.searchCity === '') {
                return this.cityArray
            }
            return this.cityArray.filter(city => {
                return Object.values(city).some((word) =>
                    String(word).toLowerCase().includes(
                        this.searchCity.toLowerCase()
                    ))
            })
        },
    },
    methods: {
        fetch() {
            axios.get('/api/cityList', {})
                .then(response => {
                    console.log(response);
                    this.cityArray = response.data;
                })
        },
        selectedCity(city) {
            this.selectedItem = city;
            this.visibleItem = false;
        }
    },
    created() {
        this.fetch()
    }
}

</script>

<style lang="scss">

.my-select {
    position: relative;
    margin-bottom: 2vh;
    width: 100%;
    min-height: 8vh;
    max-height: 30vh;
    overflow-y: scroll;
    border: var(--color-border) solid 2px;
    border-radius: 5px;


    &__arrow {
        position: absolute;
        top: 2.5vh;
        right: 15px;
        transform: rotate(-90deg);
        transition: all .4s linear;

        &.dropdown {
            transform: rotate(90deg);
        }
    }

    &__input {
        border: none;
        padding: 15px;
        width: 100%;
        height: 7vh;
    }

    &__item {
        padding: 15px;
        display: flex;
        align-items: center;
        width: 100%;
        height: 7vh;
        border-top: 1px solid var(--color-border);

        &:hover {
            background-color: var(--color-background-body-dark);
            font-weight: bold;
        }
    }
}

</style>
