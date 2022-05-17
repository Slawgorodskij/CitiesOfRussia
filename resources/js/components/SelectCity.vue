<template>
    <div>
        <p class="block-form__label">Выберите свою роль в поездке</p>

        <my-select
            :elemArray="roleArray"
            :placeholderName="placeholderNameRole"
            :inputName="inputNameRole"
        />
        <!--        <select class="block-form__input" name="trip_role">-->
        <!--            <option disabled>Выберите свою роль</option>-->
        <!--            <option value="passenger">Пассажир</option>-->
        <!--            <option value="driver">Водитель</option>-->
        <!--        </select>-->
        <p class="block-form__label">Выберите город отправления</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameDeparture"
        />

        <p class="block-form__label">Выберите город прибытия</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameArrival"
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
            roleArray: [
                {name: "Пассажир"},
                {name: "Водитель"},
            ],
            placeholderName: "Введите название города",
            placeholderNameRole: "Введите роль в поездке",
            inputNameDeparture: "departure_city",
            inputNameArrival: "city_of_arrival",
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
