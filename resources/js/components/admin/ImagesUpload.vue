<template>
  <input
    type="file"
    name="file[]"
    id="files"
    ref="files"
    multiple
    @change="handleFilesUpload()"
    style="visibility: hidden"
  />
  <div v-for="(item, key) in files" :key="key">
    {{ item.file.name }}
    <input
      v-model="item.description"
      type="text"
      :name="'description[' + key + ']'"
      class="block-form__input"
      placeholder="Описание"
    />
    <button type="button" @click="removeFile(key)" class="block-form__input">
      Удалить
    </button>
  </div>
  <button type="button" @click="addFiles()" class="block-form__button">
    Добавить фото
  </button>
  <button
    type="button"
    class="block-form__button"
    value="save"
    @click="submitFiles()"
  >
    Загрузить
  </button>
</template>

<script>
export default {
  data() {
    return {
      files: [],
    };
  },
  methods: {
    addFiles() {
      this.$refs.files.click();
    },
    submitFiles() {
      let formData = new FormData();
      for (var i = 0; i < this.files.length; i++) {
        let item = this.files[i];
        formData.append("files[" + i + "]", item.file);
        formData.append("description[" + i + "]", item.description);
      }
      axios
        .post("/api/images/store", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content"),
          },
        })
        .then(function () {
          console.log("SUCCESS!!");
        })
        .catch(function () {
          console.log("FAILURE!!");
        });
    },
    handleFilesUpload() {
      let uploadedFiles = this.$refs.files.files;
      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push({
          file: uploadedFiles[i],
          description: "",
        });
      }
    },
    removeFile(key) {
      this.files.splice(key, 1);
    },
  },
};
</script>
