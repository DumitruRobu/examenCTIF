<template>
    <div class="min-h-screen flex items-center justify-center">
        <div class="relative group">
            <!-- Dropdown Button -->
            <button
                @click="toggleDropdown"
                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500"
            >
                <span class="mr-2">Open Dropdown</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        fill-rule="evenodd"
                        d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div
                v-show="isOpen"
                class="absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1"
            >
                <!-- Search Input -->
                <input
                    v-model="searchQuery"
                    class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none"
                    type="text"
                    placeholder="Search items"
                    autocomplete="off"
                />

                <!-- Dropdown Items -->
                <a
                    v-for="item in filteredItems"
                    :key="item"
                    href="#"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"
                >
                    {{ item }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false, // Tracks whether the dropdown is open
            searchQuery: "", // Tracks the user's search input
            items: ["Uppercase", "Lowercase", "Camel Case", "Kebab Case"], // Dropdown items
        };
    },
    computed: {
        filteredItems() {
            // Filters items based on the search query
            return this.items.filter((item) =>
                item.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
    },
};
</script>

<style scoped>
</style>
