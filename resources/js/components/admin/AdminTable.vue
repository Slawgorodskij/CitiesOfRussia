<template>
    <div class="block-form__group">
        <my-input
            v-model="searchQuery"
            placeholder="Поиск...."
            class="block-form__input"
        ></my-input>
        <my-select
            v-for="filterField in filterFields"
            :key="filterField.id"
            :elemArray="filterField.options"
            :placeholderName="filterField.name"
            v-model="selectedFilters[filterField.id]"
        ></my-select>
        <my-select
            :elemArray="fields"
            placeholderName="Способ сортировки"
            v-model="selectedSort"
        ></my-select>
    </div>
    <table class="admin-panel__table">
        <thead>
            <tr>
                <th v-for="field in fields" :key="field.id">
                    {{ field.name }}
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in sortedFilteredAndSearched" :key="item.id">
                <td v-for="field in fields" :key="field.id">
                    {{ item[field.id] }}
                </td>
                <td>
                    <a :href="`${this.url}${item.id}/edit`" class="admin-panel__button">
                        Редактировать
                    </a>
                    <delete-button
                        :url="`${url}${item.id}`"
                        :confirmation="this.deleteConfirmation + item.id"
                        class="admin-panel__button"
                    >
                    </delete-button>
                    <a
                        v-for="relation in polymorphic"
                        :key="relation.id"
                        :href="`${relation.url}?${relation.id}_type=${relation.type}&${relation.id}_id=${item.id}`"
                        class="admin-panel__button"
                    >
                        {{ relation.message }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import myInput from "./../UI/MyInput";
import mySelect from "./../UI/MySelect";

export default {
    components: {
        myInput,
        mySelect,
    },
    props: {
        data: Array,
        options: Object,
    },
    data() {
        return {
            // loading: false,
            items: this.fillItems(this.data, this.options.filterFields),
            url: this.options.url,
            fields: this.fillFields(this.options.fields, this.options.filterFields),
            filterFields: this.fillFilterFields(this.options.filterFields),
            deleteConfirmation: this.options.deleteConfirmation,
            polymorphic: this.options.polymorphic,
            selectedSort: "",
            selectedFilters: {},
            searchQuery: "",
        };
    },
    methods: {
        // fetch() {
        //     this.loading = true;
        //     axios
        //         .get(`/api${this.url}`)
        //         .then((response) => {
        //             this.data = this.data.concat(response.data);
        //         })
        //         .finally((response) => (this.loading = false));
        // },
        fillItems(items, filterFields) {
            if (filterFields) {
                return items.map((item) => {
                    filterFields.forEach((filterField) => {
                        item[filterField["id"]] = item[filterField["id"]]["name"];
                    });
                    return item;
                });
            } else {
                return items;
            }
        },
        fillFields(fields, filterFields) {
            if (filterFields) {
                return fields.concat(filterFields);
            } else {
                return fields;
            }
        },
        fillFilterFields(filterFields) {
            if (filterFields) {
                return filterFields.map((filterField) => {
                    let options = new Set();
                    this.data.forEach((item) => {
                        options.add(item[filterField["id"]]);
                    });
                    options = Array.from(options).sort();
                    options = options.map((option) => {
                        return {
                            id: option,
                            name: option,
                        };
                    });
                    filterField["options"] = options;
                    return filterField;
                });
            } else {
                return filterFields;
            }
        },
    },
    // created() {
    //     this.fetch();
    // },
    computed: {
        sorted() {
            if (this.selectedSort) {
                return [...this.items].sort((item1, item2) => {
                    if (typeof item1[this.selectedSort] === "string") {
                        return item1[this.selectedSort].localeCompare(
                            item2[this.selectedSort]
                        );
                    } else {
                        return item1[this.selectedSort] - item2[this.selectedSort];
                    }
                });
            } else {
                return this.items;
            }
        },
        sortedFiltered() {
            if (Object.keys(this.selectedFilters).length != 0) {
                return this.sorted.filter((item) => {
                    for (const key in this.selectedFilters) {
                        if (item[key] != this.selectedFilters[key]) {
                            return false;
                        }
                    }
                    return true;
                });
            } else {
                return this.sorted;
            }
        },
        sortedFilteredAndSearched() {
            return this.sortedFiltered.filter((item) => {
                return Object.values(item)
                    .join("\n")
                    .toLowerCase()
                    .includes(this.searchQuery.toLowerCase());
            });
        },
    },
};
</script>
