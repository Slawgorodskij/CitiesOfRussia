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
    name: "filter-select",
    props: {
        modelValue: {
            type: String,
        },
        options: {
            type: Array,
            default: () => [],
        },
        disabledValue: {
            type: String,
        },
    },
    methods: {
        changeOption(event) {
            this.$emit("update:modelValue", event.target.value);
        },
    },
};
</script>
