<template>
    <div class="flex mb-14">
        <select v-model="form.type" name="flow" id="flow" class="sm:text-sm">
            <option value="in">In</option>
            <option value="out">Out</option>
        </select>

        <input
            v-model="form.desc"
            type="text"
            placeholder="Income/outcome description..."
            name="desc"
            id="desc"
            class="border-l-0 sm:text-sm w-60"
        />

        <div class="relative rounded-md shadow-sm">
            <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
            >
                <span class="text-gray-500 sm:text-sm"> £ </span>
            </div>
            <input
                v-model="form.price"
                type="text"
                name="price"
                id="price"
                class="focus:ring-indigo-500 focus:border-indigo-500 border-l-0 block w-full pl-7 pr-12 sm:text-sm h-full"
                placeholder="0.00"
                aria-describedby="price-currency"
            />
            <div
                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
            >
                <span class="text-gray-500 sm:text-sm" id="price-currency">
                    GBP
                </span>
            </div>
        </div>
        <button
            @click="handleItemAdded"
            class="bg-indigo-600 text-white px-6 text-sm ml-3"
        >
            Add
        </button>
    </div>
    <div class="grid grid-cols-2 gap-10">
        <div>
            <h2>Income</h2>
            <ul v-if="hasInputData">
                <li
                    v-for="item in incomeData"
                    :key="item.desc + item.price"
                    class="flex justify-between"
                >
                    <span class="font-semibold">{{ item.desc }}</span>
                    <span class="text-gray-500"> £{{ item.price }} </span>
                </li>
            </ul>
        </div>
        <div>
            <h2>Outcome</h2>
            <ul v-if="hasOutcomeData">
                <li
                    v-for="item in outcomeData"
                    :key="item.desc + item.price"
                    class="flex justify-between"
                >
                    <span class="font-semibold">{{ item.desc }}</span>
                    <span class="text-gray-500"> £{{ item.price }} </span>
                </li>
            </ul>
        </div>

        <div>Total: £{{ total }}.00</div>
        {{ user.email }}
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import type { Ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/reactivity";
import { usePage } from "public/js/app";
import useUser from "resources/js/Hooks/useUser";

const user = useUser();

interface FinanceType {
    type: string;
    desc: string;
    price: number;
}

const incomeData: Ref<Array<FinanceType>> = ref([]);
const outcomeData: Ref<Array<FinanceType>> = ref([]);

const form = useForm({
    type: "in",
    desc: null,
    price: null,
});

function getUsersName() {
    return computed(() => usePage().props)
}

const hasInputData = computed<boolean>(() => incomeData.value.length > 0);
const hasOutcomeData = computed<boolean>(() => outcomeData.value.length > 0);

const total = computed<number>(() => {
    const income = incomeData.value.reduce((acc, curr) => {
        return acc + curr.price;
    }, 0);
    const outcome = outcomeData.value.reduce((acc, curr) => {
        return acc + curr.price;
    }, 0);
    return income - outcome;
});

function handleItemAdded(): void {
    if (form.type === "in") {
        incomeData.value.push({
            type: form.type,
            desc: form.desc,
            price: form.price,
        });
    } else {
        outcomeData.value.push({
            type: form.type,
            desc: form.desc,
            price: form.price,
        });
    }
}
</script>
