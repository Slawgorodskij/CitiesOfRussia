<template>
  <select
    name="articleable_type"
    id="articleable_type"
    class="block-form__input"
    required
    v-model="articleableType"
    @change="onChange"
  >
    <option v-for="item of Object.keys(articleables)" :value="item" :key="item">
      {{ item }}
    </option>
  </select>

  <select
    name="articleable_id"
    id="articleable_id"
    class="block-form__input"
    required
    v-model="articleableId"
  >
    <option
      v-for="item of articleables[articleableType]"
      :value="item.id"
      :key="item.id"
    >
      {{ item.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: ["selectedType", "selectedId"],
  data() {
    return {
      articleableType: this.selectedType,
      articleableId: this.selectedId,
      articleables: {},
    };
  },
  methods: {
    fetch() {
      axios.get("/api/articleables").then((response) => {
        this.articleables = response.data;
      });
    },
    onChange() {
        this.articleableId = '';
    },
  },
  created() {
    this.fetch();
  },
};
</script>
