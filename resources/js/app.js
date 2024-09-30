require('./bootstrap');

import Vue from 'vue';
import WaterConsumptionChart from './components/WaterConsumptionChart.vue';
import DailyConsumptionChart from './components/DailyConsumptionChart.vue';

const app = new Vue({
    el: '#app',
    components: { 
        WaterConsumptionChart,
        DailyConsumptionChart 
    }
});
