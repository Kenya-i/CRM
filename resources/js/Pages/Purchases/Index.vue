<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import FlashMessage from '@/Components/FlashMessage.vue';
  import { onMounted, ref } from 'vue';
  import Pagination from '@/Components/Pagination.vue';
  import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  orders: Object
})


</script>
  
<template>
  <Head title="購買履歴" />

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              購買履歴
          </h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 bg-white border-b border-gray-200">
                      
                  
                    <section class="text-gray-600 body-font">
                      <div class="container px-5 py-8 mx-auto">

                        <FlashMessage />

                        <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                          <div>
                            <input type="text" name="search" v-model="search">
                            <button class="bg-blue-300 text-white py-2 px-2" @click="searchCustomers">検索</button>
                          </div>
                        </div>
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                          <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                              <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="orders in props.orders.data" :key="orders.id">
                                <td class="px-4 py-3">
                                  <Link class="text-blue-400" :href="route('purchases.show', { purchase: orders.id })">
                                  {{ orders.id }}</Link>
                                </td>
                                <td class="px-4 py-3">{{ orders.customer_name}}</td>
                                <td class="px-4 py-3 text-lg text-gray-900">{{orders.total}}</td>
                                <td class="px-4 py-3 text-lg text-gray-900">{{orders.status}}</td>
                                <td class="px-4 py-3 text-lg text-gray-900">{{orders.created_at}}</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                        
                      </div>
                      <Pagination class="mt-6" :links="props.orders.links"></Pagination>
                    </section>
                  </div>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>
