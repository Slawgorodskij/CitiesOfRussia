<template>
    <div class="block-form__group">
        <search-input
            v-model="searchQuery"
            placeholder="Поиск...."
            class="block-form__input"
        ></search-input>
        <filter-select
            v-for="filterField in filterFields"
            :key="filterField.key"
            v-model="selectedFilters[filterField.key]"
            :options="filterField.options"
            :disabled-value="filterField.name"
            class="block-form__input"
        ></filter-select>
        <filter-select
            v-model="selectedSort"
            :options="fields"
            disabled-value="Способ сортировки"
            class="block-form__input"
        ></filter-select>
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
import searchInput from "./../UI/SearchInput";
import filterSelect from "./../UI/FilterSelect";

export default {
    components: {
        searchInput,
        filterSelect,
    },
    props: {
        data: {
            type: Object,
        },
        options: {
            type: Object,
        },
    },
    data() {
        return {
            // loading: false,
            items: this.fillItems(this.data),
            url: this.options.url,
            fields: this.options.fields.concat(this.options.filterFields),
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
        fillItems(items) {
            return items.map((item) => {
                this.options.filterFields.forEach((filterField) => {
                    item[filterField["key"]] = item[filterField["key"]]["name"];
                });
                return item;
            });
        },
        fillFilterFields(filterFields) {
            return filterFields.map((filterField) => {
                let options = new Set();
                this.data.forEach((item) => {
                    let option = {};
                    option["key"] = item[filterField["key"]];
                    option["name"] = item[filterField["key"]];
                    options.add(option);
                });
                filterField["options"] = Array.from(options);
                return filterField;
            });
        },
    },
    created() {
        // this.fetch();
    },
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
            return this.sortedFiltered.filter((item) =>
                item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
    },
};
</script>
