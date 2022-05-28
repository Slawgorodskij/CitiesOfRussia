<template>
    <div>
    <!--
        <p class="block-form__label">Выберите свою роль в поездке</p>

        <my-select
            :elemArray="roleArray"
            :placeholderName="placeholderNameRole"
            :inputName="inputNameRole"
        />
    -->
        <p class="block-form__label">Выберите город</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameDeparture"
            :inputNameId="inputNameDepartureId"
        />
 <!--
        <p class="block-form__label">Выберите город прибытия</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameArrival"
            :inputNameId="inputNameArrivalId"
        />
-->        
    </div>
    
</template>

<script>

import MySelect from "./UI/MySelect";

export default {
    name: "SelectCityAcc",
    components: {
        MySelect,
    },
    data() {
        return {
            cityArray: [],
            roleArray: [
                {name: "Пассажир"},
                {name: "Водитель"},
            ],
            placeholderName: "Введите название города",
            placeholderNameRole: "Введите роль в поездке",
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

<style scoped>

</style>
