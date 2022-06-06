<template>
    <div>

        <p class="block-form__label">Выберите город</p>

        <my-select
            :elemArray="cityArray"
            :placeholderName="placeholderName"
            :inputName="inputNameCity"
            :inputNameId="inputNameCityId"
        />

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

            placeholderName: "Введите название города",
            inputNameCityId: "city_id",
            inputNameCity: "city_name",
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

