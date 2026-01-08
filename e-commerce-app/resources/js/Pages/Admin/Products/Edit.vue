<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    categories: Array
});

const form = useForm({
    category_id: props.product.category_id,
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    stock_quantity: props.product.stock_quantity,
    sku: props.product.sku,
    image_url: props.product.image_url,
    is_active: props.product.is_active
});

const submit = () => {
    form.put(route('admin.products.update', props.product.id));
};
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Product: {{ product.name }}
                </h2>
                <Link
                    :href="route('admin.products.index')"
                    class="text-gray-600 hover:text-gray-900"
                >
                    Back to Products
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <!-- Name -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Product Name *
                                </label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    :class="{ 'border-red-500': form.errors.name }"
                                />
                                <p v-if="form.errors.name" class="text-red-500 text-xs italic mt-1">
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Category *
                                </label>
                                <select
                                    id="category_id"
                                    v-model="form.category_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    :class="{ 'border-red-500': form.errors.category_id }"
                                >
                                    <option value="">Select a category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <p v-if="form.errors.category_id" class="text-red-500 text-xs italic mt-1">
                                    {{ form.errors.category_id }}
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    Description
                                </label>
                                <textarea
                                    id="description"
                                    v-model="form.description"
                                    rows="4"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    :class="{ 'border-red-500': form.errors.description }"
                                ></textarea>
                                <p v-if="form.errors.description" class="text-red-500 text-xs italic mt-1">
                                    {{ form.errors.description }}
                                </p>
                            </div>

                            <!-- Price & Stock -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                        Price *
                                    </label>
                                    <input
                                        id="price"
                                        v-model="form.price"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        :class="{ 'border-red-500': form.errors.price }"
                                    />
                                    <p v-if="form.errors.price" class="text-red-500 text-xs italic mt-1">
                                        {{ form.errors.price }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="stock_quantity">
                                        Stock Quantity *
                                    </label>
                                    <input
                                        id="stock_quantity"
                                        v-model="form.stock_quantity"
                                        type="number"
                                        min="0"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        :class="{ 'border-red-500': form.errors.stock_quantity }"
                                    />
                                    <p v-if="form.errors.stock_quantity" class="text-red-500 text-xs italic mt-1">
                                        {{ form.errors.stock_quantity }}
                                    </p>
                                </div>
                            </div>

                            <!-- SKU -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="sku">
                                    SKU *
                                </label>
                                <input
                                    id="sku"
                                    v-model="form.sku"
                                    type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    :class="{ 'border-red-500': form.errors.sku }"
                                />
                                <p v-if="form.errors.sku" class="text-red-500 text-xs italic mt-1">
                                    {{ form.errors.sku }}
                                </p>
                            </div>

                            <!-- Image URL -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image_url">
                                    Image URL
                                </label>
                                <input
                                    id="image_url"
                                    v-model="form.image_url"
                                    type="url"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    :class="{ 'border-red-500': form.errors.image_url }"
                                />
                                <p v-if="form.errors.image_url" class="text-red-500 text-xs italic mt-1">
                                    {{ form.errors.image_url }}
                                </p>
                            </div>

                            <!-- Is Active -->
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input
                                        v-model="form.is_active"
                                        type="checkbox"
                                        class="mr-2"
                                    />
                                    <span class="text-gray-700 text-sm font-bold">Active</span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-between">
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline disabled:opacity-50"
                                >
                                    {{ form.processing ? 'Updating...' : 'Update Product' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
