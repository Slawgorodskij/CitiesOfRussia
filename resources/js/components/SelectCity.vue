<template>
    <div>
        <p class="block-form__label">Выберите город отправления</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameDeparture"
            :inputNameId="inputNameDepartureId"
        />

        <p class="block-form__label">Выберите город прибытия</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameArrival"
            :inputNameId="inputNameArrivalId"
        />
    </div>
</template>

<script>

import MySelect from "./UI/MySelect";

export default {
    name: "SelectCity",
    components: {
        MySelect,
    },
    data() {
        return {
            cityArray: [],
            placeholderName: "Введите название города",
            inputNameDeparture: "departure_city_name",
            inputNameDepartureId: "departure_city",
            inputNameArrival: "city_of_arrival_name",
            inputNameArrivalId: "city_of_arrival",
            inputNameRole: "trip_role",
        }
    },

    methods: {
        fetch() {
            axios.get('/api/cityList', {})
                .then(response => {
                    this.cityArray = response.data;
                })
        },
    },
    created() {
        this.fetch()
    },
}
</script>


