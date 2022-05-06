<template>
  <input
    type="file"
    name="file[]"
    id="files"
    ref="files"
    multiple
    @change="handleFilesUpload()"
    hidden
  />
  <div v-for="(item, key) in files" :key="key">
    {{ item.file.name }}
    <div class="block-form__group">
      <input
        v-model="item.description"
        type="text"
        :name="'description[' + key + ']'"
        class="block-form__input"
        placeholder="Описание"
      />
      <button type="button" @click="removeFile(key)" class="block-form__button">
        Удалить
      </button>
    </div>
  </div>
  <button type="button" @click="addFiles()" class="block-form__button">
    Добавить фото
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
    handleFilesUpload() {
      let uploadedFiles = this.$refs.files.files;
      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push({
          file: uploadedFiles[i],
          description: "",
        });
      }
      this.setFileList(this.files);
    },
    removeFile(key) {
      this.files.splice(key, 1);
      this.setFileList(this.files);
    },
    setFileList(files) {
      let list = new DataTransfer();
      files.forEach((item) => {
        list.items.add(item.file);
      });
      this.$refs.files.files = list.files;
    },
  },
};
</script>
