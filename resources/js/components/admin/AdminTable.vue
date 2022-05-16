<template>
    <div class="block-form__group">
        <custom-input
            v-model="searchQuery"
            placeholder="Поиск...."
            class="block-form__input"
        ></custom-input>
        <custom-select
            v-for="filterField in filterFields"
            :key="filterField.key"
            v-model="selectedFilters[filterField.key]"
            :options="filterField.options"
            :disabled-value="filterField.name"
            class="block-form__input"
        ></custom-select>
        <custom-select
            v-model="selectedSort"
            :options="fields"
            disabled-value="Способ сортировки"
            class="block-form__input"
        ></custom-select>
    </div>
    <table class="admin-panel__table">
        <thead>
            <tr>
                <th v-for="field in fields" :key="field.key">
                    {{ field.name }}
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in sortedFilteredAndSearched" :key="item.id">
                <td v-for="field in fields" :key="field.key">
                    {{ item[field.key] }}
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
                        :key="relation.key"
                        :href="`${relation.url}?${relation.key}_type=${relation.type}&${relation.key}_id=${item.id}`"
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
import customInput from "./../UI/CustomInput";
import customSelect from "./../UI/CustomSelect";

export default {
    components: {
        customInput,
        customSelect,
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
                        item[filterField["key"]] = item[filterField["key"]]["name"];
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
                        options.add(item[filterField["key"]]);
                    });
                    options = Array.from(options);
                    options = options.map((option) => {
                        return {
                            key: option,
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
