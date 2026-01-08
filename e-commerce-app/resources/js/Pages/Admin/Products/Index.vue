<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    products: Array
});

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        router.delete(route('admin.products.destroy', id));
    }
};
</script>

<template>
    <Head title="Products Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Products Management
                </h2>
                <Link
                    :href="route('admin.products.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Add New Product
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SKU
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="product in products" :key="product.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.category?.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.sku }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ${{ parseFloat(product.price).toFixed(2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.stock_quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="product.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{ product.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <Link
                                        :href="route('admin.products.edit', product.id)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteProduct(product.id)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
