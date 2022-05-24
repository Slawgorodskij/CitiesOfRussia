<template>
    <my-select
        :elemArray="relationTypes"
        placeholderName="Выберите"
        :inputNameId="`${relationName}_type`"
        v-model="relationType"
        required
        @update:modelValue="() => (relationId = '')"
    ></my-select>
    <my-select
        :elemArray="relations[relationType]"
        :placeholderName="relationType"
        :inputNameId="`${relationName}_id`"
        :placeholder-name="relationType"
        v-model="relationId"
        required
    ></my-select>
</template>

<script>
import mySelect from "./UI/MySelect";

export default {
    components: {
        mySelect,
    },
    props: ["relationName", "selectedType", "selectedId", "relations"],
    data() {
        return {
            relationType: this.selectedType,
            relationId: this.selectedId,
            relationTypes: this.fillRelationTypes(this.relations),
        };
    },
    methods: {
        fillRelationTypes(relations) {
            return Object.keys(relations).map((relationType, index) => {
                return { id: relationType, name: relationType };
            });
        },
    },
};
</script>
