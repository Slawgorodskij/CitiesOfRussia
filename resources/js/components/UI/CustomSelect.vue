<template>
    <select v-model="modelValue" @change="changeOption">
        <option disabled value="">{{ disabledValue }}</option>
        <option v-for="option in options" :key="option.key" :value="option.key">
            {{ option.name }}
        </option>
    </select>
</template>

<script>
export default {
    name: "custom-select",
    props: {
        modelValue: String,
        options: Array,
        disabledValue: String,
    },
    methods: {
        changeOption(event) {
            this.$emit("update:modelValue", event.target.value);
        },
    },
};
</script>
