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
            <ul v-if="hasIncomeData">
                <li
                    v-for="item in incomings"
                    :key="item.description + item.amount"
                    class="flex justify-between"
                >
                    <span class="font-semibold">{{ item.description }}</span>
                    <span class="text-gray-500"> £{{ item.amount }} </span>
                </li>
            </ul>
        </div>
        <div>
            <h2>Outgoings</h2>
            <ul v-if="outgoings">
            <!-- Fix -->
                <li
                    v-for="item in outgoings"
                    :key="item.desc + item.price"
                    class="flex justify-between"
                >
                    <span class="font-semibold">{{ item.desc }}</span>
                    <span class="text-gray-500"> £{{ item.price }} </span>
                </li>
            </ul>
        </div>

        <div>Total: £{{ total }}.00</div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import type { Ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/reactivity";

interface FinanceType extends App.DataTransferObjects.FinanceData {}

const props = defineProps<{
    income: Array<FinanceType>,
    outgoings: Array<FinanceType>,
}>();

const incomings: Ref<Array<FinanceType>> = ref(props.income);
const outgoings: Ref<Array<FinanceType>> = ref(props.outgoings);


const form = useForm({
    type: "in",
    desc: null,
    price: null,
});

const hasIncomeData = computed<boolean>(() => incomings.value.length > 0);
const hasOutcomeData = computed<boolean>(() => outgoings.value.length > 0);

const total = computed<number>(() => {
    const income = incomings.value.reduce((acc, curr) => {
        return acc + curr.amount;
    }, 0);
    const outcome = outgoings.value.reduce((acc, curr) => {
        return acc + curr.amount;
    }, 0);

    return income - outcome;
});

function handleItemAdded(): void {
    if (form.type === "in") {
        incomings.value.push({
            type: form.type,
            description: form.desc,
            amount: form.price,
        });
    } else {
        outgoings.value.push({
            type: form.type,
            description: form.desc,
            amount: form.price,
        });
    }
}
</script>
