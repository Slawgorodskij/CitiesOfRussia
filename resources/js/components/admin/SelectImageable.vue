<template>
  <select
    name="imageable_type"
    id="imageable_type"
    class="block-form__input"
    required
    v-model="imageableType"
    @change="onChange"
  >
    <option v-for="item of Object.keys(imageables)" :value="item" :key="item">
      {{ item }}
    </option>
  </select>

  <select
    name="imageable_id"
    id="imageable_id"
    class="block-form__input"
    required
    v-model="imageableId"
  >
    <option v-for="item of imageables[imageableType]" :value="item.id" :key="item.id">
      {{ item.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: ["selectedType", "selectedId"],
  data() {
    return {
      imageableType: this.selectedType,
      imageableId: this.selectedId,
      imageables: {},
    };
  },
  methods: {
    fetch() {
      axios.get("/api/imageables").then((response) => {
        this.imageables = response.data;
      });
    },
    onChange() {
      this.imageableId = "";
    },
  },
  created() {
    this.fetch();
  },
};
</script>
